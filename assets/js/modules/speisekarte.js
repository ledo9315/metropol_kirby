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

      tabButtons.forEach((btn) => {
        btn.classList.remove('bg-primary', 'text-white');
        btn.classList.add('border', 'border-primary', 'text-primary');
      });

      this.classList.remove('border', 'border-primary', 'text-primary');
      this.classList.add('bg-primary', 'text-white');
    });
  });

  function updateUrlParam(key, value) {
    const url = new URL(window.location);
    url.searchParams.set(key, value);
    window.history.replaceState({}, '', url);
  }
}
