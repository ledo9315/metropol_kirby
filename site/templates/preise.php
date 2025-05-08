<?php snippet('header') ?>

<main class="py-12 mb-20">
  <div class="container mx-auto px-4">
    <div class="max-w-5xl mx-auto">
      <?php snippet('components/back-to-home') ?>

      <h1 class="sr-only"><?= $page->title() ?></h1>
      <?php if ($page->intro()->isNotEmpty()): ?>
        <p class="text-lg text-gray-700 mb-8">
          <?= $page->intro() ?>
        </p>
      <?php endif ?>

      <section aria-labelledby="kartenpreise-heading">
        <h2 id="kartenpreise-heading" class="text-6xl font-[300] text-primary mb-4 mt-8 relative">
          Kartenpreise
          <span class="absolute bottom-0 left-0 w-24 h-1 bg-primary" aria-hidden="true"></span>
        </h2>

        <hr class="border-primary mb-12">

        <div class="mb-12">
          <?php if ($prices = $page->prices()->toStructure()): ?>
            <table class="w-full border-collapse mb-4" aria-label="Übersicht der Kartenpreise">
              <tbody>
                <?php foreach ($prices as $price): ?>
                  <tr>
                    <td class="py-2 align-top"><?= $price->category() ?></td>
                    <td class="py-2 text-right font-[300] text-secondary">
                      <?= number_format($price->amount()->toFloat(), 2, ',', '.') ?>€
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          <?php endif ?>

          <?php if ($page->note()->isNotEmpty()): ?>
            <p class="text-sm text-gray-700 mb-12">
              <?= $page->note() ?>
            </p>
          <?php endif ?>
        </div>
      </section>

      <section aria-labelledby="speisekarte-heading">
        <h2 id="speisekarte-heading" class="text-6xl font-[300] text-primary mb-8 mt-24 relative">
          Speisekarte
          <span class="absolute bottom-0 left-0 w-24 h-1 bg-primary" aria-hidden="true"></span>
        </h2>
        <hr class="border-primary mb-12">

        <?php
        $activeTab = 'nicht-alkoholisch';

        if (isset($_GET['tab'])) {
          $activeTab = $_GET['tab'];
        }
        ?>

        <div class="flex flex-wrap mb-10" role="tablist" aria-label="Speisekarte Kategorien">
          <button type="button" id="tab-nicht-alkoholisch" data-speisekarte-button data-target="panel-nicht-alkoholisch"
            class="px-4 py-3 mr-2 mb-2 <?= $activeTab === 'nicht-alkoholisch' ? 'bg-primary text-white' : 'border border-primary text-primary' ?>"
            role="tab" aria-controls="panel-nicht-alkoholisch"
            aria-selected="<?= $activeTab === 'nicht-alkoholisch' ? 'true' : 'false' ?>">
            Nicht alkoholische Getränke
          </button>

          <button type="button" id="tab-biere" data-speisekarte-button data-target="panel-biere"
            class="px-4 py-3 mr-2 mb-2 <?= $activeTab === 'biere' ? 'bg-primary text-white' : 'border border-primary text-primary' ?>"
            role="tab" aria-controls="panel-biere" aria-selected="<?= $activeTab === 'biere' ? 'true' : 'false' ?>">
            Biere
          </button>

          <button type="button" id="tab-longdrinks" data-speisekarte-button data-target="panel-longdrinks"
            class="px-4 py-3 mr-2 mb-2 <?= $activeTab === 'longdrinks' ? 'bg-primary text-white' : 'border border-primary text-primary' ?>"
            role="tab" aria-controls="panel-longdrinks"
            aria-selected="<?= $activeTab === 'longdrinks' ? 'true' : 'false' ?>">
            Longdrinks
          </button>

          <button type="button" id="tab-verschiedenes" data-speisekarte-button data-target="panel-verschiedenes"
            class="px-4 py-3 mr-2 mb-2 <?= $activeTab === 'verschiedenes' ? 'bg-primary text-white' : 'border border-primary text-primary' ?>"
            role="tab" aria-controls="panel-verschiedenes"
            aria-selected="<?= $activeTab === 'verschiedenes' ? 'true' : 'false' ?>">
            Verschiedenes
          </button>
        </div>

        <div id="panel-nicht-alkoholisch" data-speisekarte-panel
          class="<?= $activeTab !== 'nicht-alkoholisch' ? 'hidden' : '' ?> mb-16" role="tabpanel"
          aria-labelledby="tab-nicht-alkoholisch" <?= $activeTab !== 'nicht-alkoholisch' ? 'aria-hidden="true"' : '' ?>>
          <h3 class="text-3xl font-[300] text-primary mb-6">
            <?= $page->non_alcoholic_title()->or('Alkoholfreie Getränke') ?>
          </h3>

          <table class="w-full" aria-label="Preisliste für alkoholfreie Getränke">
            <colgroup>
              <col width="35%">
              <col width="25%">
              <col width="15%">
              <col width="25%">
            </colgroup>
            <thead>
              <tr>
                <th align="left" class="py-2 font-normal text-primary border-b border-primary" scope="col">Name</th>
                <th align="left" class="py-2 font-normal text-primary border-b border-primary" scope="col">Art</th>
                <th align="center" class="py-2 font-normal text-primary border-b border-primary" scope="col">Größe</th>
                <th align="right" class="py-2 font-normal text-primary border-b border-primary" scope="col">Preis</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($page->non_alcoholic()->isNotEmpty()): ?>
                <?php foreach ($page->non_alcoholic()->toStructure() as $drink): ?>
                  <tr class="border-b border-gray-100">
                    <td align="left" class="py-3"><?= $drink->name() ?></td>
                    <td align="left" class="py-3"><?= $drink->type() ?></td>
                    <td align="center" class="py-3"><?= $drink->size() ?></td>
                    <td align="right" class="py-3 font-[300] text-secondary">
                      <?= number_format($drink->price()->toFloat(), 2, ',', '.') ?>€
                    </td>
                  </tr>
                <?php endforeach ?>
              <?php else: ?>
                <tr>
                  <td colspan="4" class="py-3 text-center text-gray-500">Keine Getränke verfügbar</td>
                </tr>
              <?php endif ?>
            </tbody>
          </table>
        </div>

        <div id="panel-biere" data-speisekarte-panel class="<?= $activeTab !== 'biere' ? 'hidden' : '' ?> mb-16"
          role="tabpanel" aria-labelledby="tab-biere" <?= $activeTab !== 'biere' ? 'aria-hidden="true"' : '' ?>>
          <h3 class="text-3xl font-[300] text-primary mb-6">
            <?= $page->beer_title()->or('Biere') ?>
          </h3>

          <table class="w-full" aria-label="Preisliste für Biere">
            <colgroup>
              <col width="75%">
              <col width="25%">
            </colgroup>
            <thead>
              <tr>
                <th align="left" class="py-2 font-normal text-primary border-b border-primary" scope="col">Name</th>
                <th align="right" class="py-2 font-normal text-primary border-b border-primary" scope="col">Preis</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($page->beers()->isNotEmpty()): ?>
                <?php foreach ($page->beers()->toStructure() as $beer): ?>
                  <tr class="border-b border-gray-100">
                    <td align="left" class="py-3"><?= $beer->name() ?></td>
                    <td align="right" class="py-3 font-[300] text-secondary">
                      <?= number_format($beer->price()->toFloat(), 2, ',', '.') ?>€
                    </td>
                  </tr>
                <?php endforeach ?>
              <?php else: ?>
                <tr>
                  <td colspan="2" class="py-3 text-center text-gray-500">Keine Biere verfügbar</td>
                </tr>
              <?php endif ?>
            </tbody>
          </table>
        </div>

        <div id="panel-longdrinks" data-speisekarte-panel
          class="<?= $activeTab !== 'longdrinks' ? 'hidden' : '' ?> mb-16" role="tabpanel"
          aria-labelledby="tab-longdrinks" <?= $activeTab !== 'longdrinks' ? 'aria-hidden="true"' : '' ?>>
          <h3 class="text-3xl font-[300] text-primary mb-6">
            <?= $page->longdrinks_title()->or('Longdrinks') ?>
          </h3>

          <table class="w-full" aria-label="Preisliste für Longdrinks">
            <colgroup>
              <col width="75%">
              <col width="25%">
            </colgroup>
            <thead>
              <tr>
                <th align="left" class="py-2 font-normal text-primary border-b border-primary" scope="col">Name</th>
                <th align="right" class="py-2 font-normal text-primary border-b border-primary" scope="col">Preis</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($page->longdrinks()->isNotEmpty()): ?>
                <?php foreach ($page->longdrinks()->toStructure() as $drink): ?>
                  <tr class="border-b border-gray-100">
                    <td align="left" class="py-3"><?= $drink->name() ?></td>
                    <td align="right" class="py-3 font-[300] text-secondary">
                      <?= number_format($drink->price()->toFloat(), 2, ',', '.') ?>€
                    </td>
                  </tr>
                <?php endforeach ?>
              <?php else: ?>
                <tr>
                  <td colspan="2" class="py-3 text-center text-gray-500">Keine Longdrinks verfügbar</td>
                </tr>
              <?php endif ?>
            </tbody>
          </table>
        </div>

        <div id="panel-verschiedenes" data-speisekarte-panel
          class="<?= $activeTab !== 'verschiedenes' ? 'hidden' : '' ?> mb-16" role="tabpanel"
          aria-labelledby="tab-verschiedenes" <?= $activeTab !== 'verschiedenes' ? 'aria-hidden="true"' : '' ?>>
          <h3 class="text-3xl font-[300] text-primary mb-6">
            <?= $page->misc_title()->or('Verschiedenes') ?>
          </h3>

          <table class="w-full" aria-label="Preisliste für verschiedene Artikel">
            <colgroup>
              <col width="75%">
              <col width="25%">
            </colgroup>
            <thead>
              <tr>
                <th align="left" class="py-2 font-normal text-primary border-b border-primary" scope="col">Name</th>
                <th align="right" class="py-2 font-normal text-primary border-b border-primary" scope="col">Preis</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($page->misc()->isNotEmpty()): ?>
                <?php foreach ($page->misc()->toStructure() as $item): ?>
                  <tr class="border-b border-gray-100">
                    <td align="left" class="py-3"><?= $item->name() ?></td>
                    <td align="right" class="py-3 font-[300] text-secondary">
                      <?= number_format($item->price()->toFloat(), 2, ',', '.') ?>€
                    </td>
                  </tr>
                <?php endforeach ?>
              <?php else: ?>
                <tr>
                  <td colspan="2" class="py-3 text-center text-gray-500">Keine Einträge verfügbar</td>
                </tr>
              <?php endif ?>
            </tbody>
          </table>
        </div>
      </section>

      <?php if ($page->rental_title()->isNotEmpty()): ?>
        <section aria-labelledby="rental-heading">
          <h2 id="rental-heading" class="text-5xl font-[300] text-primary mb-8 mt-24 relative">
            <?= $page->rental_title() ?>
            <span class="absolute bottom-0 left-0 w-24 h-1 bg-primary" aria-hidden="true"></span>
          </h2>
          <?php if ($page->rental_text()->isNotEmpty()): ?>
            <div class="text-lg text-secondary mb-8 bg-white p-6 rounded-lg shadow-md">
              <?= $page->rental_text()->kirbytext() ?>
            </div>
          <?php endif ?>
        </section>
      <?php endif ?>
    </div>
  </div>
</main>

<?php snippet('footer') ?>