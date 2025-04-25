<?php

/**
 * Controller für die Sitemap.xml
 * Generiert eine XML-Sitemap für Suchmaschinen
 */
return function ($kirby) {
    $pages = $kirby->site()->index()->listed();

    // Content Type einstellen
    $kirby->response()->type('xml');

    // Seiten filtern, die nicht in der Sitemap erscheinen sollen
    $excludedTemplates = ['error'];
    $items = $pages->filterBy('template', 'not in', $excludedTemplates);

    // Datum des letzten Updates (aktuelle Zeit)
    $lastmod = date('c');

    return [
        'lastmod' => $lastmod,
        'items' => $items
    ];
};