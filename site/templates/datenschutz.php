<?php snippet('header') ?>

<main class="py-12 mb-20">
  <div class="container mx-auto px-12">
    <?php snippet('components/back-to-home') ?>

    <h1 class="text-5xl font-[300] text-primary mb-12">
      <?= $page->headline()->html() ?>
    </h1>

    <section class="mb-10" aria-labelledby="section1-title">
      <h2 id="section1-title" class="text-2xl font-[300] text-primary mb-2"><?= $page->content1_headline()->html() ?>
      </h2>
      <div class="text-base text-gray-800 mb-2">
        <?= $page->content1_text()->kt() ?>
      </div>
    </section>

    <section class="mb-10" aria-labelledby="section2-title">
      <h2 id="section2-title" class="text-2xl font-[300] text-primary mb-2"><?= $page->content2_headline()->html() ?>
      </h2>
      <div class="text-base text-gray-800 mb-2">
        <?= $page->content2_text()->kt() ?>
      </div>
    </section>

    <section class="mb-10" aria-labelledby="section3-title">
      <h2 id="section3-title" class="text-2xl font-[300] text-primary mb-2"><?= $page->content3_headline()->html() ?>
      </h2>
      <div class="text-base text-gray-800 mb-2">
        <?= $page->content3_text()->kt() ?>
      </div>
    </section>
  </div>
</main>
<?php snippet('footer') ?>