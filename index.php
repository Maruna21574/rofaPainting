<?php
$page = 'home';
require __DIR__ . '/includes/header.php';
?>
<section class="hero">
  <div class="wrap hero-grid">
    <div class="hero-copy reveal">
      <span class="eyebrow">Nové zákazky – práve teraz!</span>
      <h1>Profesionálne <em class="rot" data-words="maľby|fasády|stierky|omietky|airless"><span class="rot-w">maľby</span></em> a natieračské práce</h1>
      <p class="lead">Premeníme váš priestor na miesto, kde sa budete cítiť doma. <?= SLOGAN ?></p>
      <div class="actions">
        <a class="btn btn-lg" href="tel:<?= SITE_PHONE_E164 ?>"><?= icon('phone') ?> Zavolajte nám</a>
        <a class="btn btn-ghost btn-lg" href="kontakt.php">Nezáväzná obhliadka <?= icon('arrow') ?></a>
      </div>
    </div>
    <div class="hero-media reveal">
      <div class="phone-frame">
        <video autoplay muted loop playsinline preload="metadata" poster="assets/img/video-2.jpg">
          <source src="assets/video/video-2.mp4" type="video/mp4">
        </video>
      </div>
      <div class="badge-round">Kvalita,<br>ktorú je<br>vidieť</div>
    </div>
  </div>
</section>

<section class="section" id="sluzby">
  <div class="wrap">
    <div class="sec-head reveal" data-bg="SLUŽBY">
      <span class="eyebrow">Čo robíme</span>
      <h2>Naše <em>služby</em></h2>
      <p>Od interiérových malieb po fasády a moderné dekoratívne povrchy – všetko z jedných rúk.</p>
    </div>
    <div class="panels reveal" id="panels">
      <?php $n = 0; foreach ($services as $slug => $s): $n++; ?>
        <a class="panel<?= $n === 1 ? ' active' : '' ?>" href="<?= $slug ?>.php">
          <img class="p-img" src="assets/img/<?= $s['img'] ?>" alt="<?= e($s['title']) ?>" loading="lazy">
          <span class="p-num"><?= sprintf('%02d', $n) ?></span>
          <span class="p-vert" aria-hidden="true"><?= e($s['title']) ?></span>
          <span class="p-body">
            <span class="p-ico"><?= icon($s['icon']) ?></span>
            <h3><?= e($s['title']) ?></h3>
            <span class="p-more"><span class="p-in">
              <span class="p-txt"><?= e($s['short']) ?></span>
              <span class="more">Zistiť viac <?= icon('arrow') ?></span>
            </span></span>
          </span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section dark2" id="preco">
  <div class="wrap why">
    <div class="sec-head left reveal" data-bg="KVALITA">
      <span class="eyebrow">Prečo Rofa Painting</span>
      <h2>Práca, ktorú <em>je vidieť</em></h2>
      <p>Každú zákazku robíme s dôrazom na detail, čistotu a dodržanie dohodnutého termínu.</p>
    </div>
    <div class="feat-grid">
      <div class="feat reveal"><?= icon('sparkle') ?><h3>Kvalitne</h3><p>Overené materiály a precízne spracovanie každého povrchu.</p></div>
      <div class="feat reveal"><?= icon('clock') ?><h3>Rýchlo</h3><p>Moderné postupy a technológie, vďaka ktorým šetríme váš čas.</p></div>
      <div class="feat reveal"><?= icon('roller') ?><h3>Čisto</h3><p>Dôkladné zakrytie priestoru a upratanie po skončení prác.</p></div>
      <div class="feat reveal"><?= icon('shield') ?><h3>Spoľahlivo</h3><p>Dohodnuté je dohodnuté – na nás sa môžete spoľahnúť.</p></div>
    </div>
  </div>
</section>

