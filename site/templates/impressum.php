<?php
/*
  Template: Impressum
  Description: Template für die Impressum-Seite
*/
?>

<?php snippet('header') ?>

<main class="py-12 mb-20">
  <div class="container mx-auto px-12">
    <?php snippet('components/back-to-home') ?>

    <div class="container mx-auto px-4 mb-20">
      <a href="<?= url('/') ?>" class="flex items-center text-primary hover:underline mb-8">&larr; STARTSEITE</a>
      <h1 class="text-5xl font-[300] text-primary mb-12">
        <?= $page->headline()->html() ?>
      </h1>

      <section class="mb-10">
        <h2 class="text-2xl font-[300] text-primary mb-2"><?= $page->tmg_headline()->html() ?></h2>
        <p class="font-medium text-lg mb-1"><?= $page->theater_name()->html() ?></p>
        <div class="text-base text-gray-800 mb-2">
          <?= $page->address()->kt() ?>
        </div>
      </section>

      <section class="mb-10">
        <h2 class="text-2xl font-[300] text-primary mb-2"><?= $page->represented_headline()->html() ?></h2>
        <p class="mb-1"><?= $page->represented_by()->html() ?></p>
        <div class="text-base text-gray-800 mb-2">
          <?= $page->contact_info()->kt() ?>
        </div>
      </section>

      <section class="mb-10">
        <h2 class="text-2xl font-[300] text-primary mb-2"><?= $page->tax_headline()->html() ?></h2>
        <div class="text-base text-gray-800 mb-2">
          <?= $page->tax_id()->kt() ?>
        </div>
      </section>

      <section class="mb-10">
        <h2 class="text-2xl font-[300] text-primary mb-2"><?= $page->responsible_headline()->html() ?></h2>
        <p class="font-medium text-lg mb-1"><?= $page->responsible_person()->html() ?></p>
        <div class="text-base text-gray-800 mb-2">
          <?= $page->responsible_address()->kt() ?>
        </div>
      </section>

      <section class="mb-10">
        <h2 class="text-2xl font-[300] text-primary mb-2"><?= $page->dispute_resolution_headline()->html() ?></h2>
        <div class="text-base text-gray-800 mb-2">
          <?= $page->dispute_resolution_text()->kt() ?>
        </div>
      </section>

      <section class="mb-2">
        <h2 class="text-2xl font-[300] text-primary mb-2"><?= $page->image_source_headline()->html() ?></h2>
        <p class="text-base text-gray-800 mb-2"><?= $page->copyright()->html() ?></p>
      </section>
    </div>
  </div>
</main>

<?php snippet('footer') ?>