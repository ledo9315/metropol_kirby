<?php snippet('header') ?>

<main class="py-12 mb-20">
  <div class="container mx-auto px-12">
    <?php snippet('components/back-to-home') ?>

    <div class="container mx-auto px-4 py-12 mt-10 mb-20">

      <div class="mb-16">
        <div class="flex flex-col lg:flex-row gap-10 items-center">
          <div class="w-full lg:w-2/3 flex flex-col items-center">
            <?php if ($cover = $page->cover()->toFile()): ?>
              <img src="<?= $cover->url() ?>" alt="<?= $page->title() ?>" class="w-[320px] h-auto shadow-lg mb-4"
                role="img">
            <?php else: ?>
              <div class="bg-gray-200 w-[320px] h-[480px] flex items-center justify-center shadow-lg mb-4" role="img"
                aria-label="Kein Filmplakat verfügbar">
                <span class="text-gray-500">Kein Filmplakat verfügbar</span>
              </div>
            <?php endif ?>
            <div class="text-center mt-2">
              <h1 class="text-4xl font-[300] text-primary mb-1"><?= $page->title() ?></h1>
              <div class="text-secondary text-lg font-medium mb-1" role="doc-subtitle">
                <?php
                $categories = [];
                if ($page->animation()->isTrue())
                  $categories[] = 'Animation';
                if ($page->kinderfilm()->isTrue())
                  $categories[] = 'Kinderfilm';
                echo implode(' / ', $categories);
                ?>
              </div>
              <div class="text-gray-500 text-md" role="contentinfo">
                <?php
                $details = [];
                if ($page->year())
                  $details[] = $page->year();
                if ($page->runtime())
                  $details[] = $page->runtime() . ' Min';
                if ($page->fsk())
                  $details[] = 'FSK ' . $page->fsk();
                echo implode(' / ', $details);
                ?>
              </div>
            </div>
          </div>
          <div class="w-full lg:w-2/3 flex flex-col gap-6">
            <?php if ($page->video()->toFiles()->first()): ?>
              <div class="aspect-video w-full mb-2">
                <video class="w-full rounded shadow" controls
                  poster="<?= $cover ? $cover->crop(1280, 720)->url() : '' ?>">
                  <source src="<?= $page->video()->toFiles()->first()->url() ?>" type="video/mp4">
                  Ihr Browser unterstützt das Video-Tag nicht.
                </video>
              </div>
            <?php elseif ($page->trailer()->isNotEmpty()): ?>
              <div class="aspect-video w-full mb-2">
                <iframe class="w-full h-full rounded shadow" src="<?= $page->trailer() ?>" frameborder="0"
                  allowfullscreen></iframe>
              </div>
            <?php endif ?>
            <div class="flex flex-col gap-y-4">
              <div class="prose prose-base max-w-none mb-2 text-secondary border-b border-primary pb-6">
                <?= $page->description()->kirbytext() ?>
              </div>
              <?php if ($page->regisseur()->isNotEmpty()): ?>
                <div class="border-b border-primary pb-6">
                  <h3 class="text-gray-600 font-medium">Regisseur</h3>
                  <p><?= $page->regisseur() ?></p>
                </div>
              <?php endif ?>
              <?php if ($page->produktionsland()->isNotEmpty()): ?>
                <div>
                  <h3 class="text-gray-600 font-medium">Produktionsland</h3>
                  <p><?= $page->produktionsland() ?></p>
                </div>
              <?php endif ?>
            </div>
          </div>
        </div>
      </div>

      <?php $spielzeiten = $page->spielzeiten()->toStructure(); ?>
      <?php if ($spielzeiten->count()): ?>
        <div class="mb-16">
          <h2 class="text-5xl font-[300] text-primary mb-6">Spielzeiten</h2>

          <div class="space-y-3">
            <?php foreach ($spielzeiten as $spielzeit): ?>
              <?php
              $date = $spielzeit->date()->toDate('d.m.Y');
              $today = date('d.m.Y');
              $tomorrow = date('d.m.Y', strtotime('+1 day'));

              if ($date == $today) {
                $dateDisplay = 'Heute';
              } else if ($date == $tomorrow) {
                $dateDisplay = 'Morgen';
              } else {
                $dateDisplay = $spielzeit->date()->toDate('d.m.');
              }

              $timeDisplay = $spielzeit->time()->toDate('H:i');
              ?>
              <div class="flex items-center justify-between  gap-3 border-b border-primary pb-2">
                <div class="font-[300] text-secondary text-xl"><?= $dateDisplay ?> um <?= $timeDisplay ?> Uhr</div>
                <div class="px-3 rounded-2xl py-0.5 border border-gray-500 text-secondary text-sm font-medium mr-2">
                  <?= $spielzeit->format() ?>
                </div>
              </div>
            <?php endforeach ?>
          </div>
        </div>
      <?php endif ?>
    </div>
  </div>
</main>

<?php snippet('footer') ?>