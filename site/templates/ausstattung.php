<?php snippet('header') ?>

<main class="py-12 mb-20">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <?php snippet('components/back-to-home') ?>

    <?php
    // Hero-Inhalte aus Panel
    $heroTitle = $page->hero_title()->or('Unser Kinosaal');
    $intro = $page->hero_intro()->or('Moderne Technik trifft auf gemütliche Atmosphäre. Entdecken Sie die technische Ausstattung unseres Kinos, die für ein optimales Filmerlebnis sorgt.');

    // Hero-Bild aus Panel oder Fallback
    $heroImage = $page->hero_image()->toFile();
    if (!$heroImage) {
      $heroImage = $page->image() ?? $page->images()->sortBy('sort', 'asc')->first();
    }
    $hero = $heroImage;
    ?>

    <?php if ($hero): ?>
      <section class="relative mb-16" aria-label="Ausstattung Titelbild">
        <div class="relative h-[42vh] md:h-[56vh] w-full"
          style="background-image:url('<?= $hero->url() ?>'); background-size:cover; background-position:center;">
          <div class="absolute inset-0 bg-black/50"></div>
          <div class="absolute inset-0 flex items-end">
            <div class="w-full">
              <div class="max-w-4xl text-white px-6 py-10">
                <h1 class="text-4xl md:text-6xl font-light tracking-tight"><?= $heroTitle->escape() ?></h1>
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
        <h1 class="text-5xl font-light text-primary mb-4"><?= $heroTitle->escape() ?></h1>
        <?php if ($intro->isNotEmpty()): ?>
          <p class="text-xl text-gray-700 max-w-3xl mx-auto"><?= $intro->escape() ?></p>
        <?php endif ?>
      </div>
    <?php endif ?>

    <section class="mb-60" aria-label="Kinosaal und Technik Übersicht">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <div class="pt-6 border-t border-primary">
          <div class="text-xs tracking-[0.2em] uppercase text-black/70">
            <?= $page->hall_title()->or('Unser Kinosaal')->escape() ?>
          </div>
          <div class="mt-2 text-2xl md:text-3xl font-light"><?= $page->hall_subtitle()->or('118 Plätze')->escape() ?>
          </div>
          <div class="text-gray-800 mt-4 leading-relaxed space-y-4">
            <?php if ($page->hall_description()->isNotEmpty()): ?>
              <?= $page->hall_description()->kirbytext() ?>
            <?php else: ?>
              <p>110 Sitzplätze und 8 Plätze direkt an der Bar stehen Ihnen für Ihren Besuch in unserem Hause zur
                Verfügung. Die Leinwandhöhe beträgt 20 m² und sorgt für ein optimales Seherlebnis. Die moderne 7.4 Digital
                Tonanlage liefert Ihnen den Raum zum guten Ton.</p>
              <p>Unsere Sitzplätze sind mit einem Tisch ausgestattet, der eine Kinogleichlage vereinfacht. Sie brauchen
                sich auch während der Vorstellung nicht auf Getränke zu verzichten. Unser Servicepersonal erfüllt Ihre
                Getränkewünsche umgehend.</p>
              <p>Genießen Sie in der perfekten Abstimmung die Mischung aus traditionell familiär geführtem Kino und
                modernster Technik. Sehen Sie sich das laufende Programm hier an und freuen Sie sich auf Ihren Besuch in
                unserem Haus.</p>
            <?php endif ?>
          </div>
        </div>

        <div class="pt-6 border-t border-primary">
          <div class="text-xs tracking-[0.2em] uppercase text-black/70">
            <?= $page->tech_title()->or('Unsere Kinotechnik')->escape() ?>
          </div>
          <div class="mt-2 text-2xl md:text-3xl font-light">
            <?= $page->tech_subtitle()->or('Christie CP4420 4K')->escape() ?>
          </div>
          <div class="text-gray-800 mt-4 leading-relaxed space-y-4">
            <?php if ($page->tech_description()->isNotEmpty()): ?>
              <?= $page->tech_description()->kirbytext() ?>
            <?php else: ?>
              <p>Unsere Installation geht über den DCI-Standard hinaus. Als Bildwand kommt eine verbesserte Version von
                Screen Research mit einem Reflexionsgrad von 0.8 zum Einsatz.</p>
              <p>Der Film wird über einen Dolby IMS3000 Server abgespielt und von einem Christie CP4420 RealRGB Laser
                Projektor in 4K-Auflösung auf die Bildwand projiziert.</p>
              <p>Unser CP4420 ist jetzt ein CP4420. Der Projektor wurde von einem autorisierten Christie-Techniker vor Ort
                mit der Software und Kalibrierung des gesamten optischen Systems installiert. Das Ergebnis ist die wohl
                zur Zeit beste Bildqualität eines Christie Laser RGB Projektors in einem kommerziellen Kino, so der
                Techniker.</p>
            <?php endif ?>
          </div>
        </div>
      </div>
    </section>

    <div class="max-w-7xl">
      <section aria-labelledby="kinotechnik-heading">
        <h2 id="kinotechnik-heading" class="text-5xl font-[300] text-primary mb-8 mt-12">Technische Details</h2>
        <div class="text-sm text-gray-700 leading-relaxed mb-20 max-w-[650px]">
          <p>Hier finden Sie detaillierte Informationen zu unserer spezialisierten Kinotechnik und den einzelnen
            Komponenten unserer Anlage.</p>
        </div>

        <div class="border-t border-primary pt-8 mt-8 max-w-5xl">
          <div class="mb-8 lg:grid lg:grid-cols-[1fr,2fr]" aria-labelledby="tontechnik-allgemein">
            <h3 id="tontechnik-allgemein" class="text-2xl font-[300] text-primary mb-3 lg:mb-1">Tontechnik allgemein
            </h3>
            <div class="text-sm text-gray-700 leading-relaxed">
              <?= $page->sound_general()->kirbytext() ?>
            </div>
          </div>
          <div class="border-t border-primary pt-8 mt-8 mb-8 lg:grid lg:grid-cols-[1fr,2fr]"
            aria-labelledby="projektionstechnik">
            <h3 id="projektionstechnik" class="text-2xl font-[300] text-primary mb-3 lg:mb-1">Projektionstechnik</h3>
            <div class="text-sm text-gray-700 leading-relaxed">
              <?= $page->projection_special()->kirbytext() ?>
            </div>
          </div>
          <div class="border-t border-primary pt-8 mt-8 mb-8 lg:grid lg:grid-cols-[1fr,2fr]"
            aria-labelledby="3d-technik">
            <h3 id="3d-technik" class="text-2xl font-[300] text-primary mb-3 lg:mb-1">3D</h3>
            <div class="text-sm text-gray-700 leading-relaxed">
              <?= $page->projection_3d()->kirbytext() ?>
            </div>
          </div>
          <div class="border-t border-primary pt-8 mt-8 mb-8 lg:grid lg:grid-cols-[1fr,2fr]"
            aria-labelledby="tontechnik-speziell">
            <h3 id="tontechnik-speziell" class="text-2xl font-[300] text-primary mb-3 lg:mb-1">Tontechnik spezieller
            </h3>
            <div class="text-sm text-gray-700 leading-relaxed">
              <?= $page->sound_special()->kirbytext() ?>
            </div>
          </div>
          <div class="border-t border-primary pt-8 mt-8 lg:grid lg:grid-cols-[1fr,2fr]"
            aria-labelledby="lautsprecheranlage">
            <h3 id="lautsprecheranlage" class="text-2xl font-[300] text-primary mb-3 lg:mb-1">Die Lautsprecheranlage
            </h3>
            <div class="text-sm text-gray-700 leading-relaxed">
              <?= $page->speakers()->kirbytext() ?>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</main>

<?php snippet('footer') ?>