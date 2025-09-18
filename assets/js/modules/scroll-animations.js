import { gsap } from 'https://cdn.skypack.dev/gsap@3.12.5';
import { ScrollTrigger } from 'https://cdn.skypack.dev/gsap@3.12.5/ScrollTrigger';

export function initScrollAnimations() {
  if (typeof window === 'undefined') return;

  gsap.registerPlugin(ScrollTrigger);

  const prefersReduced = window.matchMedia(
    '(prefers-reduced-motion: reduce)'
  ).matches;
  if (prefersReduced) return;

  // Utility: reveal animation
  const reveal = (elements, options = {}) => {
    const items = Array.from(document.querySelectorAll(elements));
    if (items.length === 0) return;

    items.forEach((el, index) => {
      gsap.from(el, {
        opacity: 0,
        y: 24,
        duration: 0.6,
        ease: 'power2.out',
        delay: Math.min(index * 0.05, 0.4),
        scrollTrigger: {
          trigger: el,
          start: 'top 85%',
          toggleActions: 'play none none reverse',
          once: true,
          ...options.scrollTrigger,
        },
        ...options.props,
      });
    });
  };

  // Programm-Artikel
  reveal('#programm article', {
    props: { y: 28, duration: 0.65 },
  });

  // Demnächst-Karten
  reveal('#demnaechst .grid article', {
    props: { y: 22, duration: 0.55 },
  });

  // Überschriften leicht einblenden
  reveal('#programm-heading, #demnaechst-heading', {
    props: { y: 10, duration: 0.5 },
  });

  // Geschichte-Seite: sanfte Reveals
  const geschichteFeed = document.querySelector(
    'section[aria-label="Chronik der Kino-Geschichte"]'
  );
  const geschichteHero = document.querySelector(
    'section[aria-label="Historisches Titelbild"]'
  );
  const geschichteZahlen = document.querySelector(
    'section[aria-label="Meilensteine in Zahlen"]'
  );

  if (geschichteHero) {
    // Titel und Intro einblenden
    reveal(
      'section[aria-label="Historisches Titelbild"] h1, section[aria-label="Historisches Titelbild"] p',
      { props: { y: 14, duration: 0.55 } }
    );
  }

  if (geschichteZahlen) {
    // Drei Kennzahlen-Karten
    reveal('section[aria-label="Meilensteine in Zahlen"] .grid > div', {
      props: { y: 16, duration: 0.5 },
    });
  }

  if (geschichteFeed) {
    // Jahres-Trenner
    reveal(
      'section[aria-label="Chronik der Kino-Geschichte"] [aria-hidden="true"]',
      { props: { y: 10, duration: 0.45 } }
    );

    // Chronik-Artikel
    reveal('section[aria-label="Chronik der Kino-Geschichte"] article', {
      props: { y: 22, duration: 0.55 },
    });

    // Bilder innerhalb von Collagen leicht verzögert
    reveal('section[aria-label="Chronik der Kino-Geschichte"] article img', {
      props: { y: 12, duration: 0.4 },
    });
  }

  // Ausstattung-Seite: sanfte Reveals
  const ausstattungMain = document.querySelector('main .container');
  const ausstattungHero = document.querySelector(
    'section[aria-labelledby="kinosaal-heading"]'
  );
  const ausstattungTech = document.querySelector(
    'section[aria-labelledby="kinotechnik-heading"]'
  );

  if (ausstattungHero) {
    // Bild, H1 und Beschreibung
    reveal('section[aria-labelledby="kinosaal-heading"] img', {
      props: { y: 16, duration: 0.55 },
    });
    reveal('#kinosaal-heading', { props: { y: 12, duration: 0.5 } });
    reveal('section[aria-labelledby="kinosaal-heading"] .text-sm', {
      props: { y: 14, duration: 0.5 },
    });
  }

  if (ausstattungTech) {
    // H2 und Einleitungstext
    reveal('#kinotechnik-heading', { props: { y: 12, duration: 0.5 } });
    reveal('section[aria-labelledby="kinotechnik-heading"] > .text-sm', {
      props: { y: 14, duration: 0.5 },
    });

    // Einzelblöcke (jeweils H3 + Text)
    reveal(
      'section[aria-labelledby="kinotechnik-heading"] .border-t.pt-8.mt-8',
      { props: { y: 18, duration: 0.55 } }
    );
    reveal('section[aria-labelledby="kinotechnik-heading"] h3', {
      props: { y: 10, duration: 0.45 },
    });
    reveal(
      'section[aria-labelledby="kinotechnik-heading"] .border-t.pt-8.mt-8 .text-sm',
      { props: { y: 14, duration: 0.5 } }
    );
  }
}
