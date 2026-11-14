// Doplnkové funkcie: posuvník recenzií a kalkulačka
(function () {
  'use strict';

  // ---- Posuvník recenzií
  var sl = document.getElementById('reviews');
  if (sl) {
    var tr = sl.querySelector('.sl-track');
    var step = function (d) { var c = tr.querySelector('.review'); tr.scrollBy({ left: d * (c.offsetWidth + 22), behavior: 'smooth' }); };
    sl.querySelector('.prev').addEventListener('click', function () { step(-1); });
    sl.querySelector('.next').addEventListener('click', function () { step(1); });
  }

  // ---- Kalkulačka
  var form = document.getElementById('calc');
  if (!form) return;
  var cfg = JSON.parse(form.dataset.cfg);
  var $ = function (id) { return document.getElementById(id); };
  var nf = new Intl.NumberFormat('sk-SK');
  var round5 = function (n) { return Math.max(5, Math.round(n / 5) * 5); };
  var rng = $('c-area'), num = $('c-area-num');
  var shown = { min: 0, max: 0 }, raf;

  var animate = function (to) {
    cancelAnimationFrame(raf);
    var from = { min: shown.min, max: shown.max }, t0 = null;
    var tick = function (t) {
      t0 = t0 || t; var p = Math.min((t - t0) / 450, 1), e = 1 - Math.pow(1 - p, 3);
      shown.min = from.min + (to.min - from.min) * e; shown.max = from.max + (to.max - from.max) * e;
      $('r-min').textContent = nf.format(Math.round(shown.min)); $('r-max').textContent = nf.format(Math.round(shown.max));
      if (p < 1) raf = requestAnimationFrame(tick);
    };
    raf = requestAnimationFrame(tick);
  };

  var checked = function (name) {
    return Array.prototype.slice.call(form.querySelectorAll('input[name=' + name + ']:checked'));
  };

  var update = function (src) {
    var area = Math.max(1, +(src === 'num' ? num.value : rng.value) || 1);
    if (src === 'num') rng.value = Math.min(area, 500); else num.value = area;

    var slug = checked('service')[0].value;
    var svc = cfg.services.filter(function (s) { return s.slug === slug; })[0];
    var cond = cfg.conditions[+checked('cond')[0].value];
    var space = checked('space')[0].value;

    var lines = [];                       // {label, min, max}
    var baseMin = area * svc.min, baseMax = area * svc.max;
    lines.push({ label: svc.title + ' · ' + area + ' m²', min: baseMin, max: baseMax });

    var condMin = baseMin * (cond.k - 1), condMax = baseMax * (cond.k - 1);
    if (cond.k > 1) lines.push({ label: 'Stav povrchu (+' + Math.round((cond.k - 1) * 100) + ' %)', min: condMin, max: condMax });

    var baseAfterCond = { min: baseMin + condMin, max: baseMax + condMax };
    var extras = checked('extra').map(function (c) { return c.value; });
    var extraNames = [];
    cfg.extras.forEach(function (ex) {
      if (extras.indexOf(ex.key) < 0) return;
      var mn, mx;
      if (ex.type === 'm2') { mn = area * ex.min; mx = area * ex.max; }
      else if (ex.type === 'pct') { mn = baseAfterCond.min * ex.min / 100; mx = baseAfterCond.max * ex.max / 100; }
      else { mn = ex.min; mx = ex.max; }
      lines.push({ label: ex.label, min: mn, max: mx }); extraNames.push(ex.label);
    });

    var subMin = 0, subMax = 0;
    lines.forEach(function (l) { subMin += l.min; subMax += l.max; });

    var urgent = checked('urgent').length > 0;
    if (urgent) lines.push({ label: 'Urgentný termín', min: subMin * cfg.urgent.min / 100, max: subMax * cfg.urgent.max / 100 });

    var totMin = 0, totMax = 0;
    lines.forEach(function (l) { totMin += l.min; totMax += l.max; });
    var floored = false;
    if (totMax < cfg.minOrder) { totMin = cfg.minOrder; totMax = cfg.minOrder; floored = true; }
    else if (totMin < cfg.minOrder) { totMin = cfg.minOrder; floored = true; }
    totMin = round5(totMin); totMax = Math.max(totMin, round5(totMax));

    animate({ min: totMin, max: totMax });

    // rozpis
    var list = $('r-list'); list.innerHTML = '';
    lines.forEach(function (l, i) {
      var li = document.createElement('li');
      li.innerHTML = '<i class="dot s' + (i % 5) + '"></i><span></span><b></b>';
      li.children[1].textContent = l.label;
      li.children[2].textContent = nf.format(round5(l.min)) + ' – ' + nf.format(round5(l.max)) + ' €';
      list.appendChild(li);
    });
    if (floored) {
      var f = document.createElement('li'); f.className = 'floor';
      f.textContent = 'Uplatnila sa minimálna cena zákazky ' + cfg.minOrder + ' €.'; list.appendChild(f);
    }

    // skladaný pásik podielov
    var bar = $('r-bar'); bar.innerHTML = '';
    var tot = 0; lines.forEach(function (l) { tot += (l.min + l.max) / 2; });
    lines.forEach(function (l, i) {
      var s = document.createElement('span'); s.className = 's' + (i % 5);
      s.style.width = Math.max(3, (l.min + l.max) / 2 / tot * 100) + '%'; bar.appendChild(s);
    });

    // odkaz na dopyt
    var msg = 'Dobrý deň, mám záujem o ponuku.\n' +
      'Služba: ' + svc.title + '\nTyp priestoru: ' + space + '\nPlocha: približne ' + area + ' m²\nStav povrchu: ' + cond.label +
      (extraNames.length ? '\nDoplnky: ' + extraNames.join(', ') : '') + (urgent ? '\nUrgentný termín: áno' : '') +
      '\nOrientačný odhad z kalkulačky: ' + nf.format(totMin) + ' – ' + nf.format(totMax) + ' €';
    $('r-cta').href = 'kontakt.php?sluzba=' + encodeURIComponent(svc.title) + '&sprava=' + encodeURIComponent(msg);
    $('b-min').textContent = nf.format(totMin); $('b-max').textContent = nf.format(totMax); $('b-cta').href = $('r-cta').href;
    $('r-note').textContent = space + ' · ' + area + ' m²';
  };

  rng.addEventListener('input', function () { update('rng'); });
  num.addEventListener('input', function () { update('num'); });
  form.addEventListener('change', function () { update(); });
  form.querySelectorAll('.presets button').forEach(function (b) {
    b.addEventListener('click', function () { num.value = b.dataset.a; update('num'); });
  });
  update();
})();

