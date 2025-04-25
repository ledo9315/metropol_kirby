<?= '<?xml version="1.0" encoding="utf-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?= $site->url() ?></loc>
        <lastmod><?= $lastmod ?></lastmod>
        <priority>1.0</priority>
    </url>
    <?php foreach ($items as $item): ?>
        <url>
            <loc><?= $item->url() ?></loc>
            <lastmod><?= $item->modified('c', 'date') ?></lastmod>
            <priority><?= ($item->isHomePage()) ? 1.0 : 0.8 ?></priority>
        </url>
    <?php endforeach ?>
</urlset>