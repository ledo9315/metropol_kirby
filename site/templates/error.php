<?php snippet('header') ?>

<main class="py-12 mb-20">
    <div class="container mx-auto px-4 md:px-12">
        <div class="max-w-4xl mx-auto text-center">

            <!-- Back to Home Link -->
            <div class="mb-12 text-left">
                <?php snippet('components/back-to-home') ?>
            </div>

            <!-- Error Icon/Number -->
            <div class="mb-8">
                <h1 class="text-8xl md:text-9xl lg:text-[12rem] font-[300] text-primary opacity-60 leading-none">
                    404
                </h1>
            </div>

            <!-- Main Error Message -->
            <div class="mb-12">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-[300] text-primary mb-6">
                    Seite nicht gefunden
                </h2>
                <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Die gesuchte Seite konnte leider nicht gefunden werden.
                    Möglicherweise wurde sie verschoben oder der Link ist veraltet.
                </p>
            </div>

            <!-- Helpful Links -->
            <div class="bg-gray-50 rounded-lg p-8">
                <h3 class="text-xl font-[300] text-primary mb-4">
                    Vielleicht suchen Sie nach:
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="<?= url('programm') ?>" class="block p-4 bg-white rounded transition-shadow duration-300">
                        <span class="text-primary font-medium">Aktuelles Programm</span>
                        <span class="block text-sm text-gray-600 mt-1">Alle aktuellen Filme</span>
                    </a>
                    <a href="<?= url('geschichte') ?>"
                        class="block p-4 bg-white rounded transition-shadow duration-300">
                        <span class="text-primary font-medium">Geschichte</span>
                        <span class="block text-sm text-gray-600 mt-1">Unsere Historie</span>
                    </a>
                    <a href="<?= url('preise') ?>" class="block p-4 bg-white rounded  transition-shadow duration-300">
                        <span class="text-primary font-medium">Preise</span>
                        <span class="block text-sm text-gray-600 mt-1">Aktuelle Ticketpreise</span>
                    </a>
                    <a href="<?= url('ausstattung') ?>"
                        class="block p-4 bg-white rounded transition-shadow duration-300">
                        <span class="text-primary font-medium">Ausstattung</span>
                        <span class="block text-sm text-gray-600 mt-1">Unser Kino</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</main>

<?php snippet('footer') ?>