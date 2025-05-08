/**
 * Hauptmodul für die Filmsuche - importiert und exportiert alle Komponenten
 * @module search
 */

// Konstanten
const DEBOUNCE_DELAY = 300;
const MOBILE_BREAKPOINT = 768;

// Submodule importieren
import { SecurityUtils, BrowserUtils, DOMUtils } from "./utils.js";
import { createSearchState } from "./state.js";
import { SearchUI, OverlayManager, FormStyles } from "./ui.js";
import { SearchAPI } from "./api.js";

// DOM-Elemente Cache
let elements = {
  searchInput: null,
  searchForm: null,
  searchContainer: null,
  searchToggle: null,
  searchClose: null,
  resultsDropdown: null,
  resultsCount: null,
  resultsList: null,
  loadingState: null,
  emptyState: null,
  errorState: null,
  errorMessage: null,
};

// Zustandsvariablen
let searchState = null;
let debounceTimer = null;

/**
 * Initialisiert die Suchfunktionalität
 */
export function initSearch() {
  // DOM-Elemente abrufen und Event-Listener hinzufügen
  if (!cacheElements() || !validateRequiredElements()) return;

  // Status-Objekt erstellen
  searchState = createSearchState(elements);

  // Event-Listener hinzufügen
  attachEventListeners();
}

/**
 * Speichert alle benötigten DOM-Elemente
 * @returns {boolean} Erfolg
 */
function cacheElements() {
  const selectors = {
    searchInput: "#search-input",
    searchForm: "#search-form",
    searchContainer: "#search-container",
    searchToggle: "#search-toggle",
    searchClose: "#search-close",
    resultsDropdown: "#search-results-dropdown",
    resultsCount: "#search-results-count",
    resultsList: "#search-results-list",
    loadingState: ".search-loading-state",
    emptyState: ".search-empty-state",
    errorState: ".search-error-state",
    errorMessage: "#search-error-message",
  };

  // Alle Elemente in einem Durchgang sammeln
  for (const [key, selector] of Object.entries(selectors)) {
    elements[key] = selector.startsWith("#")
      ? document.getElementById(selector.substring(1))
      : document.querySelector(selector);
  }

  return true;
}

/**
 * Prüft, ob alle erforderlichen Elemente vorhanden sind
 * @returns {boolean} True, wenn alle erforderlichen Elemente vorhanden sind
 */
function validateRequiredElements() {
  const requiredElements = [
    "searchInput",
    "searchForm",
    "searchContainer",
    "resultsDropdown",
  ];
  return requiredElements.every((key) => elements[key]);
}

/**
 * Fügt alle Event-Listener hinzu
 */
function attachEventListeners() {
  // Event-Map für einfacheres Hinzufügen
  const events = [
    {
      element: elements.searchInput,
      event: "input",
      handler: handleSearchInput,
    },
    {
      element: elements.searchInput,
      event: "focus",
      handler: handleInputFocus,
    },
    {
      element: elements.searchForm,
      event: "submit",
      handler: handleFormSubmit,
    },
    {
      element: elements.searchToggle,
      event: "click",
      handler: handleSearchToggle,
    },
    {
      element: elements.searchClose,
      event: "click",
      handler: handleSearchClose,
    },
    { element: document, event: "click", handler: handleOutsideClick },
    { element: document, event: "keydown", handler: handleKeyDown },
    { element: window, event: "resize", handler: handleResize },
  ];

  // Event-Listener hinzufügen
  events.forEach(({ element, event, handler }) => {
    element?.addEventListener(event, handler);
  });
}

// --- Event-Handler ---

/**
 * Behandelt die Eingabe im Suchfeld
 */
function handleSearchInput(e) {
  clearTimeout(debounceTimer);
  const query = e.target.value.trim();

  if (query.length < 1) {
    searchState.reset();
    return;
  }

  searchState.setLoading();
  if (BrowserUtils.isMobile(MOBILE_BREAKPOINT)) {
    document.body.classList.add("search-results-open");
  }

  debounceTimer = setTimeout(() => fetchSearchResults(query), DEBOUNCE_DELAY);
}

/**
 * Behandelt den Fokus auf das Eingabefeld
 */
function handleInputFocus() {
  const query = elements.searchInput.value.trim();
  const hasExistingResults =
    query.length >= 1 &&
    elements.resultsList.children.length > 0 &&
    !elements.resultsDropdown.classList.contains("hidden");

  if (!hasExistingResults && query.length >= 1) {
    elements.searchInput.dispatchEvent(new Event("input", { bubbles: true }));
  }
}

/**
 * Behandelt die Absendung des Suchformulars
 */
function handleFormSubmit(event) {
  event.preventDefault();
  const query = elements.searchInput.value.trim();

  if (!query) {
    elements.searchInput.focus();
    return;
  }

  searchState.setLoading();
  if (BrowserUtils.isMobile(MOBILE_BREAKPOINT)) {
    document.body.classList.add("search-results-open");
  }

  fetchSearchResults(query, true);
}

/**
 * Behandelt Klicks auf den Such-Toggle-Button
 */
function handleSearchToggle() {
  toggleSearch();
  const isExpanded = !elements.searchForm.classList.contains("hidden");
  elements.searchToggle.setAttribute("aria-expanded", String(isExpanded));
}

/**
 * Behandelt Klicks auf den Such-Schließen-Button
 */
function handleSearchClose() {
  toggleSearch(false);
  elements.searchToggle.setAttribute("aria-expanded", "false");
}

