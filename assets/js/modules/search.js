/**
 * Proxy-Modul für die Filmsuche
 * @module search
 *
 * Dieses Modul delegiert alle Anfragen an das modularisierte Suchsystem
 * unter /search/index.js, um Abwärtskompatibilität zu gewährleisten.
 */

import { initSearch as originalInitSearch } from './search/index.js';

// Wrapper-Funktion zum Debuggen
export function initSearch() {
  console.log('Debug: Initialisiere Suchfunktion...');

  try {
    originalInitSearch();
    console.log('Debug: Suchfunktion erfolgreich initialisiert');
  } catch (error) {
    console.error('Fehler bei der Initialisierung der Suche:', error);
  }
}
