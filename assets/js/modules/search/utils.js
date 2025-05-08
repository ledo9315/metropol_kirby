/**
 * Utilities für die Filmsuche
 * @module search/utils
 */

/**
 * Sicherheits-Utilities zum Schutz vor XSS-Angriffen und anderen Sicherheitsproblemen
 */
export const SecurityUtils = {
  /**
   * Escaped HTML-Sonderzeichen, um XSS-Angriffe zu verhindern
   * @param {string} str - Zu escapende Zeichenkette
   * @returns {string} Escapte Zeichenkette
   */
  escapeHTML(str) {
    if (!str || typeof str !== "string") return "";

    return str
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
  },

  /**
   * Validiert eine URL
   * @param {string} url - Zu validierende URL
   * @returns {string} Validierte URL oder Fallback
   */
  sanitizeUrl(url) {
    if (!url || typeof url !== "string") return "#";

    // Nur bestimmte URL-Formate erlauben
    if (url === "#") return "#";

    // Relative URLs beginnen mit / oder sind für interne Verlinkungen
    if (
      url.startsWith("/") ||
      url.match(/^https?:\/\/[^/]+\/film\//) ||
      url.match(/^https?:\/\/[^/]+\/programm\//)
    ) {
      return url;
    }

    // Für absolute URLs nur bestimmte Domains erlauben (für externe Links)
    // Da hier nur interne Links relevant sind, wird immer # zurückgegeben
    return "#";
  },

  /**
   * Sanitize Suchanfrage
   * @param {string} query - Die Suchanfrage
   * @returns {string} Die bereinigte Suchanfrage
   */
  sanitizeQuery(query) {
    if (!query || typeof query !== "string") return "";
    return query.replace(/[<>"'&]/g, "");
  },
};

/**
 * DOM-Hilfsfunktionen
 */
export const DOMUtils = {
  /**
   * Erstellt ein HTML-Element mit den angegebenen Attributen
   * @param {string} tag - HTML-Tag
   * @param {Object} attributes - Attribute für das Element
   * @param {string|Node|Array} [children] - Kind-Elemente oder Text
   * @returns {HTMLElement} Das erstellte Element
   */
  createElement(tag, attributes = {}, children = null) {
    const element = document.createElement(tag);

    // Attribute setzen
    Object.entries(attributes).forEach(([key, value]) => {
      if (key === "className") {
        element.className = value;
      } else if (key === "textContent") {
        element.textContent = value;
      } else if (key.startsWith("on") && typeof value === "function") {
        element.addEventListener(key.substring(2).toLowerCase(), value);
      } else {
        element.setAttribute(key, value);
      }
    });

    // Kinder hinzufügen
    if (children) {
      if (Array.isArray(children)) {
        children.forEach((child) => {
          if (child instanceof Node) {
            element.appendChild(child);
          } else if (child !== null && child !== undefined) {
            element.appendChild(document.createTextNode(String(child)));
          }
        });
      } else if (children instanceof Node) {
        element.appendChild(children);
      } else if (children !== null && children !== undefined) {
        element.textContent = String(children);
      }
    }

    return element;
  },

  /**
   * Erstellt ein HTML-Fragment aus einer HTML-Zeichenkette
   * @param {string} html - HTML-Zeichenkette
   * @returns {DocumentFragment} Das erstellte Fragment
   */
  createFragment(html) {
    const template = document.createElement("template");
    template.innerHTML = html.trim();
    return template.content.cloneNode(true);
  },

  /**
   * Leert ein Element
   * @param {HTMLElement} element - Das zu leerende Element
   */
  emptyElement(element) {
    while (element.firstChild) {
      element.removeChild(element.firstChild);
    }
  },

  /**
   * Fügt ein oder mehrere CSS-Klassen zu einem Element hinzu
   * @param {HTMLElement} element - Das Element
   * @param {string|Array<string>} classes - Die CSS-Klasse(n)
   */
  addClass(element, classes) {
    if (!element) return;

    if (Array.isArray(classes)) {
      element.classList.add(...classes);
    } else {
      element.classList.add(classes);
    }
  },

  /**
   * Entfernt eine oder mehrere CSS-Klassen von einem Element
   * @param {HTMLElement} element - Das Element
   * @param {string|Array<string>} classes - Die CSS-Klasse(n)
   */
  removeClass(element, classes) {
    if (!element) return;

    if (Array.isArray(classes)) {
      element.classList.remove(...classes);
    } else {
      element.classList.remove(classes);
    }
  },
};

/**
 * Browser- und Umgebungs-Hilfsfunktionen
 */
export const BrowserUtils = {
  /**
   * Prüft, ob die Ansicht mobil ist
   * @param {number} [breakpoint=768] - Der Breakpoint für mobile Ansichten
   * @returns {boolean} True, wenn die Ansicht mobil ist
   */
  isMobile(breakpoint = 768) {
    return window.innerWidth < breakpoint;
  },

  /**
   * Erstellt eine Debounce-Funktion
   * @param {Function} func - Die zu debouncende Funktion
   * @param {number} wait - Die Wartezeit in Millisekunden
   * @returns {Function} Die debounced Funktion
   */
  debounce(func, wait) {
    let timeout;

    return function executedFunction(...args) {
      const later = () => {
        clearTimeout(timeout);
        func(...args);
      };

      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
    };
  },
};

/**
 * Erstellt ein Platzhalter-Bild (sicher, da statischer SVG-Code)
 * @returns {string} HTML für ein Platzhalter-Bild
 */
export function createPlaceholderImage() {
  return `
    <div class="w-full h-full flex items-center justify-center bg-gray-200">
      <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
      </svg>
    </div>
  `;
}
