<?php snippet('header') ?>

<main>
  <div class="container mx-auto px-4">
    <section class="pt-20 pb-20">
      <div class="relative bg-light overflow-hidden">
        <div class="container mx-auto py-12">
          <div class="flex flex-col xl:flex-row items-start mx-4 gap-6 lg:gap-10">
            <?php if ($image = $page->image()): ?>
              <div class="w-full xl:w-7/12 mb-6 xl:mb-0">
                <div class="overflow-hidden">
                  <?php $thumb = $image->thumb(['width' => 700, 'height' => 700, 'crop' => true]); ?>
                  <img src="<?= $thumb->url() ?>" alt="<?= $image->alt()->or($page->title()) ?>"
                    class="w-full h-auto object-cover rounded shadow" width="<?= $thumb->width() ?>"
                    height="<?= $thumb->height() ?>" loading="eager" />
                </div>
              </div>
            <?php endif ?>

            <div class="w-full xl:w-[550px] px-4">
              <div class="h-full flex flex-col justify-start">
                <h1
                  class="text-3xl sm:text-5xl md:text-[4rem] lg:text-[5rem] leading-none font-[300] text-primary mb-6 sm:mb-8">
                  <?= $page->title() ?>
                </h1>
                <div class="prose prose-base sm:prose-lg mb-6 sm:mb-8 max-w-none text-secondary leading-[1.7]">
                  <?= $page->description()->kirbytext() ?>
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

    <section id="programm" class="pt-20 pb-20">
      <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-[300] text-primary mb-8 sm:mb-12 md:mb-16">Aktuell im
        Programm</h2>
      <div>
        <?php
        if ($programmPage = page('programm')):
          $allMovies = $programmPage->children()->listed();

          $currentMovies = $allMovies->filterBy('programm_status', 'current');

          if ($currentMovies->count() > 0):
            foreach ($currentMovies as $movie):
              ?>
              <div class="flex flex-col md:flex-row mb-8 md:mb-12 gap-6 md:gap-12">
                <div class="w-full md:w-1/3">
                  <?php if ($cover = $movie->cover()->toFile()): ?>
                    <img src="<?= $cover->url() ?>" alt="<?= $movie->title() ?>" class="w-full h-auto">
                  <?php else: ?>
                    <div class="w-full aspect-[3/4] bg-gray-200 flex items-center justify-center text-sm sm:text-base">
                      <span class="text-gray-500">Kein Filmposter</span>
                    </div>
                  <?php endif ?>
                </div>

                <div class="w-full md:w-2/3 md:pl-10 mt-6 md:mt-0">
                  <h3 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-[300] leading-none text-primary mb-4">
                    <?= $movie->title() ?>
                    (<?= $movie->year() ?>)
                  </h3>

                  <div class="text-gray-500 mb-6 sm:mb-8 md:mb-12 text-sm sm:text-base">
                    <?php
                    $categories = [];
                    if ($movie->familienfilm()->isTrue())
                      $categories[] = 'Familienfilm';
                    if ($movie->animation()->isTrue())
                      $categories[] = 'Animation';
                    if ($movie->fantasy()->isTrue())
                      $categories[] = 'Fantasy';
                    if ($movie->liebesfilm()->isTrue())
                      $categories[] = 'Liebesfilm';
                    if ($movie->maerchenfilm()->isTrue())
                      $categories[] = 'Märchenfilm';
                    if ($movie->musical()->isTrue())
                      $categories[] = 'Musical';
                    if ($movie->kinderfilm()->isTrue())
                      $categories[] = 'Kinderfilm';
                    if ($movie->drama()->isTrue())
                      $categories[] = 'Drama';
                    if ($movie->komoedie()->isTrue())
                      $categories[] = 'Komödie';

                    echo implode(' / ', $categories);
                    ?>
                  </div>

                  <?php if ($spielzeiten = $movie->spielzeiten()->toStructure()):
                    $count = 0;
                    $total = $spielzeiten->count();
                    ?>
                    <?php foreach ($spielzeiten as $spielzeit):
                      $count++;
                      ?>
                      <div class="mb-3 flex items-center justify-between">
                        <div class="text-xl font-[300]">
                          <?php
                          // Wenn das Datum heute ist, "Heute" anzeigen
                          $date = $spielzeit->date()->toDate('d.m.Y');
                          $today = date('d.m.Y');
                          $tomorrow = date('d.m.Y', strtotime('+1 day'));

                          switch ($date) {
                            case $today:
                              echo 'Heute um ' . $spielzeit->time()->toDate('H.i') . ' Uhr';
                              break;
                            case $tomorrow:
                              echo 'Morgen um ' . $spielzeit->time()->toDate('H.i') . ' Uhr';
                              break;
                            default:
                              echo $spielzeit->date()->toDate('d.m.') . ' um ' . $spielzeit->time()->toDate('H.i') . ' Uhr';
                              break;
                          }
                          ?>
                        </div>

                        <div class="px-3 rounded-2xl py-0.5 border border-gray-500 text-secondary text-sm font-medium">
                          <?= $spielzeit->format() ?>
                        </div>
                      </div>
                      <?php if ($count < $total): ?>
                        <hr class="border-t border-primary my-2">
                      <?php endif; ?>
                    <?php endforeach ?>
                  <?php endif ?>

                  <div class="mt-8">
                    <a href="<?= $movie->url() ?>"
                      class="text-primary inline-flex items-center hover:opacity-80 transition-opacity">
                      Mehr erfahren &rarr;
                    </a>
                  </div>
                </div>
              </div>
              <?php
            endforeach;
          else:
            ?>
            <div class="bg-blue-100 text-blue-800 p-4 rounded" role="status">
              Aktuell keine Filme im Programm.
            </div>
            <?php
          endif;
        endif;
        ?>
      </div>
    </section>

    <section id="demnaechst" class="pt-20 pb-80">
      <header class="mb-16">
        <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-[300] text-primary mb-8 sm:mb-12 md:mb-16">
          Demnächst</h2>
      </header>

      <div>
        <?php
        if ($programmPage = page('programm')):
          if ($upcoming = $programmPage->children()->listed()->filterBy('programm_status', 'upcoming')->limit(3)):
            if ($upcoming->count() > 0):
              ?>
              <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 md:gap-12 lg:gap-16">
                <?php foreach ($upcoming as $movie): ?>
                  <article>
                    <a href="<?= $movie->url() ?>" class="block group">
                      <?php if ($movieImage = $movie->cover()->toFile()): ?>
                        <div class="overflow-hidden mb-2 sm:mb-4">
                          <img src="<?= $movieImage->thumb(['width' => 400, 'height' => 600])->url() ?>"
                            alt="<?= $movie->title() ?>"
                            class="w-full h-auto rounded shadow group-hover:scale-105 transition-transform duration-300"
                            loading="lazy">
                        </div>
                      <?php else: ?>
                        <div
                          class="w-full aspect-[2/3] bg-gray-200 mb-2 sm:mb-4 flex items-center justify-center text-sm sm:text-base">
                          <span class="text-gray-500">Kein Filmposter</span>
                        </div>
                      <?php endif ?>

                      <h3 class="text-xl sm:text-2xl md:text-3xl text-center font-medium text-primary mb-1 sm:mb-2">
                        <?= $movie->title() ?>
                      </h3>

                      <?php
                      $categories = [];
                      if ($movie->familienfilm()->isTrue())
                        $categories[] = 'Familienfilm';
                      if ($movie->animation()->isTrue())
                        $categories[] = 'Animation';
                      if ($movie->fantasy()->isTrue())
                        $categories[] = 'Fantasy';
                      if ($movie->liebesfilm()->isTrue())
                        $categories[] = 'Liebesfilm';
                      if ($movie->maerchenfilm()->isTrue())
                        $categories[] = 'Märchenfilm';
                      if ($movie->musical()->isTrue())
                        $categories[] = 'Musical';
                      if ($movie->kinderfilm()->isTrue())
                        $categories[] = 'Kinderfilm';
                      if ($movie->drama()->isTrue())
                        $categories[] = 'Drama';
                      if ($movie->komoedie()->isTrue())
                        $categories[] = 'Komödie';
                      if ($movie->action()->isTrue())
                        $categories[] = 'Action';
                      if ($movie->abenteuer()->isTrue())
                        $categories[] = 'Abenteuer';
                      ?>

                      <?php if (!empty($categories)): ?>
                        <div class="text-secondary font-medium text-center text-sm sm:text-base md:text-lg mb-1">
                          <?= implode(' / ', $categories) ?>
                        </div>
                      <?php endif ?>

                      <div class="text-gray-600 text-center text-xs sm:text-sm">
                        <?php
                        $details = [];

                        if ($movie->year()->isNotEmpty())
                          $details[] = $movie->year();

                        if ($movie->runtime()->isNotEmpty())
                          $details[] = $movie->runtime() . ' Min';

                        if ($movie->fsk()->isNotEmpty())
                          $details[] = 'FSK ' . $movie->fsk();

                        if ($movie->format()->isNotEmpty())
                          $details[] = $movie->format();

                        if (!empty($details))
                          echo '/ ' . implode(' / ', $details);
                        ?>
                      </div>
                    </a>
                  </article>
                <?php endforeach; ?>
              </div>
              <?php
            else:
              ?>
              <div class="bg-blue-100 text-blue-800 p-4 rounded" role="status">Keine kommenden Filme im Programm.</div>
              <?php
            endif;
          else:
            ?>
            <div class="bg-blue-100 text-blue-800 p-4 rounded" role="status">Keine kommenden Filme im Programm.</div>
            <?php
          endif;
        endif;
        ?>
      </div>
    </section>


  </div>
</main>

<?php snippet('footer') ?>