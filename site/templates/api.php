<?php
// Filme API-Endpunkt
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');

$path = kirby()->request()->path()->toString();
$parts = explode('/', $path);

if (count($parts) > 1 && $parts[0] === 'api') {
    $endpoint = $parts[1] ?? '';

    if ($endpoint === 'films') {
        $query = get('q');
        $results = [];

        try {
            $programmPage = page('programm');
            if ($programmPage && $query && strlen($query) >= 1) {
                $allMovies = $programmPage->children()->listed();

                $filteredMovies = $allMovies->filter(function ($film) use ($query) {
                    return stripos($film->title()->value(), strtolower($query)) !== false;
                });

                $filteredMovies = $filteredMovies->limit(8);

                foreach ($filteredMovies as $film) {
                    $filmData = [
                        'title' => $film->title()->value(),
                        'url' => $film->url()
                    ];

                    if ($cover = $film->cover()->toFile()) {
                        $filmData['cover'] = $cover->thumb(['width' => 100, 'height' => 140, 'crop' => true])->url();
                    }

                    if ($film->year()->isNotEmpty()) {
                        $filmData['year'] = $film->year()->value();
                    }

                    $results[] = $filmData;
                }
            }
        } catch (Exception $e) {
            $results = [];

            if (option('debug')) {
                header('X-Search-Error: ' . $e->getMessage());
            }
        }

        echo json_encode($results);
        exit;
    } else {
        echo json_encode(['error' => 'Unknown API endpoint']);
        exit;
    }
} else {
    echo json_encode(['endpoints' => ['films' => '/api/films?q=suchbegriff']]);
    exit;
}