<?php snippet('header') ?>

<main class="py-12 mb-20">
  <div class="container mx-auto px-12">
    <?php snippet('components/back-to-home') ?>

    <div class="container mx-auto px-4 max-w-7xl">
      <div class="flex flex-col lg:flex-row gap-12 mb-12">
        <div class="lg:w-1/2 w-full flex-shrink-0">
          <?php if ($image = $page->image()): ?>
            <img src="<?= $image->url() ?>" alt="Kinosaal" class="mb-2 w-full h-auto aspect-[3/2]">
          <?php endif ?>
        </div>
        <div class="lg:w-3/5 w-full">
          <h1 class="text-5xl font-[300] text-primary mb-8 mt-2 md:mt-0">Unser Kinosaal</h1>
          <div class="text-sm text-gray-700 leading-relaxed">
            <?= $page->hall_description()->kirbytext() ?>
          </div>
        </div>
      </div>

      <h2 class="text-5xl font-[300] text-primary mb-8 mt-12">Unsere Kinotechnik</h2>
      <div class="text-sm text-gray-700 leading-relaxed mb-20 max-w-[650px]">
        <?= $page->tech_description()->kirbytext() ?>
      </div>

      <div class="border-t border-primary pt-8 mt-8 max-w-5xl">
        <div class="mb-8 lg:grid lg:grid-cols-[1fr,2fr]">
          <h3 class="text-2xl font-[300] text-primary mb-3 lg:mb-1">Tontechnik allgemein</h3>
          <div class="text-sm text-gray-700 leading-relaxed">
            <?= $page->sound_general()->kirbytext() ?>
          </div>
        </div>
        <div class="border-t border-primary pt-8 mt-8 mb-8 lg:grid lg:grid-cols-[1fr,2fr]">
          <h3 class="text-2xl font-[300] text-primary mb-3 lg:mb-1">Projektionstechnik</h3>
          <div class="text-sm text-gray-700 leading-relaxed">
            <?= $page->projection_special()->kirbytext() ?>
          </div>
        </div>
        <div class="border-t border-primary pt-8 mt-8 mb-8 lg:grid lg:grid-cols-[1fr,2fr]">
          <h3 class="text-2xl font-[300] text-primary mb-3 lg:mb-1">3D</h3>
          <div class="text-sm text-gray-700 leading-relaxed">
            <?= $page->projection_3d()->kirbytext() ?>
          </div>
        </div>
        <div class="border-t border-primary pt-8 mt-8 mb-8 lg:grid lg:grid-cols-[1fr,2fr]">
          <h3 class="text-2xl font-[300] text-primary mb-3 lg:mb-1">Tontechnik spezieller</h3>
          <div class="text-sm text-gray-700 leading-relaxed">
            <?= $page->sound_special()->kirbytext() ?>
          </div>
        </div>
        <div class="border-t border-primary pt-8 mt-8 lg:grid lg:grid-cols-[1fr,2fr]">
          <h3 class="text-2xl font-[300] text-primary mb-3 lg:mb-1">Die Lautsprecheranlage</h3>
          <div class="text-sm text-gray-700 leading-relaxed">
            <?= $page->speakers()->kirbytext() ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php snippet('footer') ?>