<section class="section" id="realizacie">
  <div class="wrap">
    <div class="sec-head reveal" data-bg="REALIZÁCIE">
      <span class="eyebrow">Z našej práce</span>
      <h2>Pozrite si <em>realizácie</em></h2>
      <p>Krátke videá priamo zo stavieb a hotových priestorov.</p>
    </div>
    <div class="vid-grid">
      <?php foreach ([1, 4, 3] as $i): ?>
        <button class="vid reveal" data-video="assets/video/video-<?= $i ?>.mp4" aria-label="Prehrať video z realizácie">
          <img src="assets/img/video-<?= $i ?>.jpg" alt="Video z realizácie <?= $i ?>" loading="lazy">
          <video muted loop playsinline preload="none" data-src="assets/video/video-<?= $i ?>.mp4"></video>
          <span class="play"><?= icon('play') ?></span>
        </button>
      <?php endforeach; ?>
    </div>
    <p class="center mt"><a class="btn btn-ghost" href="realizacie.php">Všetky realizácie <?= icon('arrow') ?></a></p>
  </div>
</section>

<?php require __DIR__ . '/includes/reviews-section.php'; ?>

<section class="section">
  <div class="wrap calc-teaser reveal">
    <div>
      <span class="eyebrow">Kalkulačka</span>
      <h2>Koľko bude <em>stáť maľovanie?</em></h2>
      <p>Zadajte výmeru a typ prác a hneď uvidíte orientačnú cenu. <?= SLOGAN ?></p>
    </div>
    <a class="btn btn-lg" href="kalkulacka.php"><?= icon('calc') ?> Spočítať cenu</a>
  </div>
</section>

<section class="section dark2">
  <div class="wrap split">
    <div class="reveal">
      <span class="eyebrow">Ako pracujeme</span>
      <h2>Od obhliadky po <em>hotové dielo</em></h2>
      <ol class="steps">
        <li><span><b>Zavoláte nám</b> a dohodneme si obhliadku.</span></li>
        <li><span><b>Prejdeme priestor</b> a navrhneme riešenie aj farby.</span></li>
        <li><span><b>Pripravíme podklad</b> a zakryjeme všetko, čo treba.</span></li>
        <li><span><b>Namaľujeme</b> a po sebe poriadne upraceme.</span></li>
      </ol>
      <a class="btn" href="kontakt.php">Dohodnúť obhliadku</a>
    </div>
    <div class="split-img reveal"><img src="assets/img/photo-proces.jpg" alt="Maliar pri práci v interiéri" loading="lazy"></div>
  </div>
</section>
<?php
$homeFaq = [
    ['Ako prebieha spolupráca?', 'Zavoláte nám alebo napíšete, dohodneme si obhliadku, prejdeme priestor a navrhneme riešenie. Presnú ponuku pripravíme po obhliadke.'],
    ['Zistím cenu ešte pred obhliadkou?', 'Áno, orientačnú cenu si viete hneď spočítať v našej kalkulačke. Presnú cenu stanovíme po obhliadke podľa skutočného stavu povrchu.'],
    ['Kde pôsobíte?', 'Pôsobíme v Košiciach, Michalovciach a Trebišove. Ak ste inde, určite nám zavolajte, radi sa dohodneme.'],
    $faq['interierove-malby'][0],
    $faq['exterierove-malby'][1],
    $faq['dekorativne-stierky'][0],
];
$faqLd = ['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => array_map(fn($f) => ['@type' => 'Question', 'name' => $f[0], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f[1]]], $homeFaq)];
?>
<section class="section" id="faq">
  <div class="wrap split faq-home">
    <div class="sec-head left reveal" data-bg="Otázky">
      <span class="eyebrow">Otázky a odpovede</span>
      <h2>Čo sa nás <em>najčastejšie pýtate</em></h2>
      <p>Nenašli ste odpoveď? Zavolajte nám alebo napíšte, radi poradíme.</p>
      <a class="btn" href="tel:<?= SITE_PHONE_E164 ?>"><?= icon('phone') ?> <?= SITE_PHONE ?></a>
    </div>
    <div class="faq">
      <?php foreach ($homeFaq as [$q, $a]): ?>
        <details class="reveal"><summary><?= e($q) ?><?= icon('chevron') ?></summary><p><?= e($a) ?></p></details>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<script type="application/ld+json"><?= json_encode($faqLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></script>
<?php require __DIR__ . '/includes/footer.php'; ?>
