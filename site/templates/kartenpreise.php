<?php snippet('header') ?>

<main class="py-12 mb-20">
  <div class="container mx-auto px-4">
    <div class="max-w-5xl mx-auto">
      <?php snippet('components/back-to-home') ?>

      <h1 class="text-6xl font-[300] text-primary mb-4 mt-8"><?= $page->title() ?></h1>
      <?php if ($page->intro()->isNotEmpty()): ?>
        <p class="text-lg text-gray-700 mb-8">
          <?= $page->intro() ?>
        </p>
      <?php endif ?>

      <hr class="border-primary mb-12">

      <div class="mb-12">
        <?php if ($prices = $page->prices()->toStructure()): ?>
          <table class="w-full border-collapse mb-4">
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

      <?php if ($page->rental_title()->isNotEmpty()): ?>
        <h2 class="text-5xl font-[300] text-primary mb-8 mt-24">
          <?= $page->rental_title() ?>
        </h2>
      <?php endif ?>

      <?php if ($page->rental_text()->isNotEmpty()): ?>
        <div class="text-lg text-secondary mb-8">
          <?= $page->rental_text()->kirbytext() ?>
        </div>
      <?php endif ?>
    </div>
  </div>
</main>

<?php snippet('footer') ?>