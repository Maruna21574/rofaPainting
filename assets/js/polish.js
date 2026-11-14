// Doladenie: kurzor, návrat nahor
(function () {
  'use strict';
  var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // ---- kurzor (len zariadenia s myšou) ----
  if (!reduce && window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
    var cur = document.createElement('div');
    cur.className = 'cur'; cur.setAttribute('aria-hidden', 'true');
    document.body.appendChild(cur);
    var x = 0, y = 0, cx = 0, cy = 0, started = false;
    document.addEventListener('pointermove', function (e) {
      x = e.clientX; y = e.clientY;
      if (!started) { cx = x; cy = y; started = true; cur.classList.add('on'); }
      var t = e.target.closest && e.target.closest('a,button,.panel,.tile,summary,label,input,select,textarea,.vid');
      cur.classList.toggle('link', !!t);
    }, { passive: true });
    document.addEventListener('pointerdown', function () { cur.classList.add('down'); });
    document.addEventListener('pointerup', function () { cur.classList.remove('down'); });
    document.documentElement.addEventListener('mouseleave', function () { cur.classList.remove('on'); });
    document.documentElement.addEventListener('mouseenter', function () { if (started) cur.classList.add('on'); });
    var loop = function () {
      cx += (x - cx) * 0.2; cy += (y - cy) * 0.2;
      cur.style.transform = 'translate3d(' + cx.toFixed(1) + 'px,' + cy.toFixed(1) + 'px,0)';
      requestAnimationFrame(loop);
    };
    requestAnimationFrame(loop);
  }

  // ---- návrat nahor ----
  var up = document.createElement('button');
  up.className = 'totop'; up.type = 'button'; up.setAttribute('aria-label', 'Späť hore');
  up.innerHTML = '<svg class="ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>';
  document.body.appendChild(up);
  up.addEventListener('click', function () { window.scrollTo({ top: 0, behavior: reduce ? 'auto' : 'smooth' }); });
  var tick = false;
  window.addEventListener('scroll', function () {
    if (tick) return; tick = true;
    requestAnimationFrame(function () { up.classList.toggle('show', window.scrollY > 700); tick = false; });
  }, { passive: true });
})();
