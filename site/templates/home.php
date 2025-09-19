<?php snippet('header') ?>

<main>
  <div class="container mx-auto px-4">
    <section class="sm:pt-14 pt-0 pb-20" aria-labelledby="main-heading">
      <div class="relative overflow-hidden">
        <div class="py-12">
          <div class="flex flex-col xl:flex-row items-start gap-6 lg:gap-10">
            <?php if ($image = $page->image()): ?>
              <div class="w-full xl:w-7/12 mb-6 xl:mb-0">
                <div class="overflow-hidden">
                  <?php $thumb = $image->thumb(['width' => 700, 'height' => 700, 'crop' => true]); ?>
                  <img src="<?= $thumb->url() ?>" alt="<?= $image->alt()->or($page->title()) ?>"
                    class="w-full max-h-[620px] object-cover shadow" width="<?= $thumb->width() ?>"
                    height="<?= $thumb->height() ?>" loading="eager" role="img" />
                </div>
              </div>
            <?php endif ?>

            <div class="w-full xl:w-[550px] xl:px-4">
              <div class="h-full flex flex-col justify-start">
                <h1 id="main-heading"
                  class="text-3xl sm:text-5xl md:text-[4rem] lg:text-[5rem] leading-none font-[300] text-primary mb-6 sm:mb-8">
                  <?= $page->title() ?>
                </h1>
                <div class="prose prose-base sm:prose-lg mb-6 sm:mb-8 max-w-none text-secondary">
                  <?= str_replace("\n", " ", $page->description()->value()) ?>
                </div>
                <div class="mt-8">
                  <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl leading-none font-[300] text-primary mb-4">
                    <?= $site->hint_title()->html() ?>
                  </h2>
                  <div class="mb-4">
                    <?= $site->hint_text()->kirbytext() ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="programm" class="pt-20 pb-20" aria-labelledby="programm-heading">
      <h2 id="programm-heading"
        class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-[300] text-primary mb-8 sm:mb-12 md:mb-16">
        Aktuell im Programm
      </h2>
      <div>
        <?php
        if ($programmPage = page('programm')):
          $allMovies = $programmPage->children()->listed();
          $currentMovies = $allMovies->filterBy('programm_status', 'current');

          if ($currentMovies->count() > 0):
            foreach ($currentMovies as $movie):
              ?>
              <article class="flex flex-col md:flex-row mb-8 md:mb-12 gap-6 md:gap-12" itemscope
                itemtype="http://schema.org/Movie">
                <div class="w-full md:w-1/3">
                  <?php snippet('components/film-poster', [
                    'film' => $movie
                  ]); ?>
                </div>

                <div class="w-full md:w-2/3 xl:w-1/3 md:pl-10 mt-6 md:mt-0">
                  <h3 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-[300] leading-none text-primary mb-4 mt-8"
                    itemprop="name">
                    <?= $movie->title() ?>
                  </h3>
                  <?php snippet('components/film-categories', [
                    'film' => $movie,
                    'className' => 'text-secondary text-base font-medium'
                  ]); ?>
                  <div class="text-lg text-gray-500 mb-6 sm:mb-8 md:mb-10">
                    <?= snippet('components/film-details', [
                      'film' => $movie,
                      'showProductionCountry' => true
                    ]) ?>
                  </div>

                  <?php
                  $spielzeiten = $movie->spielzeiten()->toStructure();
                  if ($spielzeiten->count() > 0):
                    snippet('components/spielzeiten', [
                      'spielzeiten' => $spielzeiten
                    ]);
                  endif;
                  ?>

                  <div class="mt-8">
                    <a href="<?= $movie->url() ?>"
                      class="text-primary inline-flex items-center hover:opacity-80 transition-opacity"
                      aria-label="Mehr über <?= $movie->title() ?> erfahren">
                      Weitere Informationen &rarr;
                    </a>
                  </div>
                </div>
              </article>
              <?php
            endforeach;
          else:
            ?>
            <div class="bg-red-100 text-red-800 p-4" role="status" aria-live="polite">
              Aktuell keine Filme im Programm.
            </div>
            <?php
          endif;
        endif;
        ?>
      </div>
    </section>

    <section id="demnaechst" class="pt-20 pb-80" aria-labelledby="demnaechst-heading">
      <header class="mb-16">
        <h2 id="demnaechst-heading"
          class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-[300] text-primary mb-8 sm:mb-12 md:mb-16">
          Demnächst
        </h2>
      </header>

      <div>
        <?php
        if ($programmPage = page('programm')):
          if ($upcoming = $programmPage->children()->listed()->filterBy('programm_status', 'upcoming')):
            if ($upcoming->count() > 0):
              ?>
              <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-20 md:gap-12 lg:gap-16">
                <?php foreach ($upcoming as $movie): ?>
                  <article itemscope itemtype="http://schema.org/Movie">
                    <a href="<?= $movie->url() ?>" class="block group" aria-label="Details zu <?= $movie->title() ?>">
                      <?php if ($movieImage = $movie->cover()->toFile()): ?>
                        <div class="overflow-hidden mb-2 sm:mb-4 border border-secondary">
                          <img src="<?= $movieImage->thumb(['width' => 400, 'height' => 600, 'crop' => true])->url() ?>"
                            alt="<?= $movie->title() ?>"
                            class="w-full aspect-[2/3] object-cover shadow group-hover:scale-105 transition-transform duration-300"
                            loading="lazy" role="img">
                        </div>
                      <?php else: ?>
                        <div
                          class="w-full aspect-[2/3] bg-gray-200 mb-2 sm:mb-4 flex items-center justify-center text-sm sm:text-base"
                          role="img" aria-label="Kein Filmposter für <?= $movie->title() ?> verfügbar">
                          <span class="text-gray-500">Kein Filmposter</span>
                        </div>
                      <?php endif ?>

                      <h3 class="text-xl sm:text-2xl md:text-3xl text-center font-[300] text-primary mb-2 sm:mb-2"
                        itemprop="name">
                        <?= $movie->title() ?>
                      </h3>

                      <div class="text-base text-secondary font-medium text-center mb-2 sm:mb-3">
                        <?= implode(' <span class="text-primary"> | </span> ', getFilmCategories($movie)) ?>
                      </div>

                      <div class="text-lg text-gray-500 text-center">
                        <?= snippet('components/film-details', [
                          'film' => $movie,
                          'showProductionCountry' => false,
                        ]) ?>
                      </div>
                    </a>
                  </article>
                <?php endforeach; ?>
              </div>
              <?php
            else:
              ?>
              <div class="bg-blue-100 text-blue-800 p-4" role="status" aria-live="polite">Keine kommenden Filme im
                Programm.</div>
              <?php
            endif;
          else:
            ?>
            <div class="bg-blue-100 text-blue-800 p-4" role="status" aria-live="polite">Keine kommenden Filme im
              Programm.</div>
            <?php
          endif;
        endif;
        ?>
      </div>
    </section>
  </div>
</main>

<?php snippet('footer') ?>