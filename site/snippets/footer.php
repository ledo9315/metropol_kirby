</main>

<footer class="bg-primary text-white py-12" role="contentinfo">
  <div class="container mx-auto px-4 flex flex-col justify-center">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8" itemscope
      itemtype="http://schema.org/LocalBusiness">

      <!-- Theater-Informationen & Kontakt -->
      <div class="justify-self-start lg:justify-self-center">
        <h2 class="text-sm font-bold tracking-[0.12em] mb-2 uppercase">Metropol-Theater</h2>
        <div class="text-white">
          <meta itemprop="name" content="Metropol-Theater Brunsbüttel">
          <p class="mb-2" itemprop="openingHours" content="Mo-Su 19:00">
            <strong>Kartenvorbestellungen</strong><br />täglich ab 19:00 Uhr
          </p>
          <div class="flex items-start lg:items-center space-x-2 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
            <a href="tel:+494852934" class="hover:text-white hover:underline transition-colors" itemprop="telephone">
              <?= $site->phone()->isNotEmpty() ? $site->phone() : '+49 4852 9344' ?>
            </a>
          </div>
          <div class="flex items-start lg:items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <a href="mailto:info@metropol-theater.de" class="hover:text-white hover:underline transition-colors"
              itemprop="email"><?= $site->email()->isNotEmpty() ? $site->email() : 'info@metropol-theater.de' ?></a>
          </div>
        </div>
      </div>

      <div class="justify-self-start lg:justify-self-center">
        <h2 class="text-sm font-bold tracking-[0.12em] mb-2 uppercase">Adresse</h2>
        <address class="text-white not-italic" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
          <p itemprop="streetAddress">Posadowskystraße 2A</p>
          <p class="mb-2">
            <span itemprop="postalCode">25541</span>
            <span itemprop="addressLocality">Brunsbüttel</span>
          </p>
          <div class="flex items-center space-x-2 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17l4 4m0 0l4-4m-4 4V3" />
            </svg>
            <a href="https://maps.google.com/?q=Posadowskystraße+2A,+25541+Brunsbüttel" target="_blank"
              rel="noopener noreferrer" class="hover:text-white hover:underline transition-colors">
              Anfahrt bei Google Maps
            </a>
          </div>
        </address>
      </div>

      <!-- Navigation -->
      <div class="justify-self-start lg:justify-self-center">
        <h2 class="text-sm font-bold tracking-[0.12em] mb-2 uppercase">Navigation</h2>
        <nav aria-label="Footer-Navigation">
          <ul class="space-y-2">
            <li>
              <a href="<?= url('/') ?>"
                class="hover:text-white hover:underline transition-colors text-white flex items-center">
                &rarr;
                Startseite
              </a>
            </li>
            <li>
              <a href="<?= url('preise') ?>"
                class="hover:text-white hover:underline transition-colors text-white flex items-center">
                &rarr;
                Preise
              </a>
            </li>
            <li>
              <a href="<?= url('ausstattung') ?>"
                class="hover:text-white hover:underline transition-colors text-white flex items-center">
                &rarr;
                Ausstattung
              </a>
            </li>
            <li>
              <a href="<?= url('geschichte') ?>"
                class="hover:text-white hover:underline transition-colors text-white flex items-center">
                &rarr;
                Geschichte
              </a>
            </li>
          </ul>
        </nav>
      </div>

      <!-- Dokumentation -->
      <div class="justify-self-start lg:justify-self-center">
        <h2 class="text-sm font-bold tracking-[0.12em] mb-2 uppercase">Rechtliches</h2>
        <nav aria-label="Rechtliche Links">
          <ul class="space-y-2">
            <li>
              <a href="<?= url('impressum') ?>"
                class="hover:text-white hover:underline transition-colors text-white flex items-center">
                &rarr;
                Impressum
              </a>
            </li>
            <li>
              <a href="<?= url('datenschutz') ?>"
                class="hover:text-white hover:underline transition-colors text-white flex items-center">
                &rarr;
                Datenschutz
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>

    <!-- Copyright
     Anmerkung: sollte gelöscht werden, erstmal nur auskommentiert, falls man den Whitespace doch benutzen möchte
    <div class="text-center mt-8 pt-8 border-t border-white/20 text-white text-sm">
      <p><?= date('Y') ?> <span itemprop="legalName">Metropol-Theater Brunsbüttel</span>. Alle Rechte
        vorbehalten.</p>
    </div>
    -->
  </div>
</footer>
</body>

</html>