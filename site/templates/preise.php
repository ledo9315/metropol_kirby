<?php snippet('header') ?>

<main class="py-12 mb-20">
  <article class="relative">
    <div class="container mx-auto px-4">
      <?php snippet('components/back-to-home') ?>


      <div class="flex flex-col lg:flex-row gap-16 max-w-7xl mx-auto mb-24">
        <div class="lg:w-1/2">
          <section class="mb-16">
            <h2 class="text-5xl font-light text-primary pb-1 border-b border-primary inline-block mb-8">
              Kartenpreise
            </h2>

            <?php if ($prices = $page->prices()->toStructure()): ?>
              <div class="space-y-4 mt-10">
                <?php foreach ($prices as $price): ?>
                  <div class="flex items-center justify-between py-2 pl-4 border-l-2 border-transparent">
                    <span class="text-base"><?= $price->category() ?></span>
                    <span class="font-medium text-secondary ml-8 pl-8 border-l border-gray-100 text-base">
                      <?= number_format($price->amount()->toFloat(), 2, ',', '.') ?>&nbsp;€
                    </span>
                  </div>
                <?php endforeach ?>
              </div>
              
              <?php if ($page->note()->isNotEmpty()): ?>
                <div class="text-base text-gray-600 italic mt-8 pl-4 border-l border-gray-200">
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
            <h2 class="text-5xl font-light text-primary pb-1 border-b border-primary inline-block mb-10">
              Speisekarte
            </h2>

            <?php
            $activeTab = 'nicht-alkoholisch';
            if (isset($_GET['tab'])) {
              $activeTab = $_GET['tab'];
            }
            ?>

            <div class="mt-10 mb-10">
              <div class="inline-flex flex-wrap gap-2 p-1 bg-gray-50 rounded">
                <button type="button" id="tab-nicht-alkoholisch" 
                  data-speisekarte-button data-target="panel-nicht-alkoholisch"
                  class="px-4 py-2 text-base rounded-sm 
                  <?= $activeTab === 'nicht-alkoholisch' ? 'bg-primary text-white shadow-sm' : 'text-primary' ?>"
                  role="tab" aria-controls="panel-nicht-alkoholisch"
                  aria-selected="<?= $activeTab === 'nicht-alkoholisch' ? 'true' : 'false' ?>">
                  Alkoholfreie Getränke
                </button>

                <button type="button" id="tab-biere" 
                  data-speisekarte-button data-target="panel-biere"
                  class="px-4 py-2 text-base rounded-sm 
                  <?= $activeTab === 'biere' ? 'bg-primary text-white shadow-sm' : 'text-primary' ?>"
                  role="tab" aria-controls="panel-biere"
                  aria-selected="<?= $activeTab === 'biere' ? 'true' : 'false' ?>">
                  Biere
                </button>

                <button type="button" id="tab-longdrinks" 
                  data-speisekarte-button data-target="panel-longdrinks"
                  class="px-4 py-2 text-base rounded-sm 
                  <?= $activeTab === 'longdrinks' ? 'bg-primary text-white shadow-sm' : 'text-primary' ?>"
                  role="tab" aria-controls="panel-longdrinks"
                  aria-selected="<?= $activeTab === 'longdrinks' ? 'true' : 'false' ?>">
                  Longdrinks
                </button>

                <button type="button" id="tab-verschiedenes" 
                  data-speisekarte-button data-target="panel-verschiedenes"
                  class="px-4 py-2 text-base rounded-sm 
                  <?= $activeTab === 'verschiedenes' ? 'bg-primary text-white shadow-sm' : 'text-primary' ?>"
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
              
              <h3 class="text-2xl font-medium text-primary mb-6 pl-4 border-l-2 border-primary">
                <?= $page->non_alcoholic_title()->or('Alkoholfreie Getränke') ?>
              </h3>

              <?php if ($page->non_alcoholic()->isNotEmpty()): ?>
                <div class="space-y-3">
                  <div class="flex text-sm uppercase tracking-wider text-gray-500 mb-2 font-medium">
                    <div class="w-20">Größe</div>
                    <div class="flex-1">Name</div>
                    <div class="w-20 text-right">Preis</div>
                  </div>
                  
                  <?php foreach ($page->non_alcoholic()->toStructure() as $drink): ?>
                    <div class="flex py-3 px-2 rounded">
                      <div class="w-20 text-gray-600 text-base"><?= $drink->size() ?></div>
                      <div class="flex-1">
                        <div class="font-medium text-base"><?= $drink->name() ?></div>
                        <div class="text-base text-gray-500"><?= $drink->type() ?></div>
                      </div>
                      <div class="w-20 font-medium text-secondary text-right self-start pt-1 text-base">
                        <?= number_format($drink->price()->toFloat(), 2, ',', '.') ?>&nbsp;€
                      </div>
                    </div>
                  <?php endforeach ?>
                </div>
              <?php else: ?>
                <p class="text-gray-500 italic">Keine Getränke verfügbar</p>
              <?php endif ?>
            </div>

            <div id="panel-biere" data-speisekarte-panel 
              class="<?= $activeTab !== 'biere' ? 'hidden' : '' ?>" 
              role="tabpanel" aria-labelledby="tab-biere" 
              <?= $activeTab !== 'biere' ? 'aria-hidden="true"' : '' ?>>
              
              <h3 class="text-2xl font-medium text-primary mb-6 pl-4 border-l-2 border-primary">
                <?= $page->beer_title()->or('Biere') ?>
              </h3>

              <?php if ($page->beers()->isNotEmpty()): ?>
                <div class="space-y-3">
                  <?php foreach ($page->beers()->toStructure() as $beer): ?>
                    <div class="flex justify-between py-3 px-2 rounded">
                      <div class="font-medium text-base"><?= $beer->name() ?></div>
                      <div class="font-medium text-secondary ml-8 text-base">
                        <?= number_format($beer->price()->toFloat(), 2, ',', '.') ?>&nbsp;€
                      </div>
                    </div>
                  <?php endforeach ?>
                </div>
              <?php else: ?>
                <p class="text-gray-500 italic">Keine Biere verfügbar</p>
              <?php endif ?>
            </div>

            <div id="panel-longdrinks" data-speisekarte-panel 
              class="<?= $activeTab !== 'longdrinks' ? 'hidden' : '' ?>" 
              role="tabpanel" aria-labelledby="tab-longdrinks" 
              <?= $activeTab !== 'longdrinks' ? 'aria-hidden="true"' : '' ?>>
              
              <h3 class="text-2xl font-medium text-primary mb-6 pl-4 border-l-2 border-primary">
                <?= $page->longdrinks_title()->or('Longdrinks') ?>
              </h3>

              <?php if ($page->longdrinks()->isNotEmpty()): ?>
                <div class="space-y-3">
                  <?php foreach ($page->longdrinks()->toStructure() as $drink): ?>
                    <div class="flex justify-between py-3 px-2 rounded">
                      <div class="font-medium text-base"><?= $drink->name() ?></div>
                      <div class="font-medium text-secondary ml-8 text-base">
                        <?= number_format($drink->price()->toFloat(), 2, ',', '.') ?>&nbsp;€
                      </div>
                    </div>
                  <?php endforeach ?>
                </div>
              <?php else: ?>
                <p class="text-gray-500 italic">Keine Longdrinks verfügbar</p>
              <?php endif ?>
            </div>

            <div id="panel-verschiedenes" data-speisekarte-panel 
              class="<?= $activeTab !== 'verschiedenes' ? 'hidden' : '' ?>" 
              role="tabpanel" aria-labelledby="tab-verschiedenes" 
              <?= $activeTab !== 'verschiedenes' ? 'aria-hidden="true"' : '' ?>>
              
              <h3 class="text-2xl font-medium text-primary mb-6 pl-4 border-l-2 border-primary">
                <?= $page->misc_title()->or('Verschiedenes') ?>
              </h3>

              <?php if ($page->misc()->isNotEmpty()): ?>
                <div class="space-y-3">
                  <?php foreach ($page->misc()->toStructure() as $item): ?>
                    <div class="flex justify-between py-3 px-2 rounded">
                      <div class="font-medium text-base"><?= $item->name() ?></div>
                      <div class="font-medium text-secondary ml-8 text-base">
                        <?= number_format($item->price()->toFloat(), 2, ',', '.') ?>&nbsp;€
                      </div>
                    </div>
                  <?php endforeach ?>
                </div>
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