<?php
$page = 'realizacie';
$title = 'Realizácie | Rofa Painting';
$desc = 'Pozrite si videá a fotografie z našich realizácií maliarskych a natieračských prác.';
require __DIR__ . '/includes/header.php';
?>
<section class="page-hero">
  <div class="wrap">
    <nav class="crumbs"><a href="index.php">Domov</a> / <span>Realizácie</span></nav>
    <h1>Naše <em>realizácie</em></h1>
    <p class="lead">Videá a fotografie priamo z našich stavieb. Kliknutím na video ho prehráte.</p>
  </div>
</section>

<section class="section">
  <div class="wrap">
    <div class="vid-grid vid-grid-6">
      <?php for ($i = 1; $i <= 6; $i++): ?>
        <button class="vid reveal" data-video="assets/video/video-<?= $i ?>.mp4" aria-label="Prehrať video <?= $i ?>">
          <img src="assets/img/video-<?= $i ?>.jpg" alt="Video z realizácie <?= $i ?>" loading="lazy">
          <video muted loop playsinline preload="none" data-src="assets/video/video-<?= $i ?>.mp4"></video>
          <span class="play"><?= icon('play') ?></span>
        </button>
      <?php endfor; ?>
    </div>
  </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