/**
 * Behandelt Klicks außerhalb des Suchbereichs
 */
function handleOutsideClick(event) {
  const overlay = document.getElementById("search-overlay");
  const isOutside =
    !elements.searchContainer.contains(event.target) &&
    event.target !== overlay;

  if (isOutside) {
    searchState.reset();

    if (!elements.searchForm.classList.contains("hidden")) {
      toggleSearch(false);
      elements.searchToggle.setAttribute("aria-expanded", "false");
    }
  }
}

/**
 * Behandelt Tastatureingaben (Escape)
 */
function handleKeyDown(event) {
  if (event.key === "Escape") {
    if (!elements.searchForm.classList.contains("hidden")) {
      toggleSearch(false);
      elements.searchToggle.setAttribute("aria-expanded", "false");
    }

    searchState.reset();
  }
}

/**
 * Behandelt Änderungen der Fenstergröße
 */
function handleResize() {
  if (elements.searchForm.classList.contains("hidden")) return;

  const isMobileView = BrowserUtils.isMobile(MOBILE_BREAKPOINT);
  const isCurrentlyMobile = elements.searchForm.classList.contains("fixed");

  if (isMobileView === isCurrentlyMobile) return;

  if (isMobileView) {
    // Desktop -> Mobile
    FormStyles.resetStyles(elements.searchForm);
    FormStyles.applyMobileStyles(elements.searchForm);
    showOverlay();
    document.body.classList.add("overflow-hidden");
  } else {
    // Mobile -> Desktop
    FormStyles.removeMobileStyles(elements.searchForm);

    const overlay = document.getElementById("search-overlay");
    overlay?.classList.add("hidden");

    document.body.classList.remove("overflow-hidden");
  }
}

/**
 * Behandelt Klicks auf ein Suchergebnis
 */
function handleResultClick(event) {
  const url = this.getAttribute("href");
  if (url && url !== "#") {
    event.preventDefault();
    SearchAPI.navigateToFilm(url);
  }
}

// --- API und Datenverarbeitung ---

/**
 * Ruft die Suchergebnisse von der API ab
 */
async function fetchSearchResults(query, isFormSubmit = false) {
  try {
    const data = await SearchAPI.search(query);

    // Bei genau einem Ergebnis und Formular-Submit direkt zur Filmseite
    if (isFormSubmit && data?.length === 1) {
      SearchAPI.navigateToFilm(data[0].url);
      return;
    }

    updateSearchResults(data);
  } catch (error) {
    console.error("Fehler bei der Filmsuche:", error);
    searchState.setError(error.message);
  }
}

/**
 * Aktualisiert die Suchergebnisse
 */
function updateSearchResults(data) {
  if (!data || data.length === 0) {
    searchState.setResults(false);
    return;
  }

  searchState.setResults(true);

  // Ergebniszähler aktualisieren
  elements.resultsCount.textContent = `${data.length} Film${
    data.length !== 1 ? "e" : ""
  } gefunden`;

  // Ergebnisse rendern
  SearchUI.renderSearchResults(data, elements.resultsList, handleResultClick);

  // Sicherstellen, dass das Dropdown-Menü scrollbar ist
  ensureDropdownScrollable();
}

/**
 * Stellt sicher, dass das Dropdown-Menü scrollbar ist
 */
function ensureDropdownScrollable() {
  if (elements.resultsDropdown) {
    // Stelle sicher, dass das Dropdown-Menü scrollbar ist
    elements.resultsDropdown.style.overflowY = "auto";

    // Scroll zum Anfang zurücksetzen
    elements.resultsDropdown.scrollTop = 0;
  }
}

// --- UI-Management ---

/**
 * Aktiviert/Deaktiviert die Suche
 */
function toggleSearch(show = null) {
  const shouldShow =
    show === null ? elements.searchForm.classList.contains("hidden") : show;

  if (shouldShow) {
    showSearchForm();
  } else {
    hideSearchForm();
  }
}

/**
 * Zeigt das Suchformular an
 */
function showSearchForm() {
  elements.searchForm.classList.remove("hidden");

  if (BrowserUtils.isMobile(MOBILE_BREAKPOINT)) {
    showOverlay();
    FormStyles.applyMobileStyles(elements.searchForm);
    document.body.classList.add("overflow-hidden");

    setTimeout(() => elements.searchInput.focus(), 100);
  } else {
    // Desktop-Animation
    FormStyles.animateFormIn(elements.searchForm, () => {
      elements.searchInput.focus();
    });
  }
}

/**
 * Versteckt das Suchformular
 */
function hideSearchForm() {
  if (BrowserUtils.isMobile(MOBILE_BREAKPOINT)) {
    hideOverlay();
    elements.searchForm.classList.add("hidden");
    searchState.reset();
    document.body.classList.remove("overflow-hidden", "search-results-open");
  } else {
    // Desktop-Animation
    FormStyles.animateFormOut(elements.searchForm, () => {
      elements.searchForm.classList.add("hidden");
      FormStyles.resetStyles(elements.searchForm);
      searchState.reset();
    });
  }

  elements.searchInput.value = "";
}

/**
 * Zeigt das Overlay für die mobile Ansicht an
 */
function showOverlay() {
  OverlayManager.show(() => {
    toggleSearch(false);
    elements.searchToggle?.setAttribute("aria-expanded", "false");
  });
}

/**
 * Versteckt das Overlay
 */
function hideOverlay() {
  OverlayManager.hide();
}
