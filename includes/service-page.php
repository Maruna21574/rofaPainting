<?php
// Šablóna podstránky služby. Pred includom nastavte $page = slug služby.
require_once __DIR__ . '/config.php';
$s = $services[$page];
$title = $s['title'] . ' | Rofa Painting';
$desc  = $s['meta'];
require __DIR__ . '/header.php';
?>
<section class="page-hero">
  <div class="wrap">
    <nav class="crumbs" aria-label="Omrvinková navigácia"><a href="index.php">Domov</a> / <a href="sluzby.php">Služby</a> / <span><?= e($s['title']) ?></span></nav>
    <h1><?= e($s['title']) ?></h1>
    <p class="lead"><?= e($s['lead']) ?></p>
  </div>
</section>

<section class="section">
  <div class="wrap split top">
    <div class="reveal">
      <h2>Čo <em>zahŕňa</em> táto služba</h2>
      <ul class="checks">
        <?php foreach ($s['items'] as $it): ?><li><?= icon('check') ?><?= e($it) ?></li><?php endforeach; ?>
      </ul>
      <div class="actions">
        <a class="btn" href="tel:<?= SITE_PHONE_E164 ?>"><?= icon('phone') ?> <?= SITE_PHONE ?></a>
        <a class="btn btn-ghost" href="kontakt.php?sluzba=<?= urlencode($s['title']) ?>">Nezáväzná ponuka</a>
      </div>
    </div>
    <div class="split-img reveal"><img src="assets/img/<?= $s['img'] ?>" alt="<?= e($s['title']) ?>"></div>
  </div>
</section>

<section class="section dark2">
  <div class="wrap">
    <div class="sec-head reveal"><span class="eyebrow">Postup</span><h2>Ako to <em>prebieha</em></h2></div>
    <ol class="timeline">
      <?php foreach ($s['steps'] as $n => $st): ?>
        <li class="reveal"><span class="num"><?= $n + 1 ?></span><p><?= e($st) ?></p></li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>

<?php if (!empty($faq[$page])): ?>
<section class="section">
  <div class="wrap faq-wrap">
    <div class="sec-head reveal"><span class="eyebrow">Otázky a odpovede</span><h2>Najčastejšie <em>otázky</em></h2></div>
    <div class="faq">
      <?php foreach ($faq[$page] as [$q, $a]): ?>
        <details class="reveal"><summary><?= e($q) ?><?= icon('chevron') ?></summary><p><?= e($a) ?></p></details>
      <?php endforeach; ?>
    </div>
    <p class="center mt"><a class="btn btn-ghost" href="kalkulacka.php"><?= icon('calc') ?> Vypočítať orientačnú cenu</a></p>
  </div>
</section>
<?php endif; ?>

<section class="section dark2">
  <div class="wrap">
    <div class="sec-head reveal"><span class="eyebrow">Ďalšie služby</span><h2>Mohlo by vás <em>zaujímať</em></h2></div>
    <div class="cards cards-sm">
      <?php foreach ($services as $slug => $o): if ($slug === $page) continue; ?>
        <a class="card reveal" href="<?= $slug ?>.php">
          <div class="card-body">
            <span class="card-ico"><?= icon($o['icon']) ?></span>
            <h3><?= e($o['title']) ?></h3>
            <p><?= e($o['short']) ?></p>
            <span class="more">Zistiť viac <?= icon('arrow') ?></span>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php require __DIR__ . '/footer.php'; ?>
