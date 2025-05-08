import { initNavigation } from "./modules/navigation.js";
import { initAccessibility } from "./modules/accessibility.js";
import { initSearch } from "./modules/search.js";
import { initSpeisekarte } from "./modules/speisekarte.js";

document.addEventListener("DOMContentLoaded", () => {
  initNavigation();
  initAccessibility();
  initSearch();
  initSpeisekarte();
});
