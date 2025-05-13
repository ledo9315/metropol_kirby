# Metropol-Theater Brunsbüttel Website

## Tailwind CSS Implementierung

Dieses Projekt verwendet Tailwind CSS v3 mit modernen Best Practices für das Frontend-Styling.

### Entwicklungsumgebung einrichten

1. Abhängigkeiten installieren:

    ```bash
    npm install
    ```

2. Entwicklungsserver starten:

    ```bash
    npm run dev
    ```

3. Für die Produktion bauen:
    ```bash
    npm run build
    ```

### Tailwind Komponenten

Das Projekt verwendet das Tailwind CSS Typography Plugin, um Prosa-Inhalte zu stylen, sowie das Forms Plugin für Formular-Elemente.

Wiederverwendbare Komponenten sind in der `src/css/main.css` definiert, darunter:

- `.btn`: Primäre Schaltfläche
- `.btn-secondary`: Sekundäre Schaltfläche
- `.btn-outline`: Outline-Schaltfläche
- `.form-input`: Formular-Eingabefelder

### Tailwind Konfiguration

Die Tailwind-Konfiguration wurde optimiert für:

- Angepasste Farben (primary, secondary)
- Responsive Container
- Futura Std Schriftart
- Verbesserte Barrierefreiheit
- Optimierte Leistung

### Kirby CMS Integration

Die Tailwind-Implementierung ist vollständig mit Kirby CMS kompatibel und unterstützt Editor-generierte Inhalte durch das Typography-Plugin.
