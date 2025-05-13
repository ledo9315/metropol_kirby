<?php
/**
 * Spielzeiten Snippet
 * Zeigt die Spielzeiten eines Films an
 */

if (!isset($spielzeiten) || !$spielzeiten->count()) {
    return;
}

$spielzeitenByDate = formatSpielzeiten($spielzeiten);
ksort($spielzeitenByDate);

$spielzeitenId = "spielzeiten-" . uniqid();
?>

<div class="lg:max-w-xl 2xl:max-w-2xl" role="region" aria-labelledby="<?= $spielzeitenId ?>">
    <?php if (isset($showHeading) && $showHeading): ?>
        <h2 id="<?= $spielzeitenId ?>" class="text-5xl font-[300] text-primary mb-6">Spielzeiten</h2>
    <?php else: ?>
        <span id="<?= $spielzeitenId ?>" class="sr-only">Spielzeiten</span>
    <?php endif; ?>

    <?php
    foreach ($spielzeitenByDate as $dateKey => $dateTimes):
        usort($dateTimes, function ($a, $b) {
            return strtotime($a->time()) - strtotime($b->time());
        });

        $dateInfo = getDateDisplay($dateKey);
        $subtitleDisplay = $dateInfo['isToday'] ? '<div class="text-sm text-gray-500">HEUTE</div>' : '';
        $dateId = "date-" . md5($dateKey);
        ?>
        <div class="flex justify-between items-center py-3 border-b border-primary pt-[1em] pb-[4em]" role="group"
            aria-labelledby="<?= $dateId ?>">
            <div class="w-max">
                <div id="<?= $dateId ?>" class="text-xl text-secondary"><?= $dateInfo['display'] ?></div>
                <?= $subtitleDisplay ?>
            </div>
            <div class="flex flex-wrap" role="list">
                <?php foreach ($dateTimes as $spielzeit):
                    $spielzeitId = "spielzeit-" . md5($dateKey . $spielzeit->time());
                    ?>
                    <div class="flex items-center mr-8 gap-1" role="listitem">
                        <span id="<?= $spielzeitId ?>" class="text-xl text-secondary"><?= $spielzeit->time()->toDate('H:i') ?>
                        </span>
                        <span class="px-3 rounded-2xl py-0.5 border border-gray-500 text-secondary text-sm font-medium"
                            aria-labelledby="<?= $spielzeitId ?>">
                            <?= $spielzeit->format() ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>