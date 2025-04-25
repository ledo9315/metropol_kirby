<!DOCTYPE html>
<html lang="de">

<head>
  <?php snippet('layouts/meta') ?>

  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/css/tailwind.min.css">
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

  <header class="bg-white z-50" role="banner">
    <div class="container mx-auto px-4 py-4">
      <div class="flex items-center">
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
              <a href="<?= url('kartenpreise') ?>"
                class="text-primary px-3 py-2 text-[1.2rem] <?= $page->is('kartenpreise') ? 'border-b-2 border-primary font-medium' : '' ?>"
                <?= $page->is('kartenpreise') ? 'aria-current="page"' : '' ?> role="menuitem">
                Kartenpreise
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
        <a href="tel:<?= $site->phone() ?>"
          class="flex items-center text-primary px-3 py-2 text-[1.2rem] hover:text-secondary transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-0 sm:mr-2" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 5a2 2 0 012-2h3.28a1 1 0 01.95.684l.95 2.85a1 1 0 01-.27.99l-2.17 2.17a11.042 11.042 0 005.19 5.19l2.17-2.17a1 1 0 01.99-.27l2.85.95a1 1 0 01.68.95V19a2 2 0 01-2 2h-1C9.393 21 3 14.607 3 6V5z" />
          </svg>
          <span class="hidden sm:inline-block ml-2 md:ml-0">Kartenvorbestellung</span>
        </a>
        <button id="menu-button" class="xl:hidden text-primary p-2 rounded focus:outline-none" aria-label="Menü öffnen">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>

      </div>
    </div>
  </header>

  <main id="main-content" class="min-h-screen">