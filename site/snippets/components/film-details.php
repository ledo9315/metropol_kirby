<?php
/**
 * Film-Details Snippet
 * Zeigt Filmdetails wie Jahr, Laufzeit, FSK und Produktionsland an
 */

if (!isset($film)) {
    return;
}

$details = [];
if ($film->year()->isNotEmpty())
    $details[] = $film->year();
if ($film->runtime()->isNotEmpty())
    $details[] = $film->runtime() . ' Min';
if ($film->fsk()->isNotEmpty())
    $details[] = 'FSK ' . $film->fsk();
if ($film->produktionsland()->isNotEmpty() && isset($showProductionCountry) && $showProductionCountry)
    $details[] = $film->produktionsland();

echo implode('<span class="text-primary "> | </span>', $details);
?>