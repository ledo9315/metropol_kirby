<?php snippet('header') ?>

<main class="py-12 mb-20">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <?php snippet('components/back-to-home') ?>

    <!-- Hero Section -->
    <section class="text-center mb-20">
      <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-[300] text-primary mb-6">
        Geschichte des Metropol
      </h1>
      <p class="text-xl sm:text-2xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
        Seit 1909 ein Ort der Unterhaltung und des kulturellen Lebens in Brunsbüttel
      </p>
    </section>

    <?php if ($milestones = $page->milestones()->toStructure()): ?>
      <?php foreach ($milestones->sortBy('year', 'asc') as $index => $milestone):
        $milestoneId = 'milestone-' . uniqid();
        $layoutType = $index % 4; // 4 verschiedene Layout-Typen
        ?>

        <?php if ($layoutType === 0): ?>
          <!-- Layout 1: Großes Bild mit Text-Overlay -->
          <section class="mb-32" aria-labelledby="<?= $milestoneId ?>">
            <?php if ($milestone->image()->isNotEmpty() && ($image = $milestone->image()->toFile())): ?>
              <div class="relative overflow-hidden rounded bg-gray-100 mb-8">
                <img src="<?= $image->url() ?>" alt="<?= $milestone->title() ?> - <?= $milestone->year() ?>"
                  class="w-full h-64 sm:h-80 md:h-96 object-cover" loading="lazy">
                <div class="absolute inset-0 bg-black bg-opacity-40"></div>
                <div class="absolute bottom-0 left-0 right-0 p-6 sm:p-8 md:p-12 text-white">
                  <div class="bg-primary text-white py-2 px-4 rounded-full text-sm font-medium inline-block mb-4">
                    <?= $milestone->year() ?>
                  </div>
                  <h2 id="<?= $milestoneId ?>" class="text-2xl sm:text-3xl md:text-4xl font-[300] mb-4">
                    <?= $milestone->title() ?>
                  </h2>
                </div>
              </div>
            <?php endif ?>
            <div class="max-w-4xl mx-auto">
              <div class="prose prose-lg sm:prose-xl max-w-none text-gray-700 leading-relaxed">
                <?= $milestone->description()->kirbytext() ?>
              </div>
            </div>
          </section>

        <?php elseif ($layoutType === 1): ?>
          <!-- Layout 2: Zweispaltiges Layout mit Text links -->
          <section class="mb-32" aria-labelledby="<?= $milestoneId ?>">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 items-center">
              <div class="order-2 lg:order-1">
                <div class="bg-primary text-white py-2 px-4 rounded-full text-sm font-medium inline-block mb-6">
                  <?= $milestone->year() ?>
                </div>
                <h2 id="<?= $milestoneId ?>" class="text-3xl sm:text-4xl md:text-5xl font-[300] text-primary mb-6">
                  <?= $milestone->title() ?>
                </h2>
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                  <?= $milestone->description()->kirbytext() ?>
                </div>
              </div>
              <?php if ($milestone->image()->isNotEmpty() && ($image = $milestone->image()->toFile())): ?>
                <div class="order-1 lg:order-2">
                  <div class="overflow-hidden rounded border border-gray-200">
                    <img src="<?= $image->url() ?>" alt="<?= $milestone->title() ?> - <?= $milestone->year() ?>"
                      class="w-full h-auto object-cover" loading="lazy">
                  </div>
                </div>
              <?php endif ?>
            </div>
          </section>

        <?php elseif ($layoutType === 2): ?>
          <!-- Layout 3: Zentrierte Karte mit Bild oben -->
          <section class="mb-32" aria-labelledby="<?= $milestoneId ?>">
            <div class="max-w-3xl mx-auto text-center">
              <div class="bg-primary text-white py-2 px-4 rounded-full text-sm font-medium inline-block mb-6">
                <?= $milestone->year() ?>
              </div>
              <h2 id="<?= $milestoneId ?>" class="text-3xl sm:text-4xl md:text-5xl font-[300] text-primary mb-8">
                <?= $milestone->title() ?>
              </h2>
              <?php if ($milestone->image()->isNotEmpty() && ($image = $milestone->image()->toFile())): ?>
                <div class="overflow-hidden rounded border border-gray-200 mb-8">
                  <img src="<?= $image->url() ?>" alt="<?= $milestone->title() ?> - <?= $milestone->year() ?>"
                    class="w-full h-64 sm:h-80 object-cover" loading="lazy">
                </div>
              <?php endif ?>
              <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed text-left">
                <?= $milestone->description()->kirbytext() ?>
              </div>
            </div>
          </section>

        <?php else: ?>
          <!-- Layout 4: Zweispaltiges Layout mit Text rechts -->
          <section class="mb-32" aria-labelledby="<?= $milestoneId ?>">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 items-center">
              <?php if ($milestone->image()->isNotEmpty() && ($image = $milestone->image()->toFile())): ?>
                <div>
                  <div class="overflow-hidden rounded border border-gray-200">
                    <img src="<?= $image->url() ?>" alt="<?= $milestone->title() ?> - <?= $milestone->year() ?>"
                      class="w-full h-auto object-cover" loading="lazy">
                  </div>
                </div>
              <?php endif ?>
              <div>
                <div class="bg-primary text-white py-2 px-4 rounded-full text-sm font-medium inline-block mb-6">
                  <?= $milestone->year() ?>
                </div>
                <h2 id="<?= $milestoneId ?>" class="text-3xl sm:text-4xl md:text-5xl font-[300] text-primary mb-6">
                  <?= $milestone->title() ?>
                </h2>
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                  <?= $milestone->description()->kirbytext() ?>
                </div>
              </div>
            </div>
          </section>
        <?php endif ?>

      <?php endforeach ?>

      <!-- Abschluss-Sektion -->
      <section class="text-center mt-32 py-16 bg-gradient-to-b from-gray-50 to-white rounded-lg">
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-[300] text-primary mb-6">
          Werden Sie Teil unserer Geschichte
        </h2>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto mb-8">
          Das Metropol ist mehr als nur ein Kino – es ist ein lebendiger Teil der Brunsbütteler Stadtgeschichte.
          Erleben Sie mit uns die Magie des Kinos und schreiben Sie Ihre eigene Geschichte.
        </p>
        <a href="<?= $site->url() ?>/#programm"
          class="inline-flex items-center text-primary hover:opacity-80 transition-opacity text-lg">
          Aktuelles Programm entdecken &rarr;
        </a>
      </section>

    <?php endif ?>
  </div>
</main>

<?php snippet('footer') ?>