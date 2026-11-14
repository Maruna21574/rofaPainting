<?php
// Zlatý ťah štetca ako delič sekcií. Použitie: $brushFlip = true; include 'includes/brush.php';
static $brushId = 0; $brushId++;
$flip = !empty($brushFlip); $brushFlip = false;
?>
<div class="brush-div<?= $flip ? ' flip' : '' ?>" aria-hidden="true">
  <svg viewBox="0 0 1440 120" preserveAspectRatio="none">
    <defs>
      <linearGradient id="bg<?= $brushId ?>" x1="0" x2="1"><stop offset="0" stop-color="#9a7822"/><stop offset=".5" stop-color="#e2bd62"/><stop offset="1" stop-color="#b08a2e"/></linearGradient>
    </defs>
    <path fill="url(#bg<?= $brushId ?>)" d="M0 62C90 34 190 78 330 56S590 18 760 56s330 52 470 8c80-25 150-18 210-6l0 24c-60-12-130-17-210 6-140 44-320 14-470-24S470 92 330 88 90 108 0 90Z"/>
    <path fill="#c9a03d" opacity=".35" d="M40 98c120-22 230 6 380-4s300-30 470-6 360 6 520-8v14c-160 14-350 30-520 8s-330 12-470 22-260-16-380 0Z"/>
  </svg>
</div>
