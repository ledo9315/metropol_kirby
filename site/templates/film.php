<?php snippet('header') ?>

<main class="py-8">
  <div class="container mx-auto px-4 lg:px-8">

    <article class="mb-40" itemscope itemtype="http://schema.org/Movie">
      <!-- Zwei-Spalten-Layout -->
      <div class="flex flex-col lg:flex-row lg:gap-16 pt-20">

        <!-- Linke Spalte mit Poster (sticky) -->
        <div class="w-full lg:w-1/2 mb-12 lg:mb-0">
          <?php snippet('components/back-to-home') ?>

          <div style="position: -webkit-sticky; position: sticky; top: 120px;" class="flex justify-center">
            <!-- Filmposter -->
            <div>
              <div class="flex justify-center">
                <?php snippet('components/film-poster', [
                  'film' => $page,
                  'width' => 384,
                  'height' => 576,
                  'class' => 'w-[384px] h-auto shadow-lg'
                ]); ?>
              </div>

              <!-- Filmtitel und Metadaten -->
              <div class="text-start mt-6">
                <h1 class="text-4xl font-[300] text-primary mb-2" itemprop="name"><?= $page->title() ?></h1>

                <?php snippet('components/film-categories', [
                  'film' => $page,
                  'className' => 'text-secondary text-lg font-medium mb-2',
                  'useAriaLabel' => true
                ]); ?>

                <div class="text-gray-500 text-md mt-2" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                  <?php snippet('components/film-details', [
                    'film' => $page,
                    'showProductionCountry' => true
                  ]); ?>
                  <meta itemprop="price" content="0" />
                  <meta itemprop="priceCurrency" content="EUR" />
                  <meta itemprop="availability" content="https://schema.org/InStock" />
                </div>
              </div>

            </div>
          </div>
        </div>

        <!-- Rechte Spalte mit Details -->
        <div class="w-full lg:w-1/2">
          <!-- Video/Trailer -->
          <?php if ($page->video()->toFiles()->first()): ?>
            <div class="aspect-video w-full mb-8">
              <video class="w-full rounded shadow" controls
                poster="<?= $page->cover()->toFile() ? $page->cover()->toFile()->crop(1280, 720)->url() : '' ?>"
                aria-label="Video für <?= $page->title() ?>">
                <source src="<?= $page->video()->toFiles()->first()->url() ?>" type="video/mp4">
                <p>Ihr Browser unterstützt das Video-Tag nicht.</p>
              </video>
            </div>
          <?php elseif ($page->trailer()->isNotEmpty()): ?>
            <div class="aspect-video w-full mb-8">
              <iframe class="w-full h-full rounded shadow" src="<?= $page->trailer() ?>"
                title="Trailer für <?= $page->title() ?>" frameborder="0" allowfullscreen></iframe>
            </div>
          <?php endif ?>

          <!-- Filmbeschreibung -->
          <div class="prose prose-base max-w-none mb-8 text-secondary border-b border-primary pb-6"
            itemprop="description">
            <?= $page->description()->kirbytext() ?>
          </div>

          <!-- Regisseur -->
          <?php if ($page->regisseur()->isNotEmpty()): ?>
            <div class="border-b border-primary pb-6 mb-8">
              <h3 class="text-gray-600 font-medium">Regisseur</h3>
              <p itemprop="director"><?= $page->regisseur() ?></p>
            </div>
          <?php endif ?>

          <!-- Produktionsfirma -->
          <?php if ($page->produktionsfirma()->isNotEmpty()): ?>
            <div class="border-b border-primary pb-6 mb-8">
              <h3 class="text-gray-600 font-medium">Produktionsfirma</h3>
              <p itemprop="productionCompany"><?= $page->produktionsfirma() ?></p>
            </div>
          <?php endif ?>

          <!-- Hauptbesetzung -->
          <?php if ($page->hauptbesetzung()->isNotEmpty()): ?>
            <div class="border-b border-primary pb-6 mb-8">
              <h3 class="text-gray-600 font-medium">Hauptbesetzung</h3>
              <p itemprop="actor"><?= $page->hauptbesetzung() ?></p>
            </div>
          <?php endif ?>

          <!-- Spielzeiten -->
          <?php
          $spielzeiten = $page->spielzeiten()->toStructure();
          if ($spielzeiten->count()):
            ?>
            <div class="pt-20">
              <?php snippet('components/spielzeiten', [
                'spielzeiten' => $spielzeiten,
                'showHeading' => true
              ]); ?>
            </div>
          <?php endif ?>
        </div>
      </div>
    </article>
  </div>
</main>

<?php snippet('footer') ?>