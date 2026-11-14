<?php
session_start();
require_once __DIR__ . '/includes/config.php';

$page = 'kontakt';
$title = 'Kontakt | Rofa Painting';
$desc = 'Kontaktujte Rofa Painting: tel. 0948 708 703, e-mail info@rofapainting.sk. Dohodnite si nezáväznú obhliadku.';

if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(16));

$status = null; $msg = ''; $old = ['name' => '', 'email' => '', 'phone' => '', 'service' => $_GET['sluzba'] ?? '', 'message' => mb_substr((string)($_GET['sprava'] ?? ''), 0, 500)];
$isAjax = ($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'fetch';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach (['name', 'email', 'phone', 'service', 'message'] as $k) {
        $old[$k] = trim((string)($_POST[$k] ?? ''));
    }
    $errors = [];
    if (!hash_equals($_SESSION['csrf'], (string)($_POST['csrf'] ?? ''))) $errors[] = 'Platnosť formulára vypršala, obnovte stránku a skúste znova.';
    if (!empty($_POST['website'])) { $errors[] = 'Spam.'; }                    // honeypot
    if (mb_strlen($old['name']) < 2) $errors[] = 'Zadajte svoje meno.';
    if (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) $errors[] = 'Zadajte platný e-mail.';
    if (mb_strlen($old['message']) < 5) $errors[] = 'Napíšte správu.';
    if (preg_match('/[\r\n]/', $old['name'] . $old['email'])) $errors[] = 'Neplatné znaky.';
    // jednoduchý limit: 1 správa za 30 s na reláciu
    if (!$errors && time() - ($_SESSION['last_sent'] ?? 0) < 30) $errors[] = 'Počkajte chvíľu pred odoslaním ďalšej správy.';

    if (!$errors) {
        $subject = '=?UTF-8?B?' . base64_encode('Nová správa z webu – ' . $old['name']) . '?=';
        $body = "Meno: {$old['name']}\nE-mail: {$old['email']}\nTelefón: {$old['phone']}\nSlužba: {$old['service']}\n\nSpráva:\n{$old['message']}\n";
        $headers = "From: " . SITE_NAME . " <" . MAIL_FROM . ">\r\nReply-To: {$old['email']}\r\nMIME-Version: 1.0\r\nContent-Type: text/plain; charset=UTF-8\r\n";
        if (@mail(MAIL_TO, $subject, $body, $headers)) {
            $_SESSION['last_sent'] = time();
            $status = 'ok'; $msg = 'Ďakujeme! Vašu správu sme prijali a čoskoro sa vám ozveme.';
            $old = ['name' => '', 'email' => '', 'phone' => '', 'service' => '', 'message' => ''];
        } else {
            $status = 'err'; $msg = 'Správu sa nepodarilo odoslať. Zavolajte nám prosím na ' . SITE_PHONE . ' alebo napíšte na ' . SITE_EMAIL . '.';
        }
    } else {
        $status = 'err'; $msg = implode(' ', $errors);
    }
    if ($isAjax) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['ok' => $status === 'ok', 'message' => $msg], JSON_UNESCAPED_UNICODE);
        exit;
    }
}

require __DIR__ . '/includes/header.php';
?>
<section class="page-hero">
  <div class="wrap">
    <nav class="crumbs"><a href="index.php">Domov</a> / <span>Kontakt</span></nav>
    <h1>Kontaktujte <em>nás</em></h1>
    <p class="lead">Zavolajte, alebo nám napíšte. Dohodneme si nezáväznú obhliadku.</p>
  </div>
</section>

<section class="section">
  <div class="wrap contact-grid">
    <div class="contact-info reveal">
      <a class="info-card" href="tel:<?= SITE_PHONE_E164 ?>"><?= icon('phone') ?><span><small>Telefón</small><b><?= SITE_PHONE ?></b></span></a>
      <a class="info-card" href="mailto:<?= SITE_EMAIL ?>"><?= icon('mail') ?><span><small>E-mail</small><b><?= SITE_EMAIL ?></b></span></a>
      <div class="info-card"><?= icon('pin') ?><span><small>Pôsobíme v</small><b><?= e(implode(' • ', $cities)) ?></b></span></div>
      <div class="social-row">
        <a class="soc" href="<?= SOCIAL_FB ?>" target="_blank" rel="noopener" aria-label="Facebook"><?= icon('facebook') ?></a>
        <a class="soc" href="<?= SOCIAL_IG ?>" target="_blank" rel="noopener" aria-label="Instagram"><?= icon('instagram') ?></a>
      </div>
      <p class="muted">Radi vám pripravíme cenovú ponuku na mieru. Stačí nám stručne opísať, čo potrebujete namaľovať.</p>
    </div>

    <form class="form reveal" id="contact-form" method="post" action="kontakt.php" novalidate>
      <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
      <div class="hp" aria-hidden="true"><label>Web <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
      <div class="form-msg <?= $status ?>" id="form-msg" role="status" aria-live="polite"><?= e($msg) ?></div>
      <div class="row">
        <label>Meno*<input type="text" name="name" required autocomplete="name" value="<?= e($old['name']) ?>"></label>
        <label>Telefón<input type="tel" name="phone" autocomplete="tel" value="<?= e($old['phone']) ?>"></label>
      </div>
      <label>E-mail*<input type="email" name="email" required autocomplete="email" value="<?= e($old['email']) ?>"></label>
      <label>Služba
        <select name="service">
          <option value="">– vyberte –</option>
          <?php foreach ($services as $sv): ?>
            <option<?= $old['service'] === $sv['title'] ? ' selected' : '' ?>><?= e($sv['title']) ?></option>
          <?php endforeach; ?>
          <option<?= $old['service'] === 'Iné' ? ' selected' : '' ?>>Iné</option>
        </select>
      </label>
      <label>Správa*<textarea name="message" rows="5" required><?= e($old['message']) ?></textarea></label>
      <button class="btn btn-lg" type="submit">Odoslať správu <?= icon('arrow') ?></button>
    </form>
  </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
