<?php
$reviews = require __DIR__ . '/reviews.php';
$demo = false;
// Ukážkový režim: len na lokálnom počítači (localhost / *.test), nikdy na ostrej doméne.
$host = strtolower(preg_replace('/:\d+$/', '', $_SERVER['HTTP_HOST'] ?? ''));
$isLocal = $host === 'localhost' || $host === '127.0.0.1' || substr($host, -5) === '.test';
if (!$reviews && $isLocal) {
    $demo = true;
    $reviews = [
        ['name' => 'Ukážka A', 'text' => 'Toto je ukážkový text na zobrazenie dizajnu posuvníka.', 'stars' => 5, 'source' => 'google'],
        ['name' => 'Ukážka B', 'text' => 'Ukážkový text. Skutočné recenzie vložte do includes/reviews.php.', 'stars' => 5, 'source' => 'google'],
        ['name' => 'Ukážka C', 'text' => 'Ukážkový text. Táto sekcia sa na ostrom webe nezobrazí bez skutočných recenzií.', 'stars' => 5, 'source' => 'facebook'],
        ['name' => 'Ukážka D', 'text' => 'Ukážkový text pre štvrtú kartu, aby bolo vidno posúvanie.', 'stars' => 5, 'source' => 'google'],
    ];
}
if (!$reviews) return;
$google = '<svg class="src-logo" viewBox="0 0 48 48" aria-label="Google"><path fill="#EA4335" d="M24 9.5c3.5 0 6.6 1.2 9.1 3.6l6.8-6.8C35.8 2.4 30.3 0 24 0 14.6 0 6.5 5.4 2.6 13.2l7.9 6.1C12.4 13.6 17.7 9.5 24 9.5z"/><path fill="#4285F4" d="M46.5 24.5c0-1.6-.1-3.1-.4-4.5H24v9h12.7c-.6 3-2.3 5.5-4.8 7.2l7.5 5.8c4.4-4.1 7.1-10.1 7.1-17.5z"/><path fill="#FBBC05" d="M10.5 28.7a14.5 14.5 0 0 1 0-9.4l-7.9-6.1a24 24 0 0 0 0 21.6l7.9-6.1z"/><path fill="#34A853" d="M24 48c6.5 0 11.9-2.1 15.9-5.8l-7.5-5.8c-2.1 1.4-4.9 2.3-8.4 2.3-6.3 0-11.6-4.1-13.5-9.8l-7.9 6.1C6.5 42.6 14.6 48 24 48z"/></svg>';
$fb = '<svg class="src-logo" viewBox="0 0 24 24" aria-label="Facebook"><circle cx="12" cy="12" r="12" fill="#1877F2"/><path fill="#fff" d="M13.5 19v-6h2l.4-2.5h-2.4V9c0-.7.3-1.2 1.3-1.2H16V5.6c-.2 0-1-.1-1.8-.1-1.9 0-3.2 1.200-3.2 3.300v1.700H9V13h2v6z"/></svg>';
?>
<section class="section">
  <div class="wrap">
    <div class="sec-head reveal">
      <span class="eyebrow">Referencie</span>
      <h2>Čo hovoria <em>zákazníci</em></h2>
      <?php if ($demo): ?><p class="demo-flag">UKÁŽKA DIZAJNU – nie sú to skutočné recenzie. Zobrazuje sa len lokálne.</p><?php endif; ?>
    </div>
    <div class="slider reveal" id="reviews">
      <button class="sl-btn prev" aria-label="Predchádzajúce"><?= icon('arrow') ?></button>
      <div class="sl-track">
        <?php foreach ($reviews as $r): $n = max(1, min(5, (int)($r['stars'] ?? 5))); ?>
          <article class="review">
            <div class="rev-top">
              <span class="avatar"><?= e(mb_strtoupper(mb_substr($r['name'], 0, 1))) ?></span>
              <div><b><?= e($r['name']) ?></b>
                <div class="stars" aria-label="<?= $n ?> z 5 hviezdičiek"><?php for ($i = 0; $i < $n; $i++) echo icon('star', 'ico star'); ?></div>
              </div>
              <?= ($r['source'] ?? '') === 'facebook' ? $fb : (($r['source'] ?? '') === 'google' ? $google : '') ?>
            </div>
            <p>„<?= e($r['text']) ?>“</p>
          </article>
        <?php endforeach; ?>
      </div>
      <button class="sl-btn next" aria-label="Ďalšie"><?= icon('arrow') ?></button>
    </div>
    <?php if (GOOGLE_REVIEWS_URL): ?>
      <p class="center mt"><a class="btn btn-ghost" href="<?= e(GOOGLE_REVIEWS_URL) ?>" target="_blank" rel="noopener">Všetky hodnotenia na Google <?= icon('arrow') ?></a></p>
    <?php endif; ?>
  </div>
</section>
