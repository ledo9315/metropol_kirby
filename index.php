<?php
/**
 * Hauptdatei der Metropol-Website
 * Enthält API-Endpunkt für Filmsuche und Kirby-Bootstrap
 */

// API-Endpunkt für Filmsuche
if (preg_match('/^\/api\/films/', $_SERVER['REQUEST_URI'])) {
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET');
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: DENY');

    parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY) ?? '', $query);
    $searchQuery = $query['q'] ?? '';

    require __DIR__ . '/kirby/bootstrap.php';
    $kirby = new Kirby([
        'roots' => [
            'index' => __DIR__,
            'base' => $base = __DIR__,
            'content' => $base . '/content',
            'site' => $base . '/site',
            'storage' => $storage = $base . '/storage',
            'accounts' => $storage . '/accounts',
            'cache' => $storage . '/cache',
            'sessions' => $storage . '/sessions',
        ]
    ]);

    $results = [];
    if (!empty($searchQuery)) {
        try {
            $programmPage = $kirby->page('programm');
            if ($programmPage) {
                $allMovies = $programmPage->children()->listed();

                // Filme nach Titel filtern
                $filteredMovies = $allMovies->filter(function ($film) use ($searchQuery) {
                    return stripos($film->title()->value(), strtolower($searchQuery)) !== false;
                });

                // Ergebnisse auf 8 begrenzen
                $filteredMovies = $filteredMovies->limit(8);

                foreach ($filteredMovies as $film) {
                    $filmData = [
                        'title' => (string) $film->title()->value(),
                        'url' => (string) $film->url()
                    ];

                    // Filmposter hinzufügen
                    if ($cover = $film->cover()->toFile()) {
                        $filmData['cover'] = (string) $cover->thumb(['width' => 160, 'height' => 224, 'crop' => true])->url();
                    } else {
                        $filmData['cover'] = '';
                    }

                    // Filmjahr hinzufügen
                    if ($film->year()->isNotEmpty()) {
                        $filmData['year'] = (string) $film->year()->value();
                    } else {
                        $filmData['year'] = '';
                    }

                    // FSK-Einstufung hinzufügen
                    if ($film->fsk()->isNotEmpty()) {
                        $filmData['fsk'] = (string) $film->fsk()->value();
                    } else {
                        $filmData['fsk'] = '';
                    }

                    // Hauptkategorie des Films ermitteln
                    $categories = getFilmCategories($film);
                    if (!empty($categories)) {
                        $filmData['category'] = (string) $categories[0];
                    } else {
                        $filmData['category'] = '';
                    }

                    $results[] = $filmData;
                }
            }
        } catch (Exception $e) {
            $results = [];
        }
    }

    echo json_encode($results, JSON_UNESCAPED_UNICODE);
    exit;
}

// Normaler Kirby-Start
require 'kirby/bootstrap.php';

$kirby = new Kirby([
    'roots' => [
        'index' => __DIR__,
        'base' => $base = __DIR__,
        'content' => $base . '/content',
        'site' => $base . '/site',
        'storage' => $storage = $base . '/storage',
        'accounts' => $storage . '/accounts',
        'cache' => $storage . '/cache',
        'sessions' => $storage . '/sessions',
    ]
]);

echo $kirby->render();
