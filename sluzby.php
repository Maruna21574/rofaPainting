<?php
$page = 'sluzby';
$title = 'Služby | Rofa Painting';
$desc = 'Interiérové a exteriérové maľby, dekoratívne stierky, sadrokartón a omietky, airless maľovanie. Prehľad služieb Rofa Painting.';
require __DIR__ . '/includes/header.php';
?>
<section class="page-hero">
  <div class="wrap">
    <nav class="crumbs"><a href="index.php">Domov</a> / <span>Služby</span></nav>
    <h1>Naše <em>služby</em></h1>
    <p class="lead">Maliarske a natieračské práce pre byty, domy, novostavby aj komerčné priestory.</p>
  </div>
</section>
<section class="section">
  <div class="wrap">
    <div class="cards">
      <?php foreach ($services as $slug => $s): ?>
        <a class="card reveal" href="<?= $slug ?>.php">
          <div class="card-img"><img src="assets/img/<?= $s['img'] ?>" alt="<?= e($s['title']) ?>" loading="lazy"></div>
          <div class="card-body">
            <span class="card-ico"><?= icon($s['icon']) ?></span>
            <h3><?= e($s['title']) ?></h3>
            <p><?= e($s['short']) ?></p>
            <span class="more">Zistiť viac <?= icon('arrow') ?></span>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
