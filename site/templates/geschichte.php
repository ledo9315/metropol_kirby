<?php snippet('header') ?>

<main class="py-12 mb-20">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <?php snippet('components/back-to-home') ?>

    <div class="text-center mb-16">
      <h1 class="text-5xl font-light text-primary mb-4">Geschichte des Metropol</h1>
      <p class="text-xl text-gray-600 max-w-3xl mx-auto">Eine Reise durch die Zeit - Entdecken Sie die bewegte
        Geschichte unseres Kinos.</p>
    </div>

    <div class="timeline relative" role="feed" aria-label="Chronik der Kino-Geschichte">
      <?php if ($milestones = $page->milestones()->toStructure()): ?>
        <!-- Vertikale Zeitleiste -->
        <div class="hidden md:block absolute left-1/2 top-0 bottom-0 w-0.5 bg-primary/20 transform -translate-x-1/2 z-0">
        </div>

        <?php foreach ($milestones->sortBy('year', 'asc') as $index => $milestone):
          $milestoneId = 'milestone-' . uniqid();
          $isEven = $index % 2 === 0;
          ?>
          <article class="relative z-10 mb-24 last:mb-0" aria-labelledby="<?= $milestoneId ?>">
            <div class="md:flex md:items-center">
              <div class="<?= $isEven ? 'md:pr-24 md:mr-auto md:ml-0' : 'md:pl-24 md:ml-auto md:mr-0' ?> md:w-[45%]">
                <?php if ($isEven): ?>
                  <!-- Inhalt für linke Seite (gerade Indices) -->
                  <div class="bg-white p-6 shadow-md">
                    <h2 id="<?= $milestoneId ?>"
                      class="text-3xl md:text-4xl font-light text-primary mb-6 border-b border-primary/20 pb-3">
                      <?= $milestone->title() ?>
                    </h2>
                    <div class="prose prose-lg max-w-none prose-headings:text-primary prose-p:text-gray-700">
                      <?= $milestone->description()->kirbytext() ?>
                    </div>
                  </div>
                <?php endif ?>

                <?php if (!$isEven && $milestone->image()->isNotEmpty() && ($image = $milestone->image()->toFile())): ?>
                  <!-- Bild für linke Seite (ungerade Indices) -->
                  <div>
                    <div class="overflow-hidden shadow-xl">
                      <img src="<?= $image->url() ?>" alt="<?= $milestone->title() ?> - <?= $milestone->year() ?>"
                        class="w-full h-auto object-cover" role="img">
                    </div>
                  </div>
                <?php endif ?>
              </div>

              <!-- Jahr-Indikator - mittig vertikal zwischen Bild und Text -->
              <div class="hidden md:flex md:items-center md:justify-center md:w-[10%] relative z-20">
                <div class="bg-primary text-white py-2 px-6 rounded-full text-xl font-medium shadow-lg inline-block">
                  <?= $milestone->year() ?>
                </div>
              </div>

              <div class="<?= $isEven ? 'md:pl-24 md:ml-auto md:mr-0' : 'md:pr-24 md:mr-auto md:ml-0' ?> md:w-[45%]">
                <?php if ($isEven && $milestone->image()->isNotEmpty() && ($image = $milestone->image()->toFile())): ?>
                  <!-- Bild für rechte Seite (gerade Indices) -->
                  <div>
                    <div class="overflow-hidden shadow-xl">
                      <img src="<?= $image->url() ?>" alt="<?= $milestone->title() ?> - <?= $milestone->year() ?>"
                        class="w-full h-auto object-cover" role="img">
                    </div>
                  </div>
                <?php endif ?>

                <?php if (!$isEven): ?>
                  <!-- Inhalt für rechte Seite (ungerade Indices) -->
                  <div class="bg-white p-6 shadow-md">
                    <h2 id="<?= $milestoneId ?>"
                      class="text-3xl md:text-4xl font-light text-primary mb-6 border-b border-primary/20 pb-3">
                      <?= $milestone->title() ?>
                    </h2>
                    <div class="prose prose-lg max-w-none prose-headings:text-primary prose-p:text-gray-700">
                      <?= $milestone->description()->kirbytext() ?>
                    </div>
                  </div>
                <?php endif ?>
              </div>

              <!-- Mobile Anzeige des Jahres -->
              <div
                class="md:hidden bg-primary text-white py-2 px-6 rounded-full text-xl font-medium shadow-lg mx-auto mt-8 mb-4 inline-block">
                <?= $milestone->year() ?>
              </div>
            </div>
          </article>
        <?php endforeach ?>
      <?php endif ?>
    </div>
  </div>
</main>

<?php snippet('footer') ?>