// Vylepšenia vzhľadu: pokrok scrollovania, paralaxa, svetlo sledujúce kurzor
(function () {
  'use strict';
  var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var prog = document.getElementById('progress');
  var px = Array.prototype.slice.call(document.querySelectorAll('.phone-frame, .split-img img'));
  var ticking = false;

  var onScroll = function () {
    if (prog) {
      var h = document.documentElement.scrollHeight - window.innerHeight;
      prog.style.width = (h > 0 ? window.scrollY / h * 100 : 0) + '%';
    }
    if (!reduce) {
      var vh = window.innerHeight;
      px.forEach(function (el) {
        var r = el.getBoundingClientRect();
        if (r.bottom < -100 || r.top > vh + 100) return;
        var d = (r.top + r.height / 2 - vh / 2) / vh;      // -1 .. 1
        el.style.setProperty('--py', Math.max(-1, Math.min(1, d)) * -26 + 'px');
      });
    }
    ticking = false;
  };
  window.addEventListener('scroll', function () {
    if (!ticking) { ticking = true; requestAnimationFrame(onScroll); }
  }, { passive: true });
  window.addEventListener('resize', onScroll);
  onScroll();

  // svetlo sledujúce kurzor na kartách
  document.addEventListener('mousemove', function (e) {
    var t = e.target.closest && e.target.closest('.feat, .card, .step');
    if (!t) return;
    var r = t.getBoundingClientRect();
    t.style.setProperty('--mx', (e.clientX - r.left) + 'px');
    t.style.setProperty('--my', (e.clientY - r.top) + 'px');
  });
})();

// Mobilné menu: zatvorenie klávesom Esc a pri zväčšení okna
(function () {
  'use strict';
  var nav = document.getElementById('nav'), burger = document.getElementById('burger');
  if (!nav || !burger) return;
  var close = function () {
    nav.classList.remove('open'); burger.setAttribute('aria-expanded', 'false'); document.body.classList.remove('menu-open');
  };
  document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && nav.classList.contains('open')) { close(); burger.focus(); } });
  window.addEventListener('resize', function () { if (window.innerWidth > 980) close(); });
})();
