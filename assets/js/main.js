import { initNavigation } from './modules/navigation.js';
import { initAccessibility } from './modules/accessibility.js';
import { initSearch } from './modules/search.js';
import { initSpeisekarte } from './modules/speisekarte.js';
import { initScrollAnimations } from './modules/scroll-animations.js';

document.addEventListener('DOMContentLoaded', () => {
  initNavigation();
  initAccessibility();
  initSearch();
  initSpeisekarte();
  initScrollAnimations();
});
