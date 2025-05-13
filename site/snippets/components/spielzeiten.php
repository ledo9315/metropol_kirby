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

<div class="w-full" role="region" aria-labelledby="<?= $spielzeitenId ?>">
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

        // Angepasstes Datumsformat für die Anzeige
        $today = date('Y-m-d');
        $tomorrow = date('Y-m-d', strtotime('+1 day'));

        if ($dateKey == $today) {
            $displayDate = 'Heute';
        } elseif ($dateKey == $tomorrow) {
            $displayDate = 'Morgen';
        } else {
            $displayDate = date('d.m.', strtotime($dateKey));
        }

        $dateId = "date-" . md5($dateKey);

        foreach ($dateTimes as $spielzeit):
            $spielzeitId = "spielzeit-" . md5($dateKey . $spielzeit->time());
            ?>
            <div class="flex justify-between items-center py-3 border-b border-primary" role="group"
                aria-labelledby="<?= $dateId ?>">
                <div>
                    <span class="text-xl text-secondary">
                        <span id="<?= $dateId ?>" class="text-xl"><?= $displayDate ?></span> um
                        <?= $spielzeit->time()->toDate('H.i') ?>
                        Uhr
                    </span>
                </div>
                <div>
                    <span class="px-3 rounded-2xl py-0.5 mr-2 border border-gray-500 text-secondary text-sm font-medium"
                        aria-labelledby="<?= $spielzeitId ?>">
                        <?= $spielzeit->format() ?>
                    </span>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>