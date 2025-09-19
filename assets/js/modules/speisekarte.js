export function initSpeisekarte() {
  const tabButtons = document.querySelectorAll('[data-speisekarte-button]');
  const panels = document.querySelectorAll('[data-speisekarte-panel]');

  if (!tabButtons.length || !panels.length) return;

  tabButtons.forEach((button) => {
    button.addEventListener('click', function () {
      const targetPanelId = this.getAttribute('data-target');

      const tabId = this.id.replace('tab-', '');
      updateUrlParam('tab', tabId);

      panels.forEach((panel) => {
        panel.classList.add('hidden');
      });

      const targetPanel = document.getElementById(targetPanelId);
      if (targetPanel) {
        targetPanel.classList.remove('hidden');
      }

      // Entferne aktive Klassen von allen Tabs
      tabButtons.forEach((btn) => {
        btn.classList.remove('text-black', 'border-black');
        btn.classList.add('text-gray-500', 'border-transparent');
      });

      // Füge aktive Klassen zum geklickten Tab hinzu
      this.classList.remove('text-gray-500', 'border-transparent');
      this.classList.add('text-black', 'border-black');
    });
  });

  function updateUrlParam(key, value) {
    const url = new URL(window.location);
    url.searchParams.set(key, value);
    window.history.replaceState({}, '', url);
  }
}
