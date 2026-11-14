<?php
require_once __DIR__ . '/includes/config.php';
$page = 'kalkulacka';
$title = 'Kalkulačka ceny | Rofa Painting';
$desc = 'Zistite orientačnú cenu maliarskych a natieračských prác podľa typu prác, výmery, stavu povrchu a doplnkov. Kalkulačka Rofa Painting.';

$cfg = [
    'services' => array_map(fn($slug, $s) => ['slug' => $slug, 'title' => $s['title'], 'min' => $calc[$slug]['min'], 'max' => $calc[$slug]['max']], array_keys($services), $services),
    'conditions' => $calcCondition,
    'extras' => $calcExtras,
    'urgent' => $calcUrgent,
    'minOrder' => CALC_MIN_ORDER,
];
require __DIR__ . '/includes/header.php';
?>
<section class="page-hero">
  <div class="wrap">
    <nav class="crumbs"><a href="index.php">Domov</a> / <span>Kalkulačka</span></nav>
    <h1>Kalkulačka <em>orientačnej ceny</em></h1>
    <p class="lead">Poskladajte si zákazku v štyroch krokoch a hneď uvidíte odhad ceny. Presnú ponuku vám pripravíme po obhliadke.</p>
  </div>
</section>

<section class="section">
  <div class="wrap calc-grid">
    <form class="calc-form" id="calc" onsubmit="return false" data-cfg="<?= e(json_encode($cfg, JSON_UNESCAPED_UNICODE)) ?>">

      <div class="step reveal">
        <h2><span class="n">1</span> Čo potrebujete?</h2>
        <div class="tiles tiles-svc">
          <?php foreach ($services as $slug => $sv): ?>
            <label class="tile">
              <input type="radio" name="service" value="<?= $slug ?>"<?= $slug === 'interierove-malby' ? ' checked' : '' ?>>
              <span class="tile-in"><span class="t-ico"><?= icon($sv['icon']) ?></span><b><?= e($sv['title']) ?></b></span>
            </label>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="step reveal">
        <h2><span class="n">2</span> Kde a aká veľká plocha?</h2>
        <div class="tiles tiles-space">
          <?php foreach ($calcSpace as $i => $sp): ?>
            <label class="tile tile-sm">
              <input type="radio" name="space" value="<?= e($sp) ?>"<?= $i === 0 ? ' checked' : '' ?>>
              <span class="tile-in"><b><?= e($sp) ?></b></span>
            </label>
          <?php endforeach; ?>
        </div>
        <div class="area-box">
          <div class="area-top"><span>Plocha na maľovanie</span><span class="area-val"><input type="number" id="c-area-num" min="1" max="5000" value="60" inputmode="numeric"> m²</span></div>
          <input type="range" id="c-area" min="5" max="500" step="5" value="60">
          <div class="range-lab"><span>5 m²</span><span>250 m²</span><span>500 m²</span></div>
          <div class="presets">
            <span>Rýchly výber:</span>
            <button type="button" data-a="25">Izba 25 m²</button>
            <button type="button" data-a="60">Byt 60 m²</button>
            <button type="button" data-a="120">Dom 120 m²</button>
            <button type="button" data-a="250">Veľký dom 250 m²</button>
          </div>
        </div>
      </div>

      <div class="step reveal">
        <h2><span class="n">3</span> V akom stave je povrch?</h2>
        <div class="tiles tiles-cond">
          <?php foreach ($calcCondition as $i => $c): ?>
            <label class="tile">
              <input type="radio" name="cond" value="<?= $i ?>"<?= $i === 0 ? ' checked' : '' ?>>
              <span class="tile-in"><b><?= e($c['label']) ?></b></span>
            </label>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="step reveal">
        <h2><span class="n">4</span> Doplnkové práce a termín</h2>
        <div class="tiles tiles-extra">
          <?php foreach ($calcExtras as $ex): ?>
            <label class="tile">
              <input type="checkbox" name="extra" value="<?= e($ex['key']) ?>">
              <span class="tile-in tile-row"><span class="t-ico"><?= icon($ex['icon']) ?></span><span><b><?= e($ex['label']) ?></b><small><?= e($ex['desc']) ?></small></span><i class="chk"><?= icon('check') ?></i></span>
            </label>
          <?php endforeach; ?>
          <label class="tile">
            <input type="checkbox" name="urgent" value="1">
            <span class="tile-in tile-row"><span class="t-ico"><?= icon('clock') ?></span><span><b>Urgentný termín</b><small>Potrebujete začať čo najskôr</small></span><i class="chk"><?= icon('check') ?></i></span>
          </label>
        </div>
      </div>
    </form>

    <aside class="calc-result" aria-live="polite">
      <small>Orientačná cena</small>
      <div class="price"><span id="r-min">0</span> – <span id="r-max">0</span> <i>€</i></div>
      <div class="pbar" id="r-bar" aria-hidden="true"></div>
      <ul class="breakdown" id="r-list"></ul>
      <div class="r-sum" id="r-note"></div>
      <p class="disc">Ide o nezáväzný odhad. Konečná cena závisí od skutočného stavu povrchu, použitého materiálu a náročnosti prác a stanovíme ju po obhliadke.</p>
      <a class="btn btn-lg" id="r-cta" href="kontakt.php"><?= icon('mail') ?> Chcem presnú ponuku</a>
      <a class="btn btn-ghost" href="tel:<?= SITE_PHONE_E164 ?>"><?= icon('phone') ?> <?= SITE_PHONE ?></a>
    </aside>
  </div>
</section>
<div class="calc-bar" id="calc-bar"><div><small>Orientačná cena</small><b><span id="b-min">0</span> – <span id="b-max">0</span> €</b></div><a class="btn btn-sm" id="b-cta" href="kontakt.php">Ponuka</a></div>
<?php require __DIR__ . '/includes/footer.php'; ?>
