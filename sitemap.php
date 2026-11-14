<?php
require __DIR__ . '/includes/config.php';
header('Content-Type: application/xml; charset=utf-8');
$urls = ['', 'sluzby.php', 'realizacie.php', 'o-nas.php', 'kontakt.php', 'kalkulacka.php'];
foreach ($services as $slug => $_) $urls[] = $slug . '.php';
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($urls as $u): ?>
  <url><loc><?= SITE_URL . '/' . $u ?></loc></url>
<?php endforeach; ?>
</urlset>
