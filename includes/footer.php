</main>

<section class="cta-band">
  <div class="wrap cta-inner">
    <div>
      <h2>Zavolajte nám a dohodnite si obhliadku!</h2>
      <p>Premeníme váš priestor na miesto, kde sa budete cítiť doma.</p>
    </div>
    <div class="cta-actions">
      <a class="btn btn-dark btn-lg" href="tel:<?= SITE_PHONE_E164 ?>"><?= icon('phone') ?> <?= SITE_PHONE ?></a>
      <a class="btn btn-outline-dark btn-lg" href="kontakt.php">Napísať správu</a>
    </div>
  </div>
</section>

<footer class="site-footer">
  <div class="wrap foot-grid">
    <div>
      <img class="foot-logo" src="assets/img/logo.png" alt="Rofa Painting" width="150" height="auto" loading="lazy">
      <p class="muted">Maľovanie, tapetovanie a natieračské práce. Kvalita, čistota, precíznosť. <?= SLOGAN ?></p>
      <div class="social-row">
        <a class="soc" href="<?= SOCIAL_FB ?>" target="_blank" rel="noopener" aria-label="Facebook"><?= icon('facebook') ?></a>
        <a class="soc" href="<?= SOCIAL_IG ?>" target="_blank" rel="noopener" aria-label="Instagram"><?= icon('instagram') ?></a>
      </div>
    </div>
    <div>
      <h3>Služby</h3>
      <ul>
        <?php foreach ($services as $slug => $s): ?>
          <li><a href="<?= $slug ?>.php"><?= e($s['title']) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div>
      <h3>Stránky</h3>
      <ul>
        <li><a href="index.php">Domov</a></li>
        <li><a href="sluzby.php">Služby</a></li>
        <li><a href="realizacie.php">Realizácie</a></li>
        <li><a href="o-nas.php">O nás</a></li>
        <li><a href="kalkulacka.php">Kalkulačka ceny</a></li>
        <li><a href="kontakt.php">Kontakt</a></li>
      </ul>
    </div>
    <div>
      <h3>Kontakt</h3>
      <ul>
        <li><a href="tel:<?= SITE_PHONE_E164 ?>"><?= icon('phone') ?> <?= SITE_PHONE ?></a></li>
        <li><a href="mailto:<?= SITE_EMAIL ?>"><?= icon('mail') ?> <?= SITE_EMAIL ?></a></li>
        <li><span class="loc"><?= icon('pin') ?> <?= e(implode(' • ', $cities)) ?></span></li>
      </ul>
    </div>
  </div>
  <div class="wrap copy">© <?= date('Y') ?> Rofa Painting. Všetky práva vyhradené.</div>
</footer>

<a class="fab" href="tel:<?= SITE_PHONE_E164 ?>" aria-label="Zavolať <?= SITE_PHONE ?>"><?= icon('phone') ?></a>

<div class="lightbox" id="lightbox" hidden>
  <button class="lb-close" aria-label="Zavrieť"><?= icon('close') ?></button>
  <div class="lb-body"></div>
</div>

<script src="assets/js/main.js?v=2" defer></script>
<script src="assets/js/extra.js?v=2" defer></script>
<script src="assets/js/premium.js?v=1" defer></script>
<script src="assets/js/polish.js?v=1" defer></script>
<script src="assets/js/fx3d.js?v=1" defer></script>
</body>
</html>
