<?php
snippet('header');
?>

<main class="main-content">
  <div class="container">
    <h1><?= $page->title() ?></h1>
    <?= $page->text()->kirbytext() ?>
  </div>
</main>

<?php snippet('footer') ?>