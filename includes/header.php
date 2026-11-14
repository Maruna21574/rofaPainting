<?php
require_once __DIR__ . '/config.php';
$page  = $page  ?? 'home';
$title = $title ?? 'Rofa Painting – Profesionálne maľby a natieračské práce';
$desc  = $desc  ?? 'Rofa Painting – profesionálne maľby, natieračské práce, dekoratívne stierky, sadrokartón a airless maľovanie. Kvalitne, rýchlo, čisto, spoľahlivo.';
$canonical = SITE_URL . '/' . ($page === 'home' ? '' : basename($_SERVER['SCRIPT_NAME']));
$nav = [
    'home'     => ['index.php', 'Domov'],
    'sluzby'   => ['sluzby.php', 'Služby'],
    'realizacie' => ['realizacie.php', 'Realizácie'],
    'kalkulacka' => ['kalkulacka.php', 'Kalkulačka'],
    'o-nas'    => ['o-nas.php', 'O nás'],
    'kontakt'  => ['kontakt.php', 'Kontakt'],
];
$isService = isset($services[$page]);
?><!DOCTYPE html>
<html lang="sk">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($title) ?></title>
<meta name="description" content="<?= e($desc) ?>">
<meta name="theme-color" content="#0e0e0e">
<link rel="canonical" href="<?= e($canonical) ?>">
<link rel="icon" type="image/png" href="assets/img/favicon.png">
<link rel="apple-touch-icon" href="assets/img/favicon.png">
<meta property="og:type" content="website">
<meta property="og:title" content="<?= e($title) ?>">
<meta property="og:description" content="<?= e($desc) ?>">
<meta property="og:image" content="<?= SITE_URL ?>/assets/img/og.jpg">
<meta property="og:locale" content="sk_SK">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<script>document.documentElement.className="js"</script>
<link rel="stylesheet" href="assets/css/style.css?v=2">
<link rel="stylesheet" href="assets/css/extra.css?v=2">
<link rel="stylesheet" href="assets/css/premium.css?v=1">
<link rel="stylesheet" href="assets/css/polish.css?v=1">
<link rel="stylesheet" href="assets/css/panels.css?v=1">
<script type="application/ld+json">
<?= json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'HousePainter',
    'name' => SITE_NAME,
    'url' => SITE_URL,
    'telephone' => SITE_PHONE_E164,
    'email' => SITE_EMAIL,
    'image' => SITE_URL . '/assets/img/logo.png',
    'description' => 'Maľovanie, tapetovanie a natieračské práce. Kvalita, čistota, precíznosť.',
    'areaServed' => array_map(fn($c) => ['@type' => 'City', 'name' => $c], $cities),
    'sameAs' => [SOCIAL_FB, SOCIAL_IG],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>
</script>
</head>
<body class="page-<?= e($page) ?>">
<a class="skip" href="#obsah">Preskočiť na obsah</a>

<header class="site-header" id="top">
  <div class="progress" id="progress"></div>
  <div class="wrap bar">
    <a class="brand" href="index.php" aria-label="Rofa Painting – domov">
      <img src="assets/img/logo-mark.png" alt="" width="40" height="auto">
      <span>ROFA <b>PAINTING</b></span>
    </a>
    <nav class="nav" id="nav" aria-label="Hlavné menu">
      <?php foreach ($nav as $key => [$href, $label]):
        $active = ($page === $key) || ($key === 'sluzby' && $isService);
        if ($key === 'sluzby'): ?>
        <div class="has-sub">
          <a href="<?= $href ?>"<?= $active ? ' class="active" aria-current="page"' : '' ?>><?= $label ?></a>
          <button class="sub-toggle" type="button" aria-expanded="false" aria-label="Rozbaliť zoznam služieb"><?= icon('chevron') ?></button>
          <div class="submenu">
            <div class="sub-grid">
              <?php foreach ($services as $slug => $sv): ?>
                <a class="sub-item<?= $page === $slug ? ' current' : '' ?>" href="<?= $slug ?>.php">
                  <span class="sub-ico"><?= icon($sv['icon']) ?></span>
                  <span class="sub-txt"><b><?= e($sv['title']) ?></b><small><?= e($sv['short']) ?></small></span>
                </a>
              <?php endforeach; ?>
            </div>
            <a class="sub-all" href="sluzby.php">Všetky služby <?= icon('arrow') ?></a>
          </div>
        </div>
        <?php else: ?>
        <a href="<?= $href ?>"<?= $active ? ' class="active" aria-current="page"' : '' ?>><?= $label ?></a>
      <?php endif; endforeach; ?>
      <a class="btn btn-sm nav-cta" href="tel:<?= SITE_PHONE_E164 ?>"><?= icon('phone') ?> <?= SITE_PHONE ?></a>
      <div class="nav-foot">
        <a href="mailto:<?= SITE_EMAIL ?>"><?= icon("mail") ?> <?= SITE_EMAIL ?></a>
        <span class="nav-soc">
          <a class="soc" href="<?= SOCIAL_FB ?>" target="_blank" rel="noopener" aria-label="Facebook"><?= icon("facebook") ?></a>
          <a class="soc" href="<?= SOCIAL_IG ?>" target="_blank" rel="noopener" aria-label="Instagram"><?= icon("instagram") ?></a>
        </span>
      </div>
    </nav>
    <button class="burger" id="burger" aria-label="Otvoriť menu" aria-expanded="false" aria-controls="nav">
      <?= icon('menu', 'ico open') ?><?= icon('close', 'ico shut') ?>
    </button>
  </div>
</header>
<main id="obsah">
