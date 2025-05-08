/**
 * API-Funktionen für die Filmsuche
 * @module search/api
 */

import { SecurityUtils } from "./utils.js";

/**
 * Konstanten für API-Endpunkte
 */
const API_ENDPOINTS = {
  SEARCH: "/api/films",
};

/**
 * API-Client für die Filmsuche
 */
export const SearchAPI = {
  /**
   * Führt eine Suchanfrage durch
   * @param {string} query - Die Suchanfrage
   * @returns {Promise<Array>} Promise mit den Suchergebnissen
   */
  async search(query) {
    try {
      // Eingabevalidierung für Sicherheit
      const sanitizedQuery = SecurityUtils.sanitizeQuery(query);

      const response = await fetch(
        `${API_ENDPOINTS.SEARCH}?q=${encodeURIComponent(sanitizedQuery)}`
      );

      if (!response.ok) {
        throw new Error(`Netzwerkfehler: ${response.status}`);
      }

      const text = await response.text();

      if (!text || text.trim() === "") {
        return [];
      }

      try {
        return JSON.parse(text);
      } catch (e) {
        console.error("JSON Parse Error:", e);
        throw new Error("Ungültiges JSON-Format");
      }
    } catch (error) {
      console.error("API-Fehler:", error);
      throw error;
    }
  },

  /**
   * Navigiert zur Detailseite eines Films
   * @param {string} url - Die URL zur Filmdetailseite
   */
  navigateToFilm(url) {
    // URL validieren
    const safeUrl = SecurityUtils.sanitizeUrl(url);
    window.location.href = safeUrl;
  },
};
