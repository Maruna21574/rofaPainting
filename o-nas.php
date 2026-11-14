<?php
$page = 'o-nas';
$title = 'O nás | Rofa Painting';
$desc = 'Rofa Painting – maliari a natierači, ktorí svoju prácu robia kvalitne, rýchlo, čisto a spoľahlivo.';
require __DIR__ . '/includes/header.php';
?>
<section class="page-hero">
  <div class="wrap">
    <nav class="crumbs"><a href="index.php">Domov</a> / <span>O nás</span></nav>
    <h1>O firme <em>Rofa Painting</em></h1>
    <p class="lead">Premeníme váš priestor na miesto, kde sa budete cítiť doma.</p>
  </div>
</section>

<section class="section">
  <div class="wrap split top">
    <div class="reveal">
      <h2>Maliarska firma, na ktorú <em>sa môžete spoľahnúť</em></h2>
      <p>Sme Rofa Painting a venujeme sa maliarskym a natieračským prácam v interiéri aj exteriéri. Staráme sa o byty, rodinné domy, novostavby a ďalšie priestory.</p>
      <p>Okrem klasických malieb ponúkame aj dekoratívne stierky, sadrokartón a omietky či airless maľovanie. Pri každej zákazke dbáme na štyri veci: aby bola práca urobená <b>kvalitne, rýchlo, čisto a spoľahlivo</b>.</p>
      <div class="actions"><a class="btn" href="kontakt.php">Kontaktujte nás</a><a class="btn btn-ghost" href="sluzby.php">Naše služby</a></div>
    </div>
    <div class="split-img reveal"><img src="assets/img/izba.jpg" alt="Izba pripravená na maľovanie" loading="lazy"></div>
  </div>
</section>

<section class="section dark2">
  <div class="wrap">
    <div class="sec-head reveal"><span class="eyebrow">Naše hodnoty</span><h2>Na čom si <em>zakladáme</em></h2></div>
    <div class="feat-grid">
      <div class="feat reveal"><?= icon('sparkle') ?><h3>Kvalitne</h3><p>Dbáme na detail a používame kvalitné materiály.</p></div>
      <div class="feat reveal"><?= icon('clock') ?><h3>Rýchlo</h3><p>Rešpektujeme váš čas a dohodnuté termíny.</p></div>
      <div class="feat reveal"><?= icon('roller') ?><h3>Čisto</h3><p>Po sebe vždy upracieme, priestor odovzdáme čistý.</p></div>
      <div class="feat reveal"><?= icon('shield') ?><h3>Spoľahlivo</h3><p>Férová komunikácia a práca, ktorá drží slovo.</p></div>
    </div>
  </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
