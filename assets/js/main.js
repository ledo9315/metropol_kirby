import { initNavigation } from "./modules/navigation.js";
import { initAccessibility } from "./modules/accessibility.js";

document.addEventListener("DOMContentLoaded", () => {
  initNavigation();
  initAccessibility();
});
