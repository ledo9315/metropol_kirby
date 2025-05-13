<!DOCTYPE html>
<html lang="de">

<head>
  <?php snippet('layouts/meta') ?>

  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/css/tailwind.css">
  <link rel="preload" href="/assets/fonts/FuturaStdBook.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="/assets/fonts/FuturaStdMedium.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="/assets/fonts/FuturaStdBold.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="/assets/fonts/FuturaStdLight.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="/assets/fonts/FuturaStdLightOblique.woff2" as="font" type="font/woff2" crossorigin>

  <script type="module" src="/assets/js/main.js"></script>
</head>

<body class="font-sans text-secondary bg-white">
  <a href="#main-content" class="skip-link focus:outline-none focus:ring-2 focus:ring-primary">Zum Hauptinhalt
    springen</a>

  <header class="bg-white z-10 relative" role="banner">
    <div class="container mx-auto px-4 py-4">
      <div class="flex justify-between items-center">
        <a href="<?= $site->url() ?>" class="mb-4 md:mb-0" aria-label="<?= $site->title() ?> - Zur Startseite">
          <img src="/assets/images/metropol-logo.svg" alt="Logo <?= $site->title() ?>" class="h-12" width="150"
            height="48" role="img">
        </a>

        <nav class="flex-1" aria-label="Hauptnavigation" role="navigation">
          <ul id="menu"
            class="hidden fixed left-0 top-0 w-full h-full bg-white bg-opacity-95 shadow-2xl z-50 flex-col items-center space-y-8 pt-24 text-center transition-all duration-300 xl:static xl:flex xl:flex-row xl:justify-center xl:space-y-0 xl:space-x-6 xl:bg-transparent xl:shadow-none xl:pt-0"
            role="menubar">
            <li class="absolute top-4 right-4 xl:hidden">
              <button id="menu-close" class="text-primary p-2 focus:outline-none" aria-label="Menü schließen">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </li>
            <li role="none">
              <a href="<?= $site->url() ?>"
                class="text-primary px-3 py-2 text-[1.2rem] <?= $page->id() === $site->homePage()->id() ? 'border-b-2 border-primary font-medium' : '' ?>"
                <?= $page->id() === $site->homePage()->id() ? 'aria-current="page"' : '' ?> role="menuitem">
                Startseite
              </a>
            </li>

            <li role="none">
              <a href="<?= url('home#programm') ?>" class="text-primary px-3 py-2 text-[1.2rem] scroll-smooth"
                role="menuitem">
                Programm
              </a>
            </li>

            <li role="none">
              <a href="<?= url('home#demnaechst') ?>" class="text-primary px-3 py-2 text-[1.2rem] scroll-smooth"
                role="menuitem">
                Demnächst
              </a>
            </li>

            <li role="none">
              <a href="<?= url('preise') ?>"
                class="text-primary px-3 py-2 text-[1.2rem] <?= $page->is('preise') ? 'border-b-2 border-primary font-medium' : '' ?>"
                <?= $page->is('preise') ? 'aria-current="page"' : '' ?> role="menuitem">
                Preise
              </a>
            </li>

            <li class="relative group xl:block hidden" role="none">
              <button
                class="text-primary px-3 py-2 text-[1.2rem] flex items-center gap-1 focus:outline-none group-hover:text-primary <?= ($page->is('ausstattung') || $page->is('geschichte')) ? 'border-b-2 border-primary font-medium' : '' ?>"
                aria-expanded="false" aria-haspopup="true" aria-controls="dropdown-menu" role="menuitem">
                Über uns
                <svg class="w-4 h-4 ml-1 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor"
                  stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
              </button>
              <ul id="dropdown-menu"
                class="absolute top-10 left-0 mt-2 w-44 bg-white shadow-lg rounded z-20 opacity-0 group-hover:opacity-100 group-hover:pointer-events-auto pointer-events-none hover:opacity-100 hover:pointer-events-auto transition-opacity duration-200"
                role="menu" aria-labelledby="dropdown-button">
                <li role="none">
                  <a href="<?= url('geschichte') ?>" style="color: var(--color-primary);"
                    class="block px-5 py-3 hover:bg-primary hover:!text-white transition-colors duration-150 <?= $page->is('geschichte') ? 'font-medium' : '' ?>"
                    role="menuitem">
                    Geschichte
                  </a>
                </li>
                <li role="none">
                  <a href="<?= url('ausstattung') ?>" style="color: var(--color-primary);"
                    class="block px-5 py-3 hover:bg-primary hover:!text-white transition-colors duration-150 <?= $page->is('ausstattung') ? 'font-medium' : '' ?>"
                    role="menuitem">
                    Ausstattung
                  </a>
                </li>
              </ul>
            </li>

            <li class="xl:hidden block">
              <a href="<?= url('geschichte') ?>"
                class="text-primary px-3 py-2 text-[1.1rem] text-center inline-block <?= $page->is('geschichte') ? 'border-b-2 border-primary font-medium' : '' ?>"
                <?= $page->is('geschichte') ? 'aria-current="page"' : '' ?>>
                Geschichte
              </a>
            </li>
            <li class="xl:hidden block">
              <a href="<?= url('ausstattung') ?>"
                class="text-primary px-3 py-2 text-[1.1rem] text-center inline-block <?= $page->is('ausstattung') ? 'border-b-2 border-primary font-medium' : '' ?>"
                <?= $page->is('ausstattung') ? 'aria-current="page"' : '' ?>>
                Ausstattung
              </a>
            </li>
          </ul>
        </nav>
        <div class="relative ml-auto xl:ml-0 z-[400]" id="search-container">
          <div class="flex items-center">
            <button id="search-toggle" type="button"
              class="text-primary p-2 rounded-full hover:bg-primary/10 transition-colors focus:outline-none focus:ring-2 focus:ring-primary/30"
              aria-label="Suchfunktion anzeigen/ausblenden" aria-expanded="false" aria-controls="search-form">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </button>
            <div id="search-form" class="hidden z-[200]">
              <form action="javascript:void(0);" class="flex items-center" role="search">
                <div class="relative">
                  <input type="search" name="q" id="search-input"
                    class="text-primary bg-white border-2 border-primary/20 focus:border-primary rounded-full py-2 px-4 pr-10 text-sm w-[200px] md:w-[240px] transition-all duration-300 focus:outline-none focus:shadow-md placeholder-primary/50 appearance-none"
                    placeholder="Film suchen..." aria-label="Film suchen" autocomplete="off" spellcheck="false">
                  <button type="submit" id="search-submit"
                    class="absolute right-1 top-1/2 -translate-y-1/2 text-primary p-1.5 rounded-full hover:bg-primary/10 transition-colors focus:outline-none focus:ring-2 focus:ring-primary/30"
                    aria-label="Suchen">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                      stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                  </button>
                </div>
                <button type="button" id="search-close"
                  class="text-primary p-1.5 ml-1 rounded-full hover:bg-primary/10 transition-colors md:hidden focus:outline-none focus:ring-2 focus:ring-primary/30"
                  aria-label="Suche schließen">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
              </form>
            </div>
          </div>
          <div id="search-results-dropdown"
            class="hidden fixed top-40 md:right-4 right-[50%] z-[999999] w-[800px] max-w-[85vw] translate-x-[50%] md:translate-x-0 bg-white border-2 border-primary rounded-lg shadow-2xl overflow-y-auto max-h-[70vh]"
            role="region" aria-live="polite" aria-label="Suchergebnisse">
            <div
              class="search-results-header sticky top-0 z-[200] px-5 py-4 text-sm text-gray-600 border-b border-gray-200 flex justify-between items-center bg-white">
              <span id="search-results-count" class="font-medium text-gray-700">
                <!-- Anzahl der Ergebnisse wird dynamisch eingefügt -->
              </span>
            </div>
            <div id="search-results-content" class="overflow-y-visible">
              <!-- Hier werden die Suchergebnisse dynamisch eingefügt -->
              <div class="search-empty-state hidden flex-col items-center justify-center p-8 text-gray-500">
              </div>
              <div class="search-loading-state hidden flex-col items-center justify-center p-8 text-gray-500">
              </div>
              <div class="search-error-state hidden flex-col items-center justify-center p-8 text-red-500">
                <div class="flex flex-col items-center">
                  <svg class="w-6 h-6 text-red-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                      d="M12 9v2m0 4h.01M12 3a9 9 0 100 18 9 9 0 000-18z"></path>
                  </svg>
                  <p class="text-center font-light">Ein Fehler ist aufgetreten</p>
                  <p id="search-error-message" class="text-center text-xs mt-1 text-gray-500"><!-- Fehlermeldung --></p>
                </div>
              </div>
              <ul id="search-results-list" class="search-results-list px-4 py-4" role="listbox">
                <!-- Hier werden dynamisch die Ergebnisse als Liste eingefügt -->
              </ul>
            </div>
          </div>
        </div>
        <button id="menu-button"
          class="xl:hidden text-primary p-2 rounded-full hover:bg-primary/10 transition-colors focus:outline-none focus:ring-2 focus:ring-primary/30 ml-1"
          aria-label="Menü öffnen">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </div>
  </header>

  <main id="main-content" class="min-h-screen">