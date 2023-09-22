<?php declare(strict_types=1);

/*
 * This file is part of PHP CS Fixer: custom fixers.
 *
 * (c) 2018 Kuba Werłos
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace PhpCsFixerCustomFixers\Fixer;

use PhpCsFixer\FixerDefinition\CodeSample;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Preg;
use PhpCsFixer\Tokenizer\Analyzer\NamespacesAnalyzer;
use PhpCsFixer\Tokenizer\Token;
use PhpCsFixer\Tokenizer\Tokens;
use PhpCsFixerCustomFixers\TokenRemover;

final class NoImportFromGlobalNamespaceFixer extends AbstractFixer
{
    public function getDefinition(): FixerDefinitionInterface
    {
        return new FixerDefinition(
            'There can be no imports from the global namespace.',
            [new CodeSample('<?php
namespace Foo;
use DateTime;
class Bar {
    public function __construct(DateTime $dateTime) {}
}
')],
            '',
        );
    }

    /**
     * Must run before PhpdocAlignFixer.
     */
    public function getPriority(): int
    {
        return 0;
    }

    public function isCandidate(Tokens $tokens): bool
    {
        return $tokens->isTokenKindFound(\T_USE);
    }

    public function isRisky(): bool
    {
        return false;
    }

    public function fix(\SplFileInfo $file, Tokens $tokens): void
    {
        foreach (\array_reverse((new NamespacesAnalyzer())->getDeclarations($tokens)) as $namespace) {
            $this->fixImports($tokens, $namespace->getScopeStartIndex(), $namespace->getScopeEndIndex(), $namespace->getFullName() === '');
        }
    }

    private function fixImports(Tokens $tokens, int $startIndex, int $endIndex, bool $isInGlobalNamespace): void
    {
        $imports = [];

        for ($index = $startIndex; $index < $endIndex; $index++) {
            if ($tokens[$index]->isGivenKind(\T_USE)) {
                $imports = $this->removeImportFromGlobalNamespace($tokens, $imports, $index);
                continue;
            }

            if ($isInGlobalNamespace) {
                continue;
            }

            if ($tokens[$index]->isGivenKind(\T_DOC_COMMENT)) {
                $this->updateComment($tokens, $imports, $index);
                continue;
            }

            if (!$tokens[$index]->isGivenKind(\T_STRING)) {
                continue;
            }

            $this->updateUsage($tokens, $imports, $index);
        }
    }

    /**
     * @param array<string> $imports
     *
     * @return array<string>
     */
    private function removeImportFromGlobalNamespace(Tokens $tokens, array $imports, int $index): array
    {
        $classNameIndex = $tokens->getNextMeaningfulToken($index);
        \assert(\is_int($classNameIndex));

        if ($tokens[$classNameIndex]->isGivenKind(\T_NS_SEPARATOR)) {
            $classNameIndex = $tokens->getNextMeaningfulToken($classNameIndex);
            \assert(\is_int($classNameIndex));
        }

        $semicolonIndex = $tokens->getNextMeaningfulToken($classNameIndex);
        \assert(\is_int($semicolonIndex));

        if ($tokens[$semicolonIndex]->equals(';')) {
            $imports[] = $tokens[$classNameIndex]->getContent();
            $tokens->clearRange($index, $semicolonIndex);
            TokenRemover::removeWithLinesIfPossible($tokens, $semicolonIndex);
        }

        return $imports;
    }

    /**
     * @param array<string> $imports
     */
    private function updateComment(Tokens $tokens, array $imports, int $index): void
    {
        $content = $tokens[$index]->getContent();

        foreach ($imports as $import) {
            $content = Preg::replace(\sprintf('/\b(?<!\\\\)%s\b/', $import), '\\' . $import, $content);
        }

        if ($content !== $tokens[$index]->getContent()) {
            $tokens[$index] = new Token([\T_DOC_COMMENT, $content]);
        }
    }

    /**
     * @param array<string> $imports
     */
    private function updateUsage(Tokens $tokens, array $imports, int $index): void
    {
        if (!\in_array($tokens[$index]->getContent(), $imports, true)) {
            return;
        }

        $prevIndex = $tokens->getPrevMeaningfulToken($index);
        \assert(\is_int($prevIndex));

        if ($tokens[$prevIndex]->isGivenKind([\T_CONST, \T_DOUBLE_COLON, \T_NS_SEPARATOR, \T_OBJECT_OPERATOR, \T_FUNCTION])) {
            return;
        }

        $tokens->insertAt($index, new Token([\T_NS_SEPARATOR, '\\']));
    }
}
