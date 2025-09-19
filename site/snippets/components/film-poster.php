<?php
/**
 * Film-Poster Snippet
 * Zeigt das Poster eines Films an oder einen Platzhalter, wenn keines vorhanden ist
 */

if (!isset($film)) {
    return;
}

$width = isset($width) ? $width : 400;
$height = isset($height) ? $height : 600;
$class = isset($class) ? $class : 'w-full h-auto';
$lazy = isset($lazy) && $lazy ? 'lazy' : 'eager';
$effect = isset($effect) && $effect ? 'group-hover:scale-105 transition-transform duration-300' : '';

if ($cover = $film->cover()->toFile()):
    $thumb = isset($useThumb) && $useThumb ? $cover->thumb(['width' => $width, 'height' => $height]) : $cover;
    ?>
    <img src="<?= $thumb->url() ?>" alt="<?= $film->title() ?>" class="<?= $class ?> <?= $effect ?> shadow"
        loading="<?= $lazy ?>" width="<?= $thumb->width() ?>" height="<?= $thumb->height() ?>" role="img">
<?php else: ?>
    <div class="w-full aspect-[2/3] bg-gray-200 flex items-center justify-center text-sm sm:text-base shadow" role="img"
        aria-label="Kein Filmposter für <?= $film->title() ?> verfügbar">
        <span class="text-gray-500">Kein Filmposter</span>
    </div>
<?php endif; ?>