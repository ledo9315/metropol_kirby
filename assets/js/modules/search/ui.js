/**
 * UI-Komponenten für die Filmsuche
 * @module search/ui
 */

import { SecurityUtils, DOMUtils, createPlaceholderImage } from './utils.js';

/**
 * UI-Komponenten für die Suchfunktion
 */
export const SearchUI = {
  /**
   * Erstellt ein einzelnes Suchergebnis-Element
   * @param {Object} film - Die Filmdaten
   * @param {Function} clickHandler - Klick-Handler für das Ergebnis
   * @returns {HTMLElement} Das erstellte Listenelement
   */
  createResultItem(film, clickHandler) {
    // Daten extrahieren, validieren und escapen
    const data = {
      title: SecurityUtils.escapeHTML(
        typeof film.title === 'string' ? film.title : ''
      ),
      year: SecurityUtils.escapeHTML(
        typeof film.year === 'string' ? film.year : ''
      ),
      category: SecurityUtils.escapeHTML(
        typeof film.category === 'string' ? film.category : ''
      ),
      fsk: SecurityUtils.escapeHTML(
        typeof film.fsk === 'string' ? film.fsk : ''
      ),
      url: SecurityUtils.sanitizeUrl(
        typeof film.url === 'string' ? film.url : '#'
      ),
      cover: typeof film.cover === 'string' ? film.cover : '',
    };

    // Element erstellen
    const li = DOMUtils.createElement('li', {
      className:
        'mb-6 last:mb-0 border-b border-gray-200 last:border-0 pb-5 last:pb-0',
      role: 'option',
    });

    // Link erstellen
    const a = DOMUtils.createElement('a', {
      href: data.url,
      className:
        'block hover:bg-gray-50 transition-all duration-200 rounded-lg hover:shadow-md overflow-hidden',
    });

    // Event-Listener für Klicks hinzufügen
    a.addEventListener('click', clickHandler);

    // Container erstellen
    const flexContainer = DOMUtils.createElement('div', {
      className: 'flex p-0',
    });

    // Bildbehälter erstellen
    const imageContainer = DOMUtils.createElement('div', {
      className: 'w-32 h-44 flex-shrink-0 bg-gray-100 overflow-hidden',
    });

    // Bild oder Placeholder einfügen
    if (data.cover) {
      const img = DOMUtils.createElement('img', {
        src: data.cover, // Cover-URL sollte vom Backend validiert sein
        alt: '',
        className: 'w-full h-full object-cover',
      });
      imageContainer.appendChild(img);
    } else {
      imageContainer.innerHTML = createPlaceholderImage();
    }

    // Textbehälter erstellen
    const textContainer = DOMUtils.createElement('div', {
      className: 'flex-grow p-5',
    });

    // Titel einfügen
    const title = DOMUtils.createElement('h4', {
      className: 'font-medium text-primary text-xl mb-3',
      textContent: data.title,
    });
    textContainer.appendChild(title);

    // Details-Container
    const detailsContainer = DOMUtils.createElement('div', {
      className: 'flex flex-col space-y-2',
    });

    // Jahr hinzufügen (wenn vorhanden)
    if (data.year) {
      const yearDiv = DOMUtils.createElement('div', {
        className: 'font-medium text-base',
        textContent: data.year,
      });
      detailsContainer.appendChild(yearDiv);
    }

    // Kategorie hinzufügen (wenn vorhanden)
    if (data.category) {
      const categoryDiv = DOMUtils.createElement('div');
      const categorySpan = DOMUtils.createElement('span', {
        className:
          'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/10 text-primary',
        textContent: data.category,
      });
      categoryDiv.appendChild(categorySpan);
      detailsContainer.appendChild(categoryDiv);
    }

    // FSK hinzufügen (wenn vorhanden)
    if (data.fsk) {
      const fskDiv = DOMUtils.createElement('div', {
        className: 'text-sm text-gray-600',
        textContent: `FSK ${data.fsk}`,
      });
      detailsContainer.appendChild(fskDiv);
    }

    // Alles zusammenfügen
    textContainer.appendChild(detailsContainer);
    flexContainer.appendChild(imageContainer);
    flexContainer.appendChild(textContainer);
    a.appendChild(flexContainer);
    li.appendChild(a);

    return li;
  },

  /**
   * Rendert die Suchergebnisse
   * @param {Array} films - Die Filmdaten
   * @param {HTMLElement} container - Der Container für die Ergebnisse
   * @param {Function} clickHandler - Klick-Handler für die Ergebnisse
   */
  renderSearchResults(films, container, clickHandler) {
    // Liste leeren
    DOMUtils.emptyElement(container);

    // DocumentFragment für bessere Performance
    const fragment = document.createDocumentFragment();

    // Ergebnisse rendern
    films.forEach((film) => {
      try {
        const listItem = this.createResultItem(film, clickHandler);
        fragment.appendChild(listItem);
      } catch (error) {
        console.error('Fehler beim Rendern eines Suchergebnisses:', error);
      }
    });

    // Alles auf einmal anhängen
    container.appendChild(fragment);
  },
};

