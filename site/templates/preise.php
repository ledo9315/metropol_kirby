<?php snippet('header') ?>

<main class="py-12 mb-20">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <?php snippet('components/back-to-home') ?>

    <?php
    // Titel und Intro aus Panel-Feldern
    $title = $page->title()->or('Ticketpreise & Gastronomie');
    $intro = $page->intro()->or('Hier finden Sie unsere Preise.');

    // Hero-Bild aus Panel oder Fallback
    $heroImage = $page->hero_image()->toFile();
    $heroUrl = $heroImage ? $heroImage->url() : url('assets/images/kino_01_scharf.jpg');
    ?>

    <!-- Hero-Bereich -->
    <section class="relative mb-16" aria-label="Preise Titelbild">
      <div class="relative h-[42vh] md:h-[56vh] w-full"
        style="background-image:url('<?= $heroUrl ?>'); background-size:cover; background-position:center;">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="absolute inset-0 flex items-end">
          <div class="w-full">
            <div class="max-w-4xl text-white px-6 py-10">
              <h1 class="text-4xl md:text-6xl font-light tracking-tight"><?= $title->escape() ?></h1>
              <p class="mt-4 text-lg md:text-xl leading-relaxed">
                <?= $intro->escape() ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Kartenpreise im Geschichte-Stil -->
    <section class="mb-40" aria-label="Kartenpreise">
      <div class="mx-auto">
        <?php if ($prices = $page->prices()->toStructure()): ?>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
            <?php foreach ($prices as $price): ?>
              <div class="pt-6 border-t border-primary">
                <div class="text-xs tracking-[0.2em] uppercase text-black/70">
                  <?= str_replace('*', '', $price->category()) ?>
                </div>
                <div class="mt-2 text-2xl md:text-3xl font-light">
                  <?= number_format($price->amount()->toFloat(), 2, ',', '.') ?> €
                </div>
                <p class="text-gray-800 mt-3 leading-relaxed">
                  <?php if ($price->category()->value() === 'Standard'): ?>
                    Regulärer Eintritt für alle Altersklassen.
                  <?php elseif ($price->category()->value() === 'Ermäßigt*'): ?>
                    Für Kinder bis 14 Jahre und Ermäßigungsberechtigte.
                  <?php elseif ($price->category()->value() === '3D-Kino'): ?>
                    3D-Filme mit besonderem Kinoerlebnis.
                  <?php elseif ($price->category()->value() === 'Überlänge'): ?>
                    Für Filme mit einer Laufzeit über 120 Minuten.
                  <?php endif ?>
                </p>
              </div>
            <?php endforeach ?>
          </div>

          <?php if ($page->note()->isNotEmpty()): ?>
            <div class="text-center mt-12 text-sm text-gray-500">
              <?= $page->note() ?>
            </div>
          <?php endif ?>
        <?php endif ?>
      </div>
    </section>

    <!-- Speisekarte -->
    <section class="mb-40">
      <div class="text-center mb-16">
        <h2 class="text-4xl md:text-5xl font-light text-primary tracking-tight">Speisekarte</h2>
      </div>

      <?php
      $activeTab = 'nicht-alkoholisch';
      if (isset($_GET['tab'])) {
        $activeTab = $_GET['tab'];
      }
      ?>

      <!-- Minimale Tab-Navigation -->
      <div class="max-w-4xl mx-auto mb-16">
        <noscript>
          <style>
            [data-speisekarte-panel] {
              display: block !important;
            }

            [data-speisekarte-button] {
              display: none !important;
            }
          </style>
        </noscript>

        <div class="flex flex-wrap justify-center gap-8">
          <button type="button" id="tab-nicht-alkoholisch" data-speisekarte-button data-target="panel-nicht-alkoholisch"
            class="text-sm tracking-[0.2em] uppercase transition-all duration-200 pb-2 border-b
            <?= $activeTab === 'nicht-alkoholisch' ? 'text-black border-primary' : 'text-gray-500 border-transparent hover:text-gray-700' ?>"
            role="tab" aria-controls="panel-nicht-alkoholisch"
            aria-selected="<?= $activeTab === 'nicht-alkoholisch' ? 'true' : 'false' ?>">
            Alkoholfreie Getränke
          </button>

          <button type="button" id="tab-biere" data-speisekarte-button data-target="panel-biere"
            class="text-sm tracking-[0.2em] uppercase transition-all duration-200 pb-2 border-b
            <?= $activeTab === 'biere' ? 'text-black border-primary' : 'text-gray-500 border-transparent hover:text-gray-700' ?>" role="tab" aria-controls="panel-biere"
            aria-selected="<?= $activeTab === 'biere' ? 'true' : 'false' ?>">
            Biere
          </button>

          <button type="button" id="tab-longdrinks" data-speisekarte-button data-target="panel-longdrinks"
            class="text-sm tracking-[0.2em] uppercase transition-all duration-200 pb-2 border-b
            <?= $activeTab === 'longdrinks' ? 'text-black border-primary' : 'text-gray-500 border-transparent hover:text-gray-700' ?>" role="tab" aria-controls="panel-longdrinks"
            aria-selected="<?= $activeTab === 'longdrinks' ? 'true' : 'false' ?>">
            Longdrinks
          </button>

          <button type="button" id="tab-verschiedenes" data-speisekarte-button data-target="panel-verschiedenes"
            class="text-sm tracking-[0.2em] uppercase transition-all duration-200 pb-2 border-b
            <?= $activeTab === 'verschiedenes' ? 'text-black border-primary' : 'text-gray-500 border-transparent hover:text-gray-700' ?>" role="tab" aria-controls="panel-verschiedenes"
            aria-selected="<?= $activeTab === 'verschiedenes' ? 'true' : 'false' ?>">
            Verschiedenes
          </button>
        </div>
      </div>

      <!-- Tab-Panels im Geschichte-Stil -->
      <div class="mx-auto">

        <!-- Alkoholfreie Getränke -->
        <div id="panel-nicht-alkoholisch" data-speisekarte-panel
          class="<?= $activeTab !== 'nicht-alkoholisch' ? 'hidden' : '' ?>" role="tabpanel"
          aria-labelledby="tab-nicht-alkoholisch" <?= $activeTab !== 'nicht-alkoholisch' ? 'aria-hidden="true"' : '' ?>>

          <?php if ($page->non_alcoholic()->isNotEmpty()): ?>
            <?php $formatSize = function ($size) {
              $s = trim((string) $size);
              if ($s === '-' || $s === '')
                return $s;
              if (preg_match('/l$/u', $s)) {
                $base = preg_replace('/\s*l$/u', '', $s);
                return $base . "&#8239;l";
              }
              return $s;
            }; ?>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-10 max-w-5xl mx-auto">
              <?php foreach ($page->non_alcoholic()->toStructure() as $drink): ?>
                <div class="pt-6 border-t border-primary">
                  <?php if ($drink->description()->isNotEmpty()): ?>
                    <div class="flex items-center justify-between">
                      <div class="text-xs tracking-[0.2em] uppercase text-black/70">
                        <?= $drink->name() ?>
                      </div>
                      <div class="text-sm text-gray-500">
                        <?= $drink->type() ?>
                        <?php
                        $formattedSize = $formatSize($drink->size());
                        if ($formattedSize && $formattedSize !== '-' && $formattedSize !== ''):
                          ?>
                          · <?= $formattedSize ?>
                        <?php endif ?>
                      </div>
                    </div>
                    <div class="mt-2 text-2xl md:text-3xl font-light">
                      <?= number_format($drink->price()->toFloat(), 2, ',', '.') ?>&#8239;€
                    </div>
                    <p class="text-gray-800 mt-3 leading-relaxed">
                      <?= $drink->description()->escape() ?>
                    </p>
                  <?php else: ?>
                    <div class="text-xs tracking-[0.2em] uppercase text-black/70">
                      <?= $drink->name() ?>
                    </div>
                    <div class="mt-2 text-2xl md:text-3xl font-light">
                      <?= number_format($drink->price()->toFloat(), 2, ',', '.') ?>&#8239;€
                    </div>
                    <p class="text-gray-800 mt-3 leading-relaxed">
                      <?= $drink->type() ?>
                      <?php
                      $formattedSize = $formatSize($drink->size());
                      if ($formattedSize && $formattedSize !== '-' && $formattedSize !== ''):
                        ?>
                        · <?= $formattedSize ?>
                      <?php endif ?>
                    </p>
                  <?php endif ?>
                </div>
              <?php endforeach ?>
            </div>
          <?php else: ?>
            <p class="text-center text-gray-500 italic py-12">Keine Getränke verfügbar</p>
          <?php endif ?>
        </div>

        <!-- Biere -->
        <div id="panel-biere" data-speisekarte-panel class="<?= $activeTab !== 'biere' ? 'hidden' : '' ?>"
          role="tabpanel" aria-labelledby="tab-biere" <?= $activeTab !== 'biere' ? 'aria-hidden="true"' : '' ?>>

          <?php if ($page->beers()->isNotEmpty()): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-10 max-w-5xl mx-auto">
              <?php foreach ($page->beers()->toStructure() as $beer): ?>
                <div class="pt-6 border-t border-primary">
                  <div class="text-xs tracking-[0.2em] uppercase text-black/70">
                    <?= $beer->name() ?>
                  </div>
                  <div class="mt-2 text-2xl md:text-3xl font-light">
                    <?= number_format($beer->price()->toFloat(), 2, ',', '.') ?>&#8239;€
                  </div>
                  <p class="text-gray-800 mt-3 leading-relaxed">
                    <?php if ($beer->description()->isNotEmpty()): ?>
                      <?= $beer->description()->escape() ?>
                    <?php else: ?>
                    <?php endif ?>
                  </p>
                </div>
              <?php endforeach ?>
            </div>
          <?php else: ?>
            <p class="text-center text-gray-500 italic py-12">Keine Biere verfügbar</p>
          <?php endif ?>
        </div>

        <!-- Longdrinks -->
        <div id="panel-longdrinks" data-speisekarte-panel class="<?= $activeTab !== 'longdrinks' ? 'hidden' : '' ?>"
          role="tabpanel" aria-labelledby="tab-longdrinks" <?= $activeTab !== 'longdrinks' ? 'aria-hidden="true"' : '' ?>>

          <?php if ($page->longdrinks()->isNotEmpty()): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-10 max-w-5xl mx-auto">
              <?php foreach ($page->longdrinks()->toStructure() as $drink): ?>
                <div class="pt-6 border-t border-primary">
                  <div class="text-xs tracking-[0.2em] uppercase text-black/70">
                    <?= $drink->name() ?>
                  </div>
                  <div class="mt-2 text-2xl md:text-3xl font-light">
                    <?= number_format($drink->price()->toFloat(), 2, ',', '.') ?>&#8239;€
                  </div>
                  <p class="text-gray-800 mt-3 leading-relaxed">
                    <?php if ($drink->description()->isNotEmpty()): ?>
                      <?= $drink->description()->escape() ?>
                    <?php else: ?>
                    <?php endif ?>
                  </p>
                </div>
              <?php endforeach ?>
            </div>
          <?php else: ?>
            <p class="text-center text-gray-500 italic py-12">Keine Longdrinks verfügbar</p>
          <?php endif ?>
        </div>

        <!-- Verschiedenes -->
        <div id="panel-verschiedenes" data-speisekarte-panel
          class="<?= $activeTab !== 'verschiedenes' ? 'hidden' : '' ?>" role="tabpanel"
          aria-labelledby="tab-verschiedenes" <?= $activeTab !== 'verschiedenes' ? 'aria-hidden="true"' : '' ?>>

          <?php if ($page->misc()->isNotEmpty()): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-10 max-w-5xl mx-auto">
              <?php foreach ($page->misc()->toStructure() as $item): ?>
                <div class="pt-6 border-t border-primary">
                  <div class="text-xs tracking-[0.2em] uppercase text-black/70">
                    <?= $item->name() ?>
                  </div>
                  <div class="mt-2 text-2xl md:text-3xl font-light">
                    <?= number_format($item->price()->toFloat(), 2, ',', '.') ?>&#8239;€
                  </div>
                  <p class="text-gray-800 mt-3 leading-relaxed">
                    <?php if ($item->description()->isNotEmpty()): ?>
                      <?= $item->description()->escape() ?>
                    <?php else: ?>
                    <?php endif ?>
                  </p>
                </div>
              <?php endforeach ?>
            </div>
          <?php else: ?>
            <p class="text-center text-gray-500 italic py-12">Keine Einträge verfügbar</p>
          <?php endif ?>
        </div>
      </div>
    </section>

    <!-- Kinovermietung -->
    <?php if ($page->rental_title()->isNotEmpty()): ?>
      <section class="mb-10">
        <div class="max-w-4xl mx-auto text-center">

          <h2 class="text-3xl md:text-4xl font-light text-primary mb-8 tracking-tight">
            <?= $page->rental_title() ?>
          </h2>

          <?php if ($page->rental_text()->isNotEmpty()): ?>
            <div class="prose prose-lg mx-auto text-gray-600 leading-relaxed">
              <?= $page->rental_text()->kirbytext() ?>
            </div>
          <?php endif ?>
        </div>
      </section>
    <?php endif ?>

  </div>
</main>

<?php snippet('footer') ?>