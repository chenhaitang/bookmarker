<?php

$title = __('Hex Color Lookup - ColorLookup.com');
$this->assign('title', $title);
$color = '#FFFFFF';

?>

        <h1><?= $title ?></h1>

<?php foreach ($bookmarks as $bookmark): ?>
<?= h($bookmark->title) ?>
<?php endforeach; ?>
                   