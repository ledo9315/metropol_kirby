<?php

/**
 * Kirby Routes
 */
return [
  [
    'pattern' => 'programm',
    'action' => function () {
      // Leite zur Startseite weiter, wenn jemand direkt auf /programm zugreift
      go('/');
    }
  ],
  [
    'pattern' => 'api/films',
    'action' => function () {
      // CORS-Header für API-Anfragen
      header('Content-Type: application/json');
      header('Access-Control-Allow-Origin: *');
      header('Access-Control-Allow-Methods: GET');

      $query = get('q');
      $results = [];

      try {
        // Filme aus dem Programm holen
        $programmPage = page('programm');
        if ($programmPage && $query && strlen($query) >= 1) {
          $allMovies = $programmPage->children()->listed();

          // Filme filtern
          $filteredMovies = $allMovies->filter(function ($film) use ($query) {
            // Titel durchsuchen (am einfachsten und zuverlässigsten)
            return stripos($film->title()->value(), strtolower($query)) !== false;
          });

          // Nur die ersten 8 Ergebnisse
          $filteredMovies = $filteredMovies->limit(8);

          // Ergebnisse formatieren
          foreach ($filteredMovies as $film) {
            $filmData = [
              'title' => (string) $film->title()->value(),
              'url' => (string) $film->url()
            ];

            // Cover-Bild hinzufügen
            if ($cover = $film->cover()->toFile()) {
              $filmData['cover'] = (string) $cover->thumb(['width' => 160, 'height' => 224, 'crop' => true])->url();
            } else {
              $filmData['cover'] = '';
            }

            // Weitere grundlegende Informationen
            if ($film->year()->isNotEmpty()) {
              $filmData['year'] = (string) $film->year()->value();
            } else {
              $filmData['year'] = '';
            }

            // FSK hinzufügen
            if ($film->fsk()->isNotEmpty()) {
              $filmData['fsk'] = (string) $film->fsk()->value();
            } else {
              $filmData['fsk'] = '';
            }

            // Kategorie ermitteln (erste gefundene Kategorie)
            $categories = [];
            if ($film->familienfilm()->isTrue())
              $categories[] = 'Familienfilm';
            if ($film->animation()->isTrue())
              $categories[] = 'Animation';
            if ($film->fantasy()->isTrue())
              $categories[] = 'Fantasy';
            if ($film->liebesfilm()->isTrue())
              $categories[] = 'Liebesfilm';
            if ($film->maerchenfilm()->isTrue())
              $categories[] = 'Märchenfilm';
            if ($film->musical()->isTrue())
              $categories[] = 'Musical';
            if ($film->kinderfilm()->isTrue())
              $categories[] = 'Kinderfilm';
            if ($film->drama()->isTrue())
              $categories[] = 'Drama';
            if ($film->komoedie()->isTrue())
              $categories[] = 'Komödie';
            if ($film->action()->isTrue())
              $categories[] = 'Action';
            if ($film->abenteuer()->isTrue())
              $categories[] = 'Abenteuer';
            if ($film->horror()->isTrue())
              $categories[] = 'Horror';

            if (!empty($categories)) {
              $filmData['category'] = (string) $categories[0]; // Erste Kategorie verwenden
            } else {
              $filmData['category'] = '';
            }

            // Kurze Beschreibung entfernen, da sie Probleme verursachen könnte
            $results[] = $filmData;
          }
        }
      } catch (Exception $e) {
        // Bei Fehlern ein leeres Array zurückgeben
        $results = [];

        if (option('debug')) {
          header('X-Search-Error: ' . $e->getMessage());
        }
      }

      // JSON-Ausgabe
      echo json_encode($results);
      exit; // Explizit beenden, um sicherzustellen, dass keine weiteren Inhalte gesendet werden
    }
  ]
];