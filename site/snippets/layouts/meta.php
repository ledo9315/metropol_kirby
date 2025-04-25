<?php
/**
 * Meta-Tags Snippet für Metropol-Theater
 * Enthält alle Meta-Tags, Title und SEO-Einstellungen
 */
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<?php
$title = $page->title()->html();
$siteTitle = $site->title()->html();

if ($page->isHomePage()) {
    $metaTitle = $siteTitle . ' - Das Kino in Brunsbüttel';
} else {
    $metaTitle = $title . ' | ' . $siteTitle;
}
?>

<title><?= $metaTitle ?></title>

<?php
if ($page->metaDescription()->isNotEmpty()) {
    $metaDescription = $page->metaDescription()->html();
} else if ($page->description()->isNotEmpty()) {
    $metaDescription = $page->description()->excerpt(160)->html();
} else {
    $metaDescription = $site->description()->html();
}
?>

<meta name="description" content="<?= $metaDescription ?>">
<meta name="keywords" content="Kino, Filme, Brunsbüttel, <?= $title ?>">
<meta name="author" content="<?= $site->title()->html() ?>">

<link rel="canonical" href="<?= $page->url() ?>">

<meta property="og:title" content="<?= $metaTitle ?>">
<meta property="og:description" content="<?= $metaDescription ?>">
<meta property="og:url" content="<?= $page->url() ?>">
<meta property="og:type" content="website">
<?php if ($ogImage = $page->ogImage()->toFile() ?? $site->ogImage()->toFile()): ?>
    <meta property="og:image" content="<?= $ogImage->url() ?>">
    <meta property="og:image:width" content="<?= $ogImage->width() ?>">
    <meta property="og:image:height" content="<?= $ogImage->height() ?>">
<?php endif; ?>
<meta property="og:site_name" content="<?= $site->title()->html() ?>">

<link rel="icon" href="/favicon.ico">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
<link rel="manifest" href="/site.webmanifest">
<meta name="theme-color" content="#891819">