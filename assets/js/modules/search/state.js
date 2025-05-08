/**
 * Status-Management für die Filmsuche
 * @module search/state
 */

import { SecurityUtils } from "./utils.js";

/**
 * Erstellt ein Status-Objekt für die Suchfunktion
 * @param {Object} elements - DOM-Elemente der Suche
 * @returns {Object} Status-Objekt mit Methoden
 */
export function createSearchState(elements) {
  return {
    // Zustandsvariablen
    isLoading: false,
    hasResults: false,
    isError: false,
    errorMessage: "",

    /**
     * Setzt den Status auf "Laden"
     */
    setLoading() {
      this.isLoading = true;
      this.hasResults = false;
      this.isError = false;
      this.updateUI();
    },

    /**
     * Setzt den Status auf "Ergebnisse"
     * @param {boolean} hasResults - Gibt an, ob Ergebnisse vorhanden sind
     */
    setResults(hasResults = true) {
      this.isLoading = false;
      this.hasResults = hasResults;
      this.isError = false;
      this.updateUI();
    },

    /**
     * Setzt den Status auf "Fehler"
     * @param {string} message - Die Fehlermeldung
     */
    setError(message) {
      this.isLoading = false;
      this.hasResults = false;
      this.isError = true;
      this.errorMessage = SecurityUtils.escapeHTML(message);
      this.updateUI();
    },

    /**
     * Aktualisiert die UI basierend auf dem aktuellen Zustand
     */
    updateUI() {
      const {
        loadingState,
        emptyState,
        errorState,
        resultsList,
        resultsCount,
        errorMessage,
        resultsDropdown,
      } = elements;

      // Alle Status-Container ausblenden
      [loadingState, emptyState, errorState, resultsList].forEach((el) =>
        el?.classList.add("hidden")
      );

      // Dropdown immer anzeigen, wenn wir einen Zustand haben - verstecken wird
      // durch reset() erledigt
      resultsDropdown?.classList.remove("hidden");

      // Status-spezifische Anzeige
      if (this.isLoading) {
        loadingState?.classList.remove("hidden");
        resultsCount.textContent = "Suche...";
      } else if (this.isError) {
        errorState?.classList.remove("hidden");
        errorMessage.textContent = this.errorMessage;
        resultsCount.textContent = "Fehler";
      } else if (!this.hasResults) {
        emptyState?.classList.remove("hidden");
        resultsCount.textContent = "Keine Ergebnisse";
      } else {
        resultsList?.classList.remove("hidden");
      }
    },

    /**
     * Setzt den Status zurück und versteckt die Ergebnisse
     */
    reset() {
      this.isLoading = false;
      this.hasResults = false;
      this.isError = false;

      elements.resultsDropdown?.classList.add("hidden");
      document.body.classList.remove("search-results-open");
    },
  };
}
