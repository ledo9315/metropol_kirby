<?php
/**
 * Film-Kategorien Snippet
 * Zeigt die Kategorien eines Films an
 */

if (!isset($film)) {
    return;
}

$categories = getFilmCategories($film);
if (empty($categories)) {
    return;
}

$className = isset($className) ? $className : 'text-gray-500';
?>

<div class="<?= $className ?>" <?= isset($useAriaLabel) && $useAriaLabel ? 'aria-label="Film-Kategorien"' : '' ?>>
    <?= implode(' / ', $categories) ?>
</div>