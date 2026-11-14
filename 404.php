<?php
http_response_code(404);
$page = '404';
$title = 'Stránka sa nenašla | Rofa Painting';
require __DIR__ . '/includes/header.php';
?>
<section class="page-hero center-hero">
  <div class="wrap">
    <h1>404</h1>
    <p class="lead">Táto stránka neexistuje alebo bola presunutá.</p>
    <a class="btn btn-lg" href="index.php">Späť na úvod</a>
  </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
