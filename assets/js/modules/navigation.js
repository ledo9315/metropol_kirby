export function initNavigation() {
  const menuButton = document.getElementById('menu-button');
  const menu = document.getElementById('menu');
  const menuClose = document.getElementById('menu-close');
  const dropdownButton = document.querySelector('.group button');
  const dropdownMenu = document.querySelector('.group ul');

  if (menuButton && menu) {
    menuButton.addEventListener('click', function () {
      const isHidden = menu.classList.contains('hidden');
      menu.classList.toggle('hidden');
      menuButton.setAttribute('aria-expanded', !isHidden);
      menuButton.setAttribute(
        'aria-label',
        isHidden ? 'Menü schließen' : 'Menü öffnen'
      );
    });
  }

  if (menuClose && menu) {
    menuClose.addEventListener('click', function () {
      menu.classList.add('hidden');
      menuButton.setAttribute('aria-expanded', 'false');
      menuButton.setAttribute('aria-label', 'Menü öffnen');
    });
  }

  window.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && menu && !menu.classList.contains('hidden')) {
      menu.classList.add('hidden');
      menuButton.setAttribute('aria-expanded', 'false');
      menuButton.setAttribute('aria-label', 'Menü öffnen');
    }
  });

  if (dropdownButton && dropdownMenu) {
    dropdownButton.addEventListener('focus', () => {
      dropdownMenu.classList.remove('opacity-0', 'pointer-events-none');
      dropdownMenu.classList.add('opacity-100', 'pointer-events-auto');
      dropdownButton.setAttribute('aria-expanded', 'true');
    });

    dropdownButton.addEventListener('blur', (e) => {
      setTimeout(() => {
        if (!dropdownMenu.contains(document.activeElement)) {
          dropdownMenu.classList.remove('opacity-100', 'pointer-events-auto');
          dropdownMenu.classList.add('opacity-0', 'pointer-events-none');
          dropdownButton.setAttribute('aria-expanded', 'false');
        }
      }, 200);
    });

    dropdownButton.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        const isExpanded =
          dropdownButton.getAttribute('aria-expanded') === 'true';
        dropdownButton.setAttribute('aria-expanded', !isExpanded);
        if (!isExpanded) {
          dropdownMenu.classList.remove('opacity-0', 'pointer-events-none');
          dropdownMenu.classList.add('opacity-100', 'pointer-events-auto');
        } else {
          dropdownMenu.classList.remove('opacity-100', 'pointer-events-auto');
          dropdownMenu.classList.add('opacity-0', 'pointer-events-none');
        }
      }
    });

    document.addEventListener('click', (e) => {
      if (
        !dropdownButton.contains(e.target) &&
        !dropdownMenu.contains(e.target)
      ) {
        dropdownMenu.classList.remove('opacity-100', 'pointer-events-auto');
        dropdownMenu.classList.add('opacity-0', 'pointer-events-none');
        dropdownButton.setAttribute('aria-expanded', 'false');
      }
    });
  }

  // Aktives Menüelement basierend auf Scroll aktualisieren
  // Nur auf der Startseite ausführen
  if (
    document.getElementById('programm') &&
    document.getElementById('demnaechst')
  ) {
    updateActiveNavOnScroll();
  }
}

function updateActiveNavOnScroll() {
  // Die Links zu den Ankerpunkten finden
  const programLink = document.querySelector('a[href*="#programm"]');
  const demnaechstLink = document.querySelector('a[href*="#demnaechst"]');

  // Explizit nach dem Startseiten-Link suchen (genaueres Targeting)
  const menuItems = document.querySelectorAll(
    'nav ul#menu > li > a[role="menuitem"]'
  );
  let startseiteLink = null;

  // Das erste Element in menuItems sollte der Startseiten-Link sein
  // Wir ignorieren das erste li mit dem Schließen-Button, das in der mobilen Ansicht erscheint
  if (menuItems && menuItems.length > 0) {
    for (let i = 0; i < menuItems.length; i++) {
      const item = menuItems[i];
      if (item.textContent.trim() === 'Startseite') {
        startseiteLink = item;
        break;
      }
    }
  }

  // Fallback: wenn nicht gefunden, nehmen wir das erste MenuItem
  if (!startseiteLink && menuItems && menuItems.length > 0) {
    startseiteLink = menuItems[0];
  }

  // Logge gefundene Elemente für Debugging
  console.log('Programm Link:', programLink);
  console.log('Demnächst Link:', demnaechstLink);
  console.log('Startseite Link:', startseiteLink);

  // Abbrechen, wenn die Links nicht existieren
  if (!programLink || !demnaechstLink || !startseiteLink) {
    console.log('Links nicht gefunden, Scroll-Highlighting deaktiviert');
    return;
  }

  // Sections finden
  const programSection = document.getElementById('programm');
  const demnaechstSection = document.getElementById('demnaechst');

  if (!programSection || !demnaechstSection) {
    console.log('Sections nicht gefunden, Scroll-Highlighting deaktiviert');
    return;
  }

  // Scroll-Event-Listener hinzufügen
  window.addEventListener('scroll', function () {
    const scrollPosition = window.scrollY + 100; // 100px Offset für die Header-Höhe

    // Aktuell aktiven Link entfernen
    const activeLinks = document.querySelectorAll(
      'nav a.border-primary[role="menuitem"]'
    );
    activeLinks.forEach((link) => {
      link.classList.remove('border-b', 'border-primary');
      if (link.hasAttribute('aria-current')) {
        link.removeAttribute('aria-current');
      }
    });

    // Basierend auf Scroll-Position aktives Element setzen
    if (
      demnaechstSection.offsetTop <= scrollPosition &&
      demnaechstSection.offsetTop + demnaechstSection.offsetHeight >
        scrollPosition
    ) {
      // Demnächst ist aktiv
      demnaechstLink.classList.add('border-b', 'border-primary');
      demnaechstLink.setAttribute('aria-current', 'page');
    } else if (
      programSection.offsetTop <= scrollPosition &&
      programSection.offsetTop + programSection.offsetHeight > scrollPosition
    ) {
      // Programm ist aktiv
      programLink.classList.add('border-b', 'border-primary');
      programLink.setAttribute('aria-current', 'page');
    } else if (scrollPosition < programSection.offsetTop) {
      // Startseite ist aktiv (wenn wir über allen Abschnitten sind)
      startseiteLink.classList.add('border-b', 'border-primary');
      startseiteLink.setAttribute('aria-current', 'page');
    }
  });

  // Initialen Status setzen
  window.dispatchEvent(new Event('scroll'));
}
