/**
 * Accessibility-Modul
 *
 * Verbessert die Zugänglichkeit der Website durch:
 * - Anpassung der Fokus-Styles
 * - Verbesserung der Tastatur-Navigation
 * - Hinzufügen von ARIA-Attributen
 * - Verbesserung der Skip-Link-Funktionalität
 * - Verbesserung der Bildzugänglichkeit
 * - Verbesserung der Formular-Zugänglichkeit
 */

export function initAccessibility() {
  const style = document.createElement("style");
  style.textContent = `
    *:focus {
      outline: 2px solid var(--color-primary) !important;
      outline-offset: 2px !important;
    }
    *:focus:not(:focus-visible) {
      outline: none !important;
    }
    *:focus-visible {
      outline: 2px solid var(--color-primary) !important;
      outline-offset: 2px !important;
    }
  `;
  document.head.appendChild(style);

  const focusableElements = document.querySelectorAll(
    "a, button, input, textarea, select, [tabindex]:not([tabindex='-1'])"
  );

  focusableElements.forEach((el) => {
    if (
      el.tagName === "BUTTON" &&
      !el.hasAttribute("aria-label") &&
      !el.textContent.trim()
    ) {
      el.setAttribute("aria-label", "Button");
    }

    el.addEventListener("keydown", function (e) {
      if (e.key === "Enter" || e.key === " ") {
        if (el.tagName !== "A" && el.tagName !== "BUTTON") {
          e.preventDefault();
          el.click();
        }
      }
    });

    el.addEventListener("focus", function () {
      this.classList.add("ring-2", "ring-primary", "ring-offset-2");
    });

    el.addEventListener("blur", function () {
      this.classList.remove("ring-2", "ring-primary", "ring-offset-2");
    });
  });

  const skipLink = document.querySelector(".skip-link");
  if (skipLink) {
    skipLink.addEventListener("click", function (e) {
      e.preventDefault();
      const targetId = this.getAttribute("href").substring(1);
      const targetElement = document.getElementById(targetId);
      if (targetElement) {
        targetElement.setAttribute("tabindex", "-1");
        targetElement.focus();
        targetElement.removeAttribute("tabindex");
      }
    });
  }

  document.querySelectorAll("img:not([alt])").forEach((img) => {
    img.setAttribute("alt", "");
    img.setAttribute("role", "img");
  });

  document.querySelectorAll("form").forEach((form) => {
    const inputs = form.querySelectorAll("input, textarea, select");
    inputs.forEach((input) => {
      if (!input.id && input.name) {
        input.id = input.name;
      }
      if (input.id && !input.getAttribute("aria-label")) {
        const label = form.querySelector(`label[for="${input.id}"]`);
        if (label) {
          input.setAttribute("aria-label", label.textContent.trim());
        }
      }
    });
  });
}
