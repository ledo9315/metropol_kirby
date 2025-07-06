<?php snippet('header') ?>

<style>
  .speisekarte-tab {
    transition: all 0.2s ease;
  }
  .speisekarte-tab:not(.active):hover {
    background-color: var(--color-primary) !important;
    color: white !important;
  }
  .speisekarte-tab.active {
    background-color: var(--color-primary);
    color: white;
  }
</style>

<main class="py-12 mb-20">
  <div class="container mx-auto px-4">
    <?php snippet('components/back-to-home') ?>

    <div class="text-center mb-16">
      <h1 class="text-5xl font-light text-primary mb-4">Preise & Speisekarte</h1>
      <p class="text-xl text-gray-600 max-w-3xl mx-auto">
        Unsere aktuellen Kartenpreise und unser Angebot an Getränken und Snacks.
      </p>
    </div>

    <div class="flex flex-col lg:flex-row gap-16 max-w-7xl mx-auto">
      
      <!-- Kartenpreise Section -->
      <div class="lg:w-1/2">
        <section class="mb-16 w-[85%]">
          <h2 class="text-4xl font-light text-primary mb-8 border-b border-primary/20 pb-3">
            Kartenpreise
          </h2>

          <?php if ($prices = $page->prices()->toStructure()): ?>
            <div class="bg-white p-6">
              <div class="space-y-4">
                <?php foreach ($prices as $price): ?>
                  <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-b-0">
                    <span class="text-lg text-gray-700"><?= $price->category() ?></span>
                    <span class="text-xl font-medium text-primary">
                      <?= number_format($price->amount()->toFloat(), 2, ',', '.') ?>&nbsp;€
                    </span>
                  </div>
                <?php endforeach ?>
              </div>
              
              <?php if ($page->note()->isNotEmpty()): ?>
                <div class="text-base text-gray-600 italic mt-6 pt-4 border-t border-gray-100">
                  <?= $page->note() ?>
                </div>
              <?php endif ?>
            </div>
          <?php endif ?>
        </section>

        <?php if ($page->rental_title()->isNotEmpty()): ?>
          <section class="mb-16 w-[90%]">
            <h2 class="text-3xl font-light text-primary mb-6 border-b border-primary/20 pb-3">
              <?= $page->rental_title() ?>
            </h2>
            
            <?php if ($page->rental_text()->isNotEmpty()): ?>
              <div class="bg-white p-6">
                <div class="prose prose-lg max-w-none prose-headings:text-primary prose-p:text-gray-700">
                  <?= $page->rental_text()->kirbytext() ?>
                </div>
              </div>
            <?php endif ?>
          </section>
        <?php endif ?>
      </div>
      
      <!-- Speisekarte Section -->
      <div class="lg:w-1/2">
        <section class="w-[85%]">
          <h2 class="text-4xl font-light text-primary mb-8 border-b border-primary/20 pb-3">
            Speisekarte
          </h2>

          <?php
          $activeTab = 'nicht-alkoholisch';
          if (isset($_GET['tab'])) {
            $activeTab = $_GET['tab'];
          }
          ?>

          <div class="mb-8">
            <noscript>
              <style>
                [data-speisekarte-panel] {
                  display: block !important;
                  margin-bottom: 2rem;
                }
                [data-speisekarte-button] {
                  display: none !important;
                }
              </style>
            </noscript>
            
            <div class="flex flex-wrap gap-2 mb-8">
              <button type="button" id="tab-nicht-alkoholisch" 
                data-speisekarte-button data-target="panel-nicht-alkoholisch"
                class="px-4 py-2 text-base border border-primary transition-colors speisekarte-tab
                <?= $activeTab === 'nicht-alkoholisch' ? 'active' : '' ?>"
                role="tab" aria-controls="panel-nicht-alkoholisch"
                aria-selected="<?= $activeTab === 'nicht-alkoholisch' ? 'true' : 'false' ?>">
                Alkoholfreie Getränke
              </button>

              <button type="button" id="tab-biere" 
                data-speisekarte-button data-target="panel-biere"
                class="px-4 py-2 text-base border border-primary transition-colors speisekarte-tab
                <?= $activeTab === 'biere' ? 'active' : '' ?>"
                role="tab" aria-controls="panel-biere"
                aria-selected="<?= $activeTab === 'biere' ? 'true' : 'false' ?>">
                Biere
              </button>

              <button type="button" id="tab-longdrinks" 
                data-speisekarte-button data-target="panel-longdrinks"
                class="px-4 py-2 text-base border border-primary transition-colors speisekarte-tab
                <?= $activeTab === 'longdrinks' ? 'active' : '' ?>"
                role="tab" aria-controls="panel-longdrinks"
                aria-selected="<?= $activeTab === 'longdrinks' ? 'true' : 'false' ?>">
                Longdrinks
              </button>

              <button type="button" id="tab-verschiedenes" 
                data-speisekarte-button data-target="panel-verschiedenes"
                class="px-4 py-2 text-base border border-primary transition-colors speisekarte-tab
                <?= $activeTab === 'verschiedenes' ? 'active' : '' ?>"
                role="tab" aria-controls="panel-verschiedenes"
                aria-selected="<?= $activeTab === 'verschiedenes' ? 'true' : 'false' ?>">
                Verschiedenes
              </button>
            </div>
          </div>

          <!-- Alkoholfreie Getränke -->
          <div id="panel-nicht-alkoholisch" data-speisekarte-panel
            class="<?= $activeTab !== 'nicht-alkoholisch' ? 'hidden' : '' ?>" 
            role="tabpanel" aria-labelledby="tab-nicht-alkoholisch" 
            <?= $activeTab !== 'nicht-alkoholisch' ? 'aria-hidden="true"' : '' ?>>
            
            <div class="bg-white p-6 ">
              <h3 class="text-2xl font-light text-primary mb-6">
                <?= $page->non_alcoholic_title()->or('Alkoholfreie Getränke') ?>
              </h3>

              <?php if ($page->non_alcoholic()->isNotEmpty()): ?>
                <div class="space-y-3">
                  <?php foreach ($page->non_alcoholic()->toStructure() as $drink): ?>
                    <div class="flex justify-between items-start py-2 border-b border-gray-100 last:border-b-0">
                      <div class="flex-1">
                        <div class="text-base text-gray-900"><?= $drink->name() ?></div>
                        <?php if ($drink->type()->isNotEmpty() || ($drink->size()->isNotEmpty() && $drink->size() !== '-')): ?>
                          <div class="text-sm text-gray-600">
                            <?php if ($drink->type()->isNotEmpty()): ?>
                              <?= $drink->type() ?>
                            <?php endif ?>
                            <?php if ($drink->size()->isNotEmpty() && $drink->size() !== '-'): ?>
                              <?php if ($drink->type()->isNotEmpty()): ?> • <?php endif ?>
                              <?= $drink->size() ?>
                            <?php endif ?>
                          </div>
                        <?php endif ?>
                      </div>
                      <div class="text-base font-medium text-primary ml-4">
                        <?= number_format($drink->price()->toFloat(), 2, ',', '.') ?>&nbsp;€
                      </div>
                    </div>
                  <?php endforeach ?>
                </div>
              <?php else: ?>
                <p class="text-gray-600 italic">Keine Getränke verfügbar</p>
              <?php endif ?>
            </div>
          </div>

          <!-- Biere -->
          <div id="panel-biere" data-speisekarte-panel 
            class="<?= $activeTab !== 'biere' ? 'hidden' : '' ?>" 
            role="tabpanel" aria-labelledby="tab-biere" 
            <?= $activeTab !== 'biere' ? 'aria-hidden="true"' : '' ?>>
            
            <div class="bg-white p-6 ">
              <h3 class="text-2xl font-light text-primary mb-6">
                <?= $page->beer_title()->or('Biere') ?>
              </h3>

              <?php if ($page->beers()->isNotEmpty()): ?>
                <div class="space-y-3">
                  <?php foreach ($page->beers()->toStructure() as $beer): ?>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100 last:border-b-0">
                      <div class="text-base text-gray-900"><?= $beer->name() ?></div>
                      <div class="text-base font-medium text-primary">
                        <?= number_format($beer->price()->toFloat(), 2, ',', '.') ?>&nbsp;€
                      </div>
                    </div>
                  <?php endforeach ?>
                </div>
              <?php else: ?>
                <p class="text-gray-600 italic">Keine Biere verfügbar</p>
              <?php endif ?>
            </div>
          </div>

          <!-- Longdrinks -->
          <div id="panel-longdrinks" data-speisekarte-panel 
            class="<?= $activeTab !== 'longdrinks' ? 'hidden' : '' ?>" 
            role="tabpanel" aria-labelledby="tab-longdrinks" 
            <?= $activeTab !== 'longdrinks' ? 'aria-hidden="true"' : '' ?>>
            
            <div class="bg-white p-6 ">
              <h3 class="text-2xl font-light text-primary mb-6">
                <?= $page->longdrinks_title()->or('Longdrinks') ?>
              </h3>

              <?php if ($page->longdrinks()->isNotEmpty()): ?>
                <div class="space-y-3">
                  <?php foreach ($page->longdrinks()->toStructure() as $drink): ?>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100 last:border-b-0">
                      <div class="text-base text-gray-900"><?= $drink->name() ?></div>
                      <div class="text-base font-medium text-primary">
                        <?= number_format($drink->price()->toFloat(), 2, ',', '.') ?>&nbsp;€
                      </div>
                    </div>
                  <?php endforeach ?>
                </div>
              <?php else: ?>
                <p class="text-gray-600 italic">Keine Longdrinks verfügbar</p>
              <?php endif ?>
            </div>
          </div>

          <!-- Verschiedenes -->
          <div id="panel-verschiedenes" data-speisekarte-panel 
            class="<?= $activeTab !== 'verschiedenes' ? 'hidden' : '' ?>" 
            role="tabpanel" aria-labelledby="tab-verschiedenes" 
            <?= $activeTab !== 'verschiedenes' ? 'aria-hidden="true"' : '' ?>>
            
            <div class="bg-white p-6 ">
              <h3 class="text-2xl font-light text-primary mb-6">
                <?= $page->misc_title()->or('Verschiedenes') ?>
              </h3>

              <?php if ($page->misc()->isNotEmpty()): ?>
                <div class="space-y-3">
                  <?php foreach ($page->misc()->toStructure() as $item): ?>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100 last:border-b-0">
                      <div class="text-base text-gray-900"><?= $item->name() ?></div>
                      <div class="text-base font-medium text-primary">
                        <?= number_format($item->price()->toFloat(), 2, ',', '.') ?>&nbsp;€
                      </div>
                    </div>
                  <?php endforeach ?>
                </div>
              <?php else: ?>
                <p class="text-gray-600 italic">Keine Einträge verfügbar</p>
              <?php endif ?>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</main>

<?php snippet('footer') ?>