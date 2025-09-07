<?php snippet('header') ?>

<main class="py-12 mb-20">
  <article class="relative">
    <div class="container mx-auto px-4">
      <?php snippet('components/back-to-home') ?>


      <div class="flex flex-col lg:flex-row gap-16 max-w-7xl mx-auto mb-24">
        <div class="lg:w-1/2">
          <section class="mb-16">
            <h2 class="text-5xl font-light text-primary inline-block mb-8">
              Kartenpreise
            </h2>

            <?php if ($prices = $page->prices()->toStructure()): ?>
              <table class="w-full max-w-[450px] mt-6 text-base">
                <caption class="sr-only">Kartenpreise</caption>
                <thead>
                  <tr class="text-sm uppercase tracking-wider text-primary">
                    <th class="text-start font-medium pb-2">Kategorie</th>
                    <th class="text-right font-medium pb-2">Preis</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($prices as $price): ?>
                    <tr class="border-b border-gray-200 last:border-0">
                      <td class="py-2 pr-3 align-top text-secondary"><?= $price->category() ?></td>
                      <td class="py-2 pl-3 align-top text-right font-medium text-secondary whitespace-nowrap tabular-nums">
                        <?= number_format($price->amount()->toFloat(), 2, ',', '.') ?>&#8239;€
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>

              <?php if ($page->note()->isNotEmpty()): ?>
                <div class="text-base text-gray-600 italic mt-6">
                  <?= $page->note() ?>
                </div>
              <?php endif ?>
            <?php endif ?>
          </section>

          <?php if ($page->rental_title()->isNotEmpty()): ?>
            <section class="mb-16 mt-24 bg-gray-50 p-6 border-t-2 border-primary">
              <h2 class="text-3xl font-light text-primary mb-6">
                <?= $page->rental_title() ?>
              </h2>
              
              <?php if ($page->rental_text()->isNotEmpty()): ?>
                <div class="prose prose-base text-gray-700">
                  <?= $page->rental_text()->kirbytext() ?>
                </div>
              <?php endif ?>
            </section>
          <?php endif ?>
        </div>
        
        <div class="lg:w-1/2">
          <section>
            <h2 class="text-5xl font-light text-primary inline-block mb-8">
              Speisekarte
            </h2>

            <?php
            $activeTab = 'nicht-alkoholisch';
            if (isset($_GET['tab'])) {
              $activeTab = $_GET['tab'];
            }
            ?>

            <div class="mt-10 mb-10">
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
              <div class="inline-flex flex-wrap gap-2 p-1">
                <button type="button" id="tab-nicht-alkoholisch" 
                  data-speisekarte-button data-target="panel-nicht-alkoholisch"
                  class="px-4 py-2 text-base border border-gray-200
                  <?= $activeTab === 'nicht-alkoholisch' ? 'bg-primary text-white' : 'text-primary' ?>"
                  role="tab" aria-controls="panel-nicht-alkoholisch"
                  aria-selected="<?= $activeTab === 'nicht-alkoholisch' ? 'true' : 'false' ?>">
                  Alkoholfreie Getränke
                </button>

                <button type="button" id="tab-biere" 
                  data-speisekarte-button data-target="panel-biere"
                  class="px-4 py-2 text-base border border-gray-200
                  <?= $activeTab === 'biere' ? 'bg-primary text-white' : 'text-primary' ?>"
                  role="tab" aria-controls="panel-biere"
                  aria-selected="<?= $activeTab === 'biere' ? 'true' : 'false' ?>">
                  Biere
                </button>

                <button type="button" id="tab-longdrinks" 
                  data-speisekarte-button data-target="panel-longdrinks"
                  class="px-4 py-2 text-base border border-gray-200
                  <?= $activeTab === 'longdrinks' ? 'bg-primary text-white' : 'text-primary' ?>"
                  role="tab" aria-controls="panel-longdrinks"
                  aria-selected="<?= $activeTab === 'longdrinks' ? 'true' : 'false' ?>">
                  Longdrinks
                </button>

                <button type="button" id="tab-verschiedenes" 
                  data-speisekarte-button data-target="panel-verschiedenes"
                  class="px-4 py-2 text-base border border-gray-200
                  <?= $activeTab === 'verschiedenes' ? 'bg-primary text-white' : 'text-primary' ?>"
                  role="tab" aria-controls="panel-verschiedenes"
                  aria-selected="<?= $activeTab === 'verschiedenes' ? 'true' : 'false' ?>">
                  Verschiedenes
                </button>
              </div>
            </div>

            <div id="panel-nicht-alkoholisch" data-speisekarte-panel
              class="<?= $activeTab !== 'nicht-alkoholisch' ? 'hidden' : '' ?>" 
              role="tabpanel" aria-labelledby="tab-nicht-alkoholisch" 
              <?= $activeTab !== 'nicht-alkoholisch' ? 'aria-hidden="true"' : '' ?>>
              
              <h3 class="text-2xl font-thin text-primary mb-6 sr-only">
                <?= $page->non_alcoholic_title()->or('Alkoholfreie Getränke') ?>
              </h3>

              <?php if ($page->non_alcoholic()->isNotEmpty()): ?>
                <?php $formatSize = function ($size) {
                  $s = trim((string)$size);
                  if ($s === '-' || $s === '') return $s;
                  // Einheit "l" mit schmal geschütztem Leerzeichen abtrennen (kompatibel ohne PHP 8 Helfer)
                  if (preg_match('/l$/u', $s)) {
                    $base = preg_replace('/\s*l$/u', '', $s);
                    return $base . "&#8239;l";
                  }
                  return $s;
                }; ?>

                <table class="w-full max-w-[480px] text-base">
                  <caption class="sr-only">Alkoholfreie Getränke</caption>
                  <thead class="">
                    <tr class="text-sm uppercase tracking-wider text-primary">
                      <th class="text-start font-medium  pb-2">Größe</th>
                      <th class="text-start font-medium  pb-2">Name</th>
                      <th class="text-right font-medium  pb-2">Preis</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($page->non_alcoholic()->toStructure() as $drink): ?>
                      <tr class="border-b border-gray-200 last:border-0">
                        <td class="py-2 pr-3 align-top text-gray-600 whitespace-nowrap">
                          <?= $formatSize($drink->size()) ?>
                        </td>
                        <td class="py-2 pr-3 align-top">
                          <div class="font-medium text-secondary"><?= $drink->name() ?></div>
                          <div class="text-gray-500"><?= $drink->type() ?></div>
                        </td>
                        <td class="py-2 pl-3 align-top text-right font-medium text-secondary whitespace-nowrap tabular-nums">
                          <?= number_format($drink->price()->toFloat(), 2, ',', '.') ?>&#8239;€
                        </td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              <?php else: ?>
                <p class="text-gray-500 italic">Keine Getränke verfügbar</p>
              <?php endif ?>
            </div>

            <div id="panel-biere" data-speisekarte-panel 
              class="<?= $activeTab !== 'biere' ? 'hidden' : '' ?>" 
              role="tabpanel" aria-labelledby="tab-biere" 
              <?= $activeTab !== 'biere' ? 'aria-hidden="true"' : '' ?>>
              
              <h3 class="text-2xl font-medium text-primary mb-6 sr-only">
                <?= $page->beer_title()->or('Biere') ?>
              </h3>

              <?php if ($page->beers()->isNotEmpty()): ?>
                <table class="w-full max-w-[480px] text-base">
                  <caption class="sr-only">Biere</caption>
                  <thead>
                    <tr class="text-sm uppercase tracking-wider text-primary">
                      <th class="text-start font-medium pb-2">Name</th>
                      <th class="text-right font-medium pb-2">Preis</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($page->beers()->toStructure() as $beer): ?>
                      <tr class="border-b border-gray-200 last:border-0">
                        <td class="py-2 pr-3 align-top font-medium text-secondary"><?= $beer->name() ?></td>
                        <td class="py-2 pl-3 align-top text-right font-medium text-secondary whitespace-nowrap tabular-nums">
                          <?= number_format($beer->price()->toFloat(), 2, ',', '.') ?>&#8239;€
                        </td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              <?php else: ?>
                <p class="text-gray-500 italic">Keine Biere verfügbar</p>
              <?php endif ?>
            </div>

            <div id="panel-longdrinks" data-speisekarte-panel 
              class="<?= $activeTab !== 'longdrinks' ? 'hidden' : '' ?>" 
              role="tabpanel" aria-labelledby="tab-longdrinks" 
              <?= $activeTab !== 'longdrinks' ? 'aria-hidden="true"' : '' ?>>
              
                <h3 class="text-2xl font-medium text-primary mb-6 sr-only">
                  <?= $page->longdrinks_title()->or('Longdrinks') ?>
                </h3>

              <?php if ($page->longdrinks()->isNotEmpty()): ?>
                <table class="w-full max-w-[480px] text-base">
                  <caption class="sr-only">Longdrinks</caption>
                  <thead>
                    <tr class="text-sm uppercase tracking-wider text-primary">
                      <th class="text-start font-medium pb-2">Name</th>
                      <th class="text-right font-medium pb-2">Preis</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($page->longdrinks()->toStructure() as $drink): ?>
                      <tr class="border-b border-gray-200 last:border-0">
                        <td class="py-2 pr-3 align-top font-medium text-secondary"><?= $drink->name() ?></td>
                        <td class="py-2 pl-3 align-top text-right font-medium text-secondary whitespace-nowrap tabular-nums">
                          <?= number_format($drink->price()->toFloat(), 2, ',', '.') ?>&#8239;€
                        </td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              <?php else: ?>
                <p class="text-gray-500 italic">Keine Longdrinks verfügbar</p>
              <?php endif ?>
            </div>

            <div id="panel-verschiedenes" data-speisekarte-panel 
              class="<?= $activeTab !== 'verschiedenes' ? 'hidden' : '' ?>" 
              role="tabpanel" aria-labelledby="tab-verschiedenes" 
              <?= $activeTab !== 'verschiedenes' ? 'aria-hidden="true"' : '' ?>>
              
              <h3 class="text-2xl font-medium text-primary mb-6 sr-only">
                <?= $page->misc_title()->or('Verschiedenes') ?>
              </h3>

              <?php if ($page->misc()->isNotEmpty()): ?>
                <table class="w-full max-w-[480px] text-base">
                  <caption class="sr-only">Verschiedenes</caption>
                  <thead>
                    <tr class="text-sm uppercase tracking-wider text-primary">
                      <th class="text-start font-medium pb-2">Name</th>
                      <th class="text-right font-medium pb-2">Preis</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($page->misc()->toStructure() as $item): ?>
                      <tr class="border-b border-gray-200 last:border-0">
                        <td class="py-2 pr-3 align-top font-medium text-secondary"><?= $item->name() ?></td>
                        <td class="py-2 pl-3 align-top text-right font-medium text-secondary whitespace-nowrap tabular-nums">
                          <?= number_format($item->price()->toFloat(), 2, ',', '.') ?>&#8239;€
                        </td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              <?php else: ?>
                <p class="text-gray-500 italic">Keine Einträge verfügbar</p>
              <?php endif ?>
            </div>
          </section>
        </div>
      </div>
    </div>
  </article>
</main>

<?php snippet('footer') ?>