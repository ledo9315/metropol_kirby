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

      // Alle Buttons als inaktiv markieren
      tabButtons.forEach((btn) => {
        btn.classList.remove('active');
        btn.classList.add('text-primary');
      });

      // Aktuellen Button als aktiv markieren
      this.classList.add('active');
      this.classList.remove('text-primary');
    });
  });

  function updateUrlParam(key, value) {
    const url = new URL(window.location);
    url.searchParams.set(key, value);
    window.history.replaceState({}, '', url);
  }
}
