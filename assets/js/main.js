(function () {
  'use strict';

  // Mobilné menu
  var burger = document.getElementById('burger');
  var nav = document.getElementById('nav');
  if (burger && nav) {
    burger.addEventListener('click', function () {
      var open = nav.classList.toggle('open');
      burger.setAttribute('aria-expanded', open);
      document.body.classList.toggle('menu-open', open);
    });
    nav.addEventListener('click', function (e) {
      if (e.target.closest('a')) { nav.classList.remove('open'); burger.setAttribute('aria-expanded', 'false'); document.body.classList.remove('menu-open'); }
    });
  }

  // Submenu služieb
  var sub = document.querySelector('.has-sub');
  if (sub) {
    var tg = sub.querySelector('.sub-toggle');
    var setSub = function (o) { sub.classList.toggle('open', o); tg.setAttribute('aria-expanded', o); };
    tg.addEventListener('click', function (e) { e.stopPropagation(); setSub(!sub.classList.contains('open')); });
    document.addEventListener('click', function (e) { if (!sub.contains(e.target)) setSub(false); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') setSub(false); });
  }

  // Zobrazenie prvkov pri scrollovaní
  var items = document.querySelectorAll('.reveal');
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (en.isIntersecting) { en.target.classList.add('in'); io.unobserve(en.target); }
      });
    }, { threshold: 0.12 });
    items.forEach(function (el, i) { el.style.transitionDelay = (i % 4) * 70 + 'ms'; io.observe(el); });
  } else {
    items.forEach(function (el) { el.classList.add('in'); });
  }

  // Lightbox pre video a fotky
  var lb = document.getElementById('lightbox');
  if (lb) {
    var body = lb.querySelector('.lb-body');
    var close = function () { lb.hidden = true; body.innerHTML = ''; document.body.style.overflow = ''; };
    var openLb = function (node) { body.innerHTML = ''; body.appendChild(node); lb.hidden = false; document.body.style.overflow = 'hidden'; };
    document.addEventListener('click', function (e) {
      var v = e.target.closest('[data-video]');
      var p = e.target.closest('[data-image]');
      if (v) {
        var vid = document.createElement('video');
        vid.src = v.dataset.video; vid.controls = true; vid.autoplay = true; vid.playsInline = true;
        openLb(vid);
      } else if (p) {
        var img = document.createElement('img');
        img.src = p.dataset.image; img.alt = '';
        openLb(img);
      } else if (e.target === lb || e.target.closest('.lb-close') || e.target === body) {
        close();
      }
    });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && !lb.hidden) close(); });
  }

  // Kontaktný formulár (AJAX, bez načítania stránky)
  var form = document.getElementById('contact-form');
  if (form && window.fetch) {
    var msg = document.getElementById('form-msg');
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var btn = form.querySelector('button[type=submit]');
      btn.disabled = true;
      fetch(form.action, { method: 'POST', body: new FormData(form), headers: { 'X-Requested-With': 'fetch' } })
        .then(function (r) { return r.json(); })
        .then(function (d) {
          msg.textContent = d.message; msg.className = 'form-msg ' + (d.ok ? 'ok' : 'err');
          if (d.ok) form.reset();
          msg.scrollIntoView({ behavior: 'smooth', block: 'center' });
        })
        .catch(function () {
          msg.textContent = 'Chyba pripojenia. Skúste to znova alebo nám zavolajte.'; msg.className = 'form-msg err';
        })
        .finally(function () { btn.disabled = false; });
    });
  }
})();
