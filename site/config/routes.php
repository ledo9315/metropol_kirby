<?php

/**
 * Kirby Routes
 */
return [
  [
    'pattern' => 'programm',
    'action'  => function() {
      // Leite zur Startseite weiter, wenn jemand direkt auf /programm zugreift
      go('/');
    }
  ]
]; 