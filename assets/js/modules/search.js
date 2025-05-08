/**
 * Proxy-Modul für die Filmsuche
 * @module search
 *
 * Dieses Modul delegiert alle Anfragen an das modularisierte Suchsystem
 * unter /search/index.js, um Abwärtskompatibilität zu gewährleisten.
 */

import { initSearch } from "./search/index.js";

// Exportiere die Hauptfunktion zur Initialisierung der Suche
export { initSearch };
