<?php snippet('header') ?>

<main class="py-12 mb-20">
  <div class="container mx-auto px-12">
    <?php snippet('components/back-to-home') ?>

    <h1 class="sr-only">Geschichte</h1>

    <div class="space-y-16" role="feed" aria-label="Chronik der Kino-Geschichte">
      <?php if ($milestones = $page->milestones()->toStructure()): ?>
        <?php foreach ($milestones->sortBy('year', 'asc') as $milestone):
          $milestoneId = 'milestone-' . uniqid();
          ?>
          <article class="pb-12 border-b border-gray-200 last:border-0" aria-labelledby="<?= $milestoneId ?>">
            <div class="flex flex-col md:flex-row -mx-4 gap-x-20 items-center justify-between">
              <div class="<?= $milestone->image()->isNotEmpty() ? 'md:w-1/2' : 'w-full' ?> px-4 mb-6 md:mb-0">
                <h2 id="<?= $milestoneId ?>" class="text-4xl font-[300] text-primary mb-4"><?= $milestone->year() ?>:
                  <?= $milestone->title() ?></h2>
                <div class="prose">
                  <?= $milestone->description()->kirbytext() ?>
                </div>
              </div>
              <?php if ($milestone->image()->isNotEmpty()): ?>
                <div class="md:w-1/3 px-4">
                  <div class="overflow-hidden shadow-lg">
                    <?php if ($image = $milestone->image()->toFile()): ?>
                      <img src="<?= $image->url() ?>" alt="<?= $milestone->title() ?> - <?= $milestone->year() ?>"
                        class="w-full h-auto" role="img">
                    <?php endif ?>
                  </div>
                </div>
              <?php endif ?>
            </div>
          </article>
        <?php endforeach ?>
      <?php endif ?>
    </div>
  </div>
</main>

<?php snippet('footer') ?>