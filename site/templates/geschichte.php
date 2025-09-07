<?php snippet('header') ?>

<main class="py-12 mb-20">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <?php snippet('components/back-to-home') ?>

    <?php
    $intro = $page->intro()->or('');

    $preferredHero = $page->images()->filterBy('name', 'metropol-verzehrkino')->first()
      ?? $page->images()->filterBy('name', 'metropol-theater-foto1')->first();
    $hero = $preferredHero ?? ($page->image('aktuell.jpg') ?? $page->images()->sortBy('sort', 'asc')->first());
    ?>

    <?php if ($hero): ?>
      <section class="relative mb-16" aria-label="Historisches Titelbild">
        <div class="relative h-[42vh] md:h-[56vh] w-full"
          style="background-image:url('<?= $hero->url() ?>'); background-size:cover; background-position:center;">
          <div class="absolute inset-0 bg-black/50"></div>
          <div class="absolute inset-0 flex items-end">
            <div class="w-full">
              <div class="max-w-4xl text-white px-6 py-10">
                <h1 class="text-4xl md:text-6xl font-light tracking-tight">Geschichte des Metropol</h1>
                <?php if ($intro->isNotEmpty()): ?>
                  <p class="mt-4 text-lg md:text-xl leading-relaxed">
                    <?= $intro->escape() ?>
                  </p>
                <?php endif ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php else: ?>
      <div class="text-center mb-12">
        <h1 class="text-5xl font-light text-primary mb-4">Geschichte des Metropol</h1>
        <?php if ($intro->isNotEmpty()): ?>
          <p class="text-xl text-gray-700 max-w-3xl mx-auto"><?= $intro->escape() ?></p>
        <?php endif ?>
      </div>
    <?php endif ?>

    <section class="mb-14" aria-label="Meilensteine in Zahlen">
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-10">
        <div class="pt-6 border-t border-primary">
          <div class="text-xs tracking-[0.2em] uppercase text-black/70">Eröffnung</div>
          <div class="mt-2 text-2xl md:text-3xl font-light">1909 – Metropol-Theater</div>
          <p class="text-pri mt-3 leading-relaxed">Erste Vorstellung am 29.05.1909 in der heutigen
            Posadowskystraße.</p>
        </div>
        <div class="pt-6 border-t border-primary">
          <div class="text-xs tracking-[0.2em] uppercase text-black/70">Tonfilm</div>
          <div class="mt-2 text-2xl md:text-3xl font-light">ab 1931</div>
          <p class="text-gray-800 mt-3 leading-relaxed">Beginn der Tonfilmzeit – neue Ära des Kinobetriebs.</p>
        </div>
        <div class="pt-6 border-t border-primary">
          <div class="text-xs tracking-[0.2em] uppercase text-black/70">Drittes Kino</div>
          <div class="mt-2 text-2xl md:text-3xl font-light">1951 – Film-Eck</div>
          <p class="text-gray-800 mt-3 leading-relaxed">Eröffnung im „Dithmarscher Hof“, Betrieb bis 1970.</p>
        </div>
      </div>
    </section>

    <section role="feed" aria-label="Chronik der Kino-Geschichte">
      <?php if ($milestones = $page->milestones()->toStructure()): ?>
        <?php foreach ($milestones->sortBy('year', 'asc') as $index => $milestone):
          $images = $milestone->image()->isNotEmpty() ? $milestone->image()->toFiles() : new Kirby\Cms\Files([]);
          $firstImage = $images->first();
          if (!$firstImage) {
            $pageImages = $hero ? $page->images()->not($hero) : $page->images();
            $fallback = $pageImages->first();
            if ($fallback) {
              $images = new Kirby\Cms\Files([$fallback]);
              $firstImage = $fallback;
            }
          }
          $hasImage = $firstImage !== null;
          $variant = $hasImage ? ($index % 2 === 0 ? 0 : 1) : 2; // 0 Collage, 1 Bild-oben, 2 Text-only
          $yearValue = $milestone->year()->value();
          $yearInt = $milestone->year()->toInt();
          $titleId = 'milestone-' . $yearValue . '-' . $index;
          $forceImageLeftTextRight = ($yearInt === 1976);
          ?>

          <div class="flex items-center gap-4 mt-10 mb-6 py-20" aria-hidden="true">
            <div class="h-px bg-gray-300 flex-1"></div>
            <div class="text-primary text-2xl md:text-3xl font-light tracking-widest"><?= $milestone->year() ?></div>
            <div class="h-px bg-gray-300 flex-1"></div>
          </div>

          <?php if ($variant === 0): ?>
            <article class="grid grid-cols-1 md:grid-cols-5 gap-8 mb-14" aria-labelledby="<?= $titleId ?>">
              <?php if ($forceImageLeftTextRight): ?>
                <div class="md:col-span-3">
                  <?php if ($images->isNotEmpty()): ?>
                    <?php $collage = $images->limit(4);
                    $count = $collage->count(); ?>
                    <?php if ($count === 1): ?>
                      <div class="h-56 md:h-72 lg:h-96">
                        <img src="<?= $collage->first()->url() ?>" alt="<?= $milestone->title() ?> – Bild"
                          class="w-full h-full object-cover">
                      </div>
                    <?php elseif ($count === 2): ?>
                      <div class="grid grid-cols-2 gap-4">
                        <?php foreach ($collage as $img): ?>
                          <figure class="min-h-[14rem] md:min-h-[18rem] lg:min-h-[22rem]">
                            <img src="<?= $img->url() ?>" alt="<?= $milestone->title() ?> – Bild" class="w-full h-full object-cover">
                          </figure>
                        <?php endforeach ?>
                      </div>
                    <?php else: ?>
                      <div class="grid grid-cols-2 md:grid-cols-6 md:grid-rows-2 gap-4">
                        <?php foreach ($collage as $i => $img): ?>
                          <?php
                          $span = '';
                          if ($i === 0) {
                            $span = 'md:col-span-3 md:row-span-2 min-h-[20rem] md:min-h-[22rem] lg:min-h-[26rem]';
                          } elseif ($i === 1) {
                            $span = 'md:col-span-3 min-h-[10rem] md:min-h-[12rem] lg:min-h-[14rem]';
                          } elseif ($i === 2) {
                            $span = 'md:col-span-2 min-h-[10rem] md:min-h-[12rem] lg:min-h-[14rem]';
                          } else {
                            $span = 'md:col-span-1 min-h-[10rem] md:min-h-[12rem] lg:min-h-[14rem]';
                          }
                          ?>
                          <figure class="h-44 md:h-auto <?= $span ?>">
                            <img src="<?= $img->url() ?>" alt="<?= $milestone->title() ?> – Bild" class="w-full h-full object-cover">
                          </figure>
                        <?php endforeach ?>
                      </div>
                    <?php endif ?>
                  <?php elseif ($firstImage): ?>
                    <div class="h-56 md:h-72 lg:h-96">
                      <img src="<?= $firstImage->url() ?>" alt="<?= $milestone->title() ?> – Bild"
                        class="w-full h-full object-cover">
                    </div>
                  <?php endif ?>
                </div>
                <!-- Text rechts -->
                <div class="md:col-span-2">
                  <h2 id="<?= $titleId ?>" class="text-3xl md:text-4xl font-light text-primary mb-4">
                    <?= $milestone->title() ?>
                  </h2>
                  <div class="prose prose-lg max-w-none prose-p:text-gray-800">
                    <?= $milestone->description()->kirbytext() ?>
                  </div>
                </div>
              <?php else: ?>
                <!-- Standard: Text links, Bild rechts -->
                <div class="md:col-span-2">
                  <h2 id="<?= $titleId ?>" class="text-3xl md:text-4xl font-light text-primary mb-4">
                    <?= $milestone->title() ?>
                  </h2>
                  <div class="prose prose-lg max-w-none prose-p:text-gray-800">
                    <?= $milestone->description()->kirbytext() ?>
                  </div>
                </div>
                <div class="md:col-span-3">
                  <?php if ($images->isNotEmpty()): ?>
                    <?php $collage = $images->limit(4);
                    $count = $collage->count(); ?>
                    <?php if ($count === 1): ?>
                      <div class="h-56 md:h-72 lg:h-96">
                        <img src="<?= $collage->first()->url() ?>" alt="<?= $milestone->title() ?> – Bild"
                          class="w-full h-full object-cover">
                      </div>
                    <?php elseif ($count === 2): ?>
                      <div class="grid grid-cols-2 gap-4">
                        <?php foreach ($collage as $img): ?>
                          <figure class="min-h-[14rem] md:min-h-[18rem] lg:min-h-[22rem]">
                            <img src="<?= $img->url() ?>" alt="<?= $milestone->title() ?> – Bild" class="w-full h-full object-cover">
                          </figure>
                        <?php endforeach ?>
                      </div>
                    <?php else: ?>
                      <div class="grid grid-cols-2 md:grid-cols-6 md:grid-rows-2 gap-4">
                        <?php foreach ($collage as $i => $img): ?>
                          <?php
                          $span = '';
                          if ($i === 0) {
                            $span = 'md:col-span-3 md:row-span-2 min-h-[20rem] md:min-h-[22rem] lg:min-h-[26rem]';
                          } elseif ($i === 1) {
                            $span = 'md:col-span-3 min-h-[10rem] md:min-h-[12rem] lg:min-h-[14rem]';
                          } elseif ($i === 2) {
                            $span = 'md:col-span-2 min-h-[10rem] md:min-h-[12rem] lg:min-h-[14rem]';
                          } else {
                            $span = 'md:col-span-1 min-h-[10rem] md:min-h-[12rem] lg:min-h-[14rem]';
                          }
                          ?>
                          <figure class="h-44 md:h-auto <?= $span ?>">
                            <img src="<?= $img->url() ?>" alt="<?= $milestone->title() ?> – Bild" class="w-full h-full object-cover">
                          </figure>
                        <?php endforeach ?>
                      </div>
                    <?php endif ?>
                  <?php elseif ($firstImage): ?>
                    <div class="h-56 md:h-72 lg:h-96">
                      <img src="<?= $firstImage->url() ?>" alt="<?= $milestone->title() ?> – Bild"
                        class="w-full h-full object-cover">
                    </div>
                  <?php endif ?>
                </div>
              <?php endif ?>
            </article>
          <?php elseif ($variant === 1): ?>
            <!-- Variante B: Großes Bild oben, Text unten mittig -->
            <article class="mb-14" aria-labelledby="<?= $titleId ?>">
              <?php if ($firstImage): ?>
                <div class="mb-6 h-64 md:h-80 lg:h-96">
                  <img src="<?= $firstImage->url() ?>" alt="<?= $milestone->title() ?> – Bild"
                    class="w-full h-full object-cover">
                </div>
              <?php endif ?>
              <div class="max-w-3xl">
                <h2 id="<?= $titleId ?>" class="text-3xl md:text-4xl font-light text-primary mb-4">
                  <?= $milestone->title() ?>
                </h2>
                <div class="prose prose-lg max-w-none prose-p:text-gray-800 leading-relaxed">
                  <?= $milestone->description()->kirbytext() ?>
                </div>
              </div>
            </article>
          <?php else: ?>
            <!-- Variante C: Nur Text, flankiert von schmalen Linien -->
            <article class="mb-14" aria-labelledby="<?= $titleId ?>">
              <div class="md:flex md:items-start md:gap-8">
                <div class="hidden md:block md:w-16">
                  <div class="h-full w-px bg-gray-300"></div>
                </div>
                <div class="flex-1">
                  <h2 id="<?= $titleId ?>" class="text-3xl md:text-4xl font-light text-primary mb-4 tracking-tight">
                    <?= $milestone->title() ?>
                  </h2>
                  <div class="prose prose-lg max-w-none prose-p:text-gray-800 leading-relaxed">
                    <?= $milestone->description()->kirbytext() ?>
                  </div>
                </div>
                <div class="hidden md:block md:w-16">
                  <div class="h-full w-px bg-gray-300"></div>
                </div>
              </div>
            </article>
          <?php endif ?>
        <?php endforeach ?>
      <?php endif ?>
    </section>


  </div>
</main>

<?php snippet('footer') ?>