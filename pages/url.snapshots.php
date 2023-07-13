<?php

$urlId = rex_request('id', 'int');
$idBefore = rex_request('before', 'int', null);
$idAfter = rex_request('after', 'int', null);
$counter = 0;

$Url = \FriendsOfRedaxo\DiffDetect\Url::get($urlId);
$Snapshots = $Url->getSnapshots();

$rows = [];
foreach ($Snapshots as $snapshot) {
    ++$counter;
    $checkedBefore = '';
    $checkedAfter = '';

    if (null === $idBefore && 1 === $counter) {
        $checkedBefore = ' checked';
    }
    if ($idBefore === $snapshot['id']) {
        $checkedBefore = ' checked';
    }
    if ($idAfter === $snapshot['id'] ||
        1 === count($Snapshots) ||
        (null === $idAfter && 2 === $counter)) {
        $checkedAfter = ' checked';
    }

    $diff_radios = '<div class="diff">
        <input type="radio" name="before" value="'.$snapshot['id'].'"'.$checkedBefore.'>
        <input type="radio" name="after" value="'.$snapshot['id'].'"'.$checkedAfter.'>
        </div>';

    $rows[] = '
    <tr>
        <td>'.$diff_radios.'</td>
        <td>'.rex_escape(rex_formatter::intlDateTime((string) $snapshot['createdate'], IntlDateFormatter::MEDIUM)).'</td>
        <td>'.rex_escape($snapshot['createuser']).'</td>
        <td>'.rex_escape(rex_formatter::bytes($snapshot['size'], [2])).'</td>
    </tr>';
}

$content =
    '<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>'.rex_i18n::msg('compare').'</th>
            <th>'.rex_i18n::msg('createdate').'</th>
            <th>'.rex_i18n::msg('createuser').'</th>
            <th>'.rex_i18n::msg('size').'</th>
        </tr>
    </thead>
    <tbody>
        '.implode('', $rows).'
    </tbody>
    </table>';

$formElements = [];
$n = [];
$n['field'] = '<button class="btn btn-primary" type="submit" name="compare_submit">' . rex_i18n::msg('compare') . '</button>';
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$buttons = $fragment->parse('core/form/submit.php');

$fragment = new rex_fragment();
$fragment->setVar('title', $this->i18n('snapshots_title_list', $Url->getName()), false);
$fragment->setVar('content', $content, false);
$fragment->setVar('buttons', $buttons, false);

echo '<form action="'.rex_url::currentBackendPage([
    'func' => 'diff',
    'id' => $urlId,
]).'" method="post">
        ' . $fragment->parse('core/page/section.php') . '
    </form>';
