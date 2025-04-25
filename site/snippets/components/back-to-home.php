<?php
/**
 * Back to Home Component
 * 
 * @param string $class Additional CSS classes
 * @param string $text Custom text (optional)
 */

$class = $class ?? '';
$text = $text ?? 'STARTSEITE';
?>

<a href="<?= url('/') ?>" class="inline-flex items-center text-primary hover:underline mb-12 <?= $class ?>">
    &larr;
    <?= $text ?>
</a>