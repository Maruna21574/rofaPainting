// Prémiové vylepšenia: otáčajúce sa slovo, panely služieb, automatické videá, časová os
(function () {
  'use strict';
  var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // otáčajúce sa slovo v nadpise
  var rot = document.querySelector('.rot');
  if (rot && !reduce) {
    var words = (rot.dataset.words || '').split('|'), w = rot.querySelector('.rot-w'), idx = 0;
    if (words.length > 1 && w) {
      setInterval(function () {
        w.classList.add('out');
        setTimeout(function () {
          idx = (idx + 1) % words.length;
          w.textContent = words[idx];
          w.classList.add('pre'); w.classList.remove('out');
          void w.offsetWidth;
          w.classList.remove('pre');
        }, 480);
      }, 2800);
    }
  }

  // panely služieb (rozbalia sa po prejdení myšou alebo fokusom)
  var panels = document.querySelectorAll('#panels .panel');
  if (panels.length) {
    var activate = function (p) {
      if (window.innerWidth <= 900) return;
      panels.forEach(function (x) { x.classList.toggle('active', x === p); });
    };
    panels.forEach(function (p) {
      p.addEventListener('mouseenter', function () { activate(p); });
      p.addEventListener('focus', function () { activate(p); });
    });
  }

  // videá sa prehrávajú, keď sú vidieť
  var vids = document.querySelectorAll('.vid');
  var saver = navigator.connection && navigator.connection.saveData;
  if (vids.length && 'IntersectionObserver' in window && !reduce && !saver) {
    var vo = new IntersectionObserver(function (es) {
      es.forEach(function (en) {
        var box = en.target, v = box.querySelector('video');
        if (!v) return;
        if (en.isIntersecting) {
          if (!v.getAttribute('src')) v.src = v.dataset.src;
          var p = v.play(); if (p && p.catch) p.catch(function () {});
          v.addEventListener('playing', function () { box.classList.add('playing'); }, { once: true });
        } else {
          v.pause();
        }
      });
    }, { threshold: 0.5 });
    vids.forEach(function (v) { vo.observe(v); });
  }

  // časová os „Ako pracujeme“
  var steps = document.querySelectorAll('.steps li');
  if (steps.length && 'IntersectionObserver' in window) {
    var so = new IntersectionObserver(function (es) {
      es.forEach(function (en) {
        if (en.isIntersecting) { en.target.classList.add('done'); so.unobserve(en.target); }
      });
    }, { rootMargin: '0px 0px -25% 0px', threshold: 0.4 });
    steps.forEach(function (s) { so.observe(s); });
  } else {
    steps.forEach(function (s) { s.classList.add('done'); });
  }
})();
