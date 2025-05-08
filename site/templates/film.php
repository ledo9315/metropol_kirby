<?php snippet('header') ?>

<main class="py-12 mb-20">
  <div class="container mx-auto px-12">
    <?php snippet('components/back-to-home') ?>

    <div class="container mx-auto px-4 py-12 mt-10 mb-20">
      <article itemscope itemtype="http://schema.org/Movie">
        <div class="mb-16">
          <div class="flex flex-col lg:flex-row gap-10 items-start">
            <div class="w-full lg:w-2/3 flex flex-col items-center pt-20">
              <div itemprop="image">
                <?php snippet('components/film-poster', [
                  'film' => $page,
                  'width' => 320,
                  'height' => 480,
                  'class' => 'w-[320px] h-auto shadow-lg mb-4'
                ]); ?>
              </div>

              <div class="text-center mt-2">
                <h1 class="text-4xl font-[300] text-primary mb-1" itemprop="name"><?= $page->title() ?></h1>

                <?php snippet('components/film-categories', [
                  'film' => $page,
                  'className' => 'text-secondary text-lg font-medium mb-1',
                  'useAriaLabel' => true
                ]); ?>

                <div class="text-gray-500 text-md" role="contentinfo" itemprop="offers" itemscope
                  itemtype="http://schema.org/Offer">
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

            <div class="w-full lg:w-2/3 flex flex-col gap-6">
              <?php if ($page->video()->toFiles()->first()): ?>
                <div class="aspect-video w-full mb-2">
                  <video class="w-full rounded shadow" controls
                    poster="<?= $page->cover()->toFile() ? $page->cover()->toFile()->crop(1280, 720)->url() : '' ?>"
                    aria-label="Video für <?= $page->title() ?>">
                    <source src="<?= $page->video()->toFiles()->first()->url() ?>" type="video/mp4">
                    <p>Ihr Browser unterstützt das Video-Tag nicht.</p>
                  </video>
                </div>
              <?php elseif ($page->trailer()->isNotEmpty()): ?>
                <div class="aspect-video w-full mb-2">
                  <iframe class="w-full h-full rounded shadow" src="<?= $page->trailer() ?>"
                    title="Trailer für <?= $page->title() ?>" frameborder="0" allowfullscreen></iframe>
                </div>
              <?php endif ?>

              <div class="flex flex-col gap-y-4">
                <div class="prose prose-base max-w-none mb-2 text-secondary border-b border-primary pb-6"
                  itemprop="description">
                  <?= $page->description()->kirbytext() ?>
                </div>

                <?php if ($page->regisseur()->isNotEmpty()): ?>
                  <div class="border-b border-primary pb-6">
                    <h3 class="text-gray-600 font-medium">Regisseur</h3>
                    <p itemprop="director"><?= $page->regisseur() ?></p>
                  </div>
                <?php endif ?>

                <?php if ($page->produktionsfirma()->isNotEmpty()): ?>
                  <div class="border-b border-primary pb-6">
                    <h3 class="text-gray-600 font-medium">Produktionsfirma</h3>
                    <p itemprop="productionCompany"><?= $page->produktionsfirma() ?></p>
                  </div>
                <?php endif ?>

                <?php if ($page->hauptbesetzung()->isNotEmpty()): ?>
                  <div>
                    <h3 class="text-gray-600 font-medium">Hauptbesetzung</h3>
                    <p itemprop="actor"><?= $page->hauptbesetzung() ?></p>
                  </div>
                <?php endif ?>
              </div>
            </div>
          </div>
        </div>

        <?php
        $spielzeiten = $page->spielzeiten()->toStructure();
        if ($spielzeiten->count()):
          ?>
          <div class="mb-16">
            <?php snippet('components/spielzeiten', [
              'spielzeiten' => $spielzeiten,
              'showHeading' => true
            ]); ?>
          </div>
        <?php endif ?>
      </article>
    </div>
  </div>
</main>

<?php snippet('footer') ?>