/**
 * Overlay-Management
 */
export const OverlayManager = {
  /**
   * Zeigt das Overlay an
   * @param {Function} clickHandler - Klick-Handler für das Overlay
   * @returns {HTMLElement} Das Overlay-Element
   */
  show(clickHandler) {
    let overlay = document.getElementById('search-overlay');

    if (!overlay) {
      overlay = DOMUtils.createElement('div', {
        id: 'search-overlay',
        className: 'fixed inset-0 bg-black bg-opacity-10 z-[30]',
      });
      document.body.appendChild(overlay);

      // Event-Listener manuell hinzufügen
      overlay.addEventListener('click', clickHandler);
    } else {
      overlay.classList.remove('hidden');

      // Sicherstellen, dass der Event-Listener auch nach einem Verstecken/Zeigen noch aktiv ist
      overlay.addEventListener('click', clickHandler);
    }

    return overlay;
  },

  /**
   * Versteckt das Overlay
   */
  hide() {
    const overlay = document.getElementById('search-overlay');
    if (overlay) overlay.classList.add('hidden');
  },
};

/**
 * Mobile Formular-Styles
 */
export const FormStyles = {
  /**
   * Wendet mobile Styles auf das Suchformular an
   * @param {HTMLElement} form - Das Formular-Element
   */
  applyMobileStyles(form) {
    const mobileClasses = [
      'flex',
      'items-center',
      'fixed',
      'top-[70px]',
      'right-4',
      'p-3',
      'z-[500]',
      'w-[calc(100vw-2rem)]',
      'max-w-[320px]',
    ];

    DOMUtils.addClass(form, mobileClasses);
  },

  /**
   * Entfernt mobile Styles vom Suchformular
   * @param {HTMLElement} form - Das Formular-Element
   */
  removeMobileStyles(form) {
    const mobileClasses = [
      'fixed',
      'top-[70px]',
      'right-4',
      'p-3',
      'z-[200]',
      'w-[calc(100vw-2rem)]',
      'max-w-[320px]',
    ];

    DOMUtils.removeClass(form, mobileClasses);
    DOMUtils.addClass(form, ['flex', 'items-center', 'ml-2', 'z-[100]']);
  },

  /**
   * Setzt die Formular-Stile zurück
   * @param {HTMLElement} form - Das Formular-Element
   */
  resetStyles(form) {
    form.style.transition = '';
    form.style.width = '';
    form.style.opacity = '';
  },

  /**
   * Startet die Einblend-Animation für das Formular
   * @param {HTMLElement} form - Das Formular-Element
   * @param {Function} callback - Callback nach Abschluss der Animation
   */
  animateFormIn(form, callback) {
    form.style.cssText =
      'width:0; opacity:0; transition:width 0.3s ease-out, opacity 0.2s ease-out';

    // Animation in zwei Schritten
    requestAnimationFrame(() => {
      form.style.width = '200px';
      form.style.opacity = '1';

      if (callback) {
        setTimeout(callback, 300);
      }
    });
  },

  /**
   * Startet die Ausblend-Animation für das Formular
   * @param {HTMLElement} form - Das Formular-Element
   * @param {Function} callback - Callback nach Abschluss der Animation
   */
  animateFormOut(form, callback) {
    form.style.width = '0';
    form.style.opacity = '0';

    if (callback) {
      setTimeout(callback, 300);
    }
  },
};
