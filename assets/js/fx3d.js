// Jemné 3D prvky (zlatý valček a kvapky farby) na viacerých miestach webu.
// Jedna priehľadná vrstva (canvas) cez celú stránku; objekty sa kreslia k vybraným prvkom stránky.
(function () {
  'use strict';
  var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var finePointer = window.matchMedia && window.matchMedia('(hover: hover)').matches;

  // ---------- náklon videa v hero (funguje aj bez WebGL) ----------
  var hero = document.querySelector('.hero');
  var card = document.querySelector('.phone-frame');
  var mx = 0, my = 0, sx = 0, sy = 0;           // kurzor (-1..1) – cieľ a vyhladená hodnota
  if (finePointer && !reduce) {
    window.addEventListener('pointermove', function (e) {
      mx = (e.clientX / window.innerWidth) * 2 - 1;
      my = (e.clientY / window.innerHeight) * 2 - 1;
    }, { passive: true });
  }
  var tiltCard = function () {
    if (!card || reduce) return;
    card.style.setProperty('--rx', (-sy * 6).toFixed(2) + 'deg');
    card.style.setProperty('--ry', (sx * 8).toFixed(2) + 'deg');
  };

  if (!window.THREE) { return; }
  var T = THREE, renderer;
  var canvas = document.createElement('canvas');
  canvas.id = 'fx3d'; canvas.setAttribute('aria-hidden', 'true');
  document.body.appendChild(canvas);
  try {
    renderer = new T.WebGLRenderer({ canvas: canvas, antialias: true, alpha: true });
  } catch (e) { canvas.remove(); return; }
  renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 2));
  renderer.outputEncoding = T.sRGBEncoding;
  renderer.toneMapping = T.ACESFilmicToneMapping;
  renderer.toneMappingExposure = 0.95;

  var scene = new T.Scene();
  var FOV = 30, camera = new T.PerspectiveCamera(FOV, 1, 10, 6000);
  var W = 1, H = 1;

  // ---------- odrazové prostredie (kovový vzhľad zlata) ----------
  var env = new T.Scene();
  env.background = new T.Color(0x14110a);
  var strip = function (w, h, x, y, z, c, i) {
    var m = new T.Mesh(new T.PlaneGeometry(w, h), new T.MeshBasicMaterial({ color: new T.Color(c).multiplyScalar(i), side: T.DoubleSide }));
    m.position.set(x, y, z); m.lookAt(0, 0, 0); env.add(m);
  };
  strip(10, 3, 0, 8, 2, 0xfff2cf, 6); strip(3, 10, -8, 0, 2, 0xffffff, 3);
  strip(3, 10, 8, 1, -2, 0xffd78a, 4); strip(10, 2, 0, -7, 3, 0xc9a03d, 2); strip(6, 6, 0, 0, 9, 0xffffff, 1.2);
  scene.environment = new T.PMREMGenerator(renderer).fromScene(env, 0.04).texture;
  var key = new T.DirectionalLight(0xfff0d0, 1.4); key.position.set(300, 500, 600); scene.add(key);

  // ---------- materiály a geometria (zdieľané) ----------
  var mats = {
    gold: new T.MeshStandardMaterial({ color: 0xc4952a, metalness: 1, roughness: 0.3 }),
    goldSoft: new T.MeshStandardMaterial({ color: 0xb88a28, metalness: 1, roughness: 0.42 }),
    dark: new T.MeshStandardMaterial({ color: 0x151515, metalness: 0.4, roughness: 0.35 }),
    gloss: new T.MeshPhysicalMaterial({ color: 0x0c0c0c, metalness: 0.2, roughness: 0.08, clearcoat: 1, clearcoatRoughness: 0.05 })
  };
  var gBody = new T.CylinderGeometry(0.5, 0.5, 2.1, 48);
  var gCap = new T.CylinderGeometry(0.42, 0.5, 0.12, 40);
  var gFrame = new T.TubeGeometry(new T.CatmullRomCurve3([
    new T.Vector3(1.14, 0, 0), new T.Vector3(1.5, 0, 0), new T.Vector3(1.68, -0.12, 0),
    new T.Vector3(1.68, -0.8, 0), new T.Vector3(0.3, -0.98, 0), new T.Vector3(0.12, -1.06, 0)
  ], false, 'catmullrom', 0.35), 70, 0.06, 12, false);
  var gGrip = new T.CylinderGeometry(0.17, 0.2, 1.4, 28);
  var gRing = new T.CylinderGeometry(0.205, 0.205, 0.1, 28);
  var pts = [];
  for (var i = 0; i <= 40; i++) {
    var t = (i / 40) * Math.PI;
    pts.push(new T.Vector2(Math.max(0.0001, Math.sin(t) * Math.pow(Math.sin(t / 2), 1.1) * 0.55), Math.cos(t) * 0.65));
  }
  var gDrop = new T.LatheGeometry(pts, 36);

  var makeRoller = function () {
    var g = new T.Group();
    var b = new T.Mesh(gBody, mats.gold); b.rotation.z = Math.PI / 2; g.add(b);
    [-1, 1].forEach(function (s) { var c = new T.Mesh(gCap, mats.dark); c.rotation.z = Math.PI / 2; c.position.x = s * 1.08; g.add(c); });
    g.add(new T.Mesh(gFrame, mats.goldSoft));
    var gr = new T.Mesh(gGrip, mats.dark); gr.position.set(0.1, -1.8, 0); g.add(gr);
    var r = new T.Mesh(gRing, mats.gold); r.position.set(0.1, -1.18, 0); g.add(r);
    return g;
  };

  // vzorkovníková kartička farby (biela karta s farebným poľom)
  var rrect = function (w, h, r) {
    var s = new T.Shape(), x = -w / 2, y = -h / 2;
    s.moveTo(x + r, y); s.lineTo(x + w - r, y); s.quadraticCurveTo(x + w, y, x + w, y + r);
    s.lineTo(x + w, y + h - r); s.quadraticCurveTo(x + w, y + h, x + w - r, y + h);
    s.lineTo(x + r, y + h); s.quadraticCurveTo(x, y + h, x, y + h - r);
    s.lineTo(x, y + r); s.quadraticCurveTo(x, y, x + r, y);
    return s;
  };
  var slab = function (w, h, r, d) {
    var g = new T.ExtrudeGeometry(rrect(w, h, r), { depth: d, bevelEnabled: true, bevelThickness: 0.012, bevelSize: 0.012, bevelSegments: 2, curveSegments: 8 });
    g.translate(0, 0, -d / 2); return g;
  };
  var gCard = slab(1, 1.5, 0.1, 0.05), gPanel = slab(0.84, 0.98, 0.07, 0.04), gLine = slab(0.84, 0.05, 0.02, 0.03);
  var matCard = new T.MeshStandardMaterial({ color: 0xe9e4d8, roughness: 0.6, metalness: 0, envMapIntensity: 0.35 });
  var chipMats = {
    gold: new T.MeshStandardMaterial({ color: 0xc9a03d, metalness: 0.85, roughness: 0.4, envMapIntensity: 0.55 }),
    travertino: new T.MeshStandardMaterial({ color: 0xc4a86f, metalness: 0, roughness: 0.75, envMapIntensity: 0.3 }),
    beton: new T.MeshStandardMaterial({ color: 0x4a4a4a, metalness: 0.05, roughness: 0.85, envMapIntensity: 0.3 }),
    limewash: new T.MeshStandardMaterial({ color: 0xcfc8b4, metalness: 0, roughness: 0.9, envMapIntensity: 0.3 }),
    dark: new T.MeshStandardMaterial({ color: 0x1a1a1a, metalness: 0.3, roughness: 0.4 })
  };
  var makeChip = function (name) {
    var g = new T.Group();
    g.add(new T.Mesh(gCard, matCard));
    var p = new T.Mesh(gPanel, chipMats[name]); p.position.set(0, 0.18, 0.04); g.add(p);
    var l = new T.Mesh(gLine, chipMats.dark); l.position.set(0, -0.5, 0.035); g.add(l);
    var l2 = new T.Mesh(gLine, chipMats.dark); l2.scale.x = 0.55; l2.position.set(-0.19, -0.6, 0.035); g.add(l2);
    return g;
  };

  // ---------- kde sa objekty zobrazia ----------
  // fx, fy = poloha v rámci prvku (0–1, môže byť aj mimo), s = veľkosť v px, min = minimálna šírka okna
  var ANCHORS = [
    { sel: '.hero-media', kind: 'chip', mat: 'gold', fx: 0.96, fy: 0.06, s: 78, ry: -0.5, rz: -0.28, min: 0, mobile: 52 },
    { sel: '.hero-media', kind: 'chip', mat: 'travertino', fx: 1.05, fy: 0.22, s: 66, ry: -0.35, rz: 0.12, min: 0, mobile: 44 },
    { sel: '.hero-media', kind: 'chip', mat: 'beton', fx: -0.08, fy: 0.6, s: 70, ry: 0.5, rz: 0.22, min: 0, mobile: 46 },
    { sel: '.hero-media', kind: 'chip', mat: 'limewash', fx: 1.0, fy: 0.9, s: 58, ry: -0.45, rz: -0.12, min: 0, mobile: 38 },
    { sel: '#sluzby .sec-head', kind: 'drop', mat: 'gold', fx: -0.22, fy: 0.35, s: 34, min: 1100 },
    { sel: '#sluzby .sec-head', kind: 'drop', mat: 'gloss', fx: 1.2, fy: 0.75, s: 26, min: 1100 },
    { sel: '#preco .feat-grid', kind: 'roller', fx: 1.01, fy: -0.1, s: 32, min: 1100 },
    { sel: '#preco .sec-head', kind: 'drop', mat: 'goldSoft', fx: 0.85, fy: 1.1, s: 28, min: 1100 },
    { sel: '#realizacie .sec-head', kind: 'drop', mat: 'gold', fx: 1.28, fy: 0.4, s: 36, min: 1100 },
    { sel: '#realizacie .sec-head', kind: 'drop', mat: 'goldSoft', fx: -0.28, fy: 0.85, s: 26, min: 1100 },
    { sel: '.calc-teaser', kind: 'drop', mat: 'gold', fx: 0.98, fy: -0.1, s: 36, min: 1100 },
    { sel: '.calc-teaser', kind: 'drop', mat: 'gloss', fx: 0.02, fy: 1.12, s: 26, min: 1100 },
    { sel: '.page-hero .wrap', kind: 'roller', fx: 0.93, fy: 0.9, s: 38, min: 900 },
    { sel: '.page-hero .wrap', kind: 'drop', mat: 'gold', fx: 0.79, fy: 0.95, s: 30, min: 900 },
    { sel: '.page-hero .wrap', kind: 'drop', mat: 'gloss', fx: 0.98, fy: 0.12, s: 26, min: 900 },
    { sel: '.cta-band .cta-inner', kind: 'drop', mat: 'gloss', fx: 0.5, fy: 0.5, s: 32, min: 1100 }
  ];
  var items = [];
  ANCHORS.forEach(function (a, k) {
    var el = document.querySelector(a.sel);
    if (!el) return;
    var obj;
    if (a.kind === 'roller') obj = makeRoller();
    else if (a.kind === 'chip') obj = makeChip(a.mat);
    else { obj = new T.Mesh(gDrop, mats[a.mat]); }
    obj.visible = false; scene.add(obj);
    items.push({ a: a, el: el, obj: obj, phase: k * 1.37 });
  });
  if (!items.length) { canvas.remove(); return; }

  var resize = function () {
    W = window.innerWidth; H = window.innerHeight;
    renderer.setSize(W, H, false);
    camera.aspect = W / H;
    camera.position.set(0, 0, (H / 2) / Math.tan(FOV * Math.PI / 360));
    camera.updateProjectionMatrix();
  };
  window.addEventListener('resize', resize); resize();

  var render = function (time) {
    var t = time / 1000;
    sx += (mx - sx) * 0.06; sy += (my - sy) * 0.06;
    var any = false;
    items.forEach(function (it) {
      var a = it.a, o = it.obj;
      var minW = a.min || 0;
      var show = W >= minW && !(W < 700 && a.min > 0);
      var r = show ? it.el.getBoundingClientRect() : null;
      if (!r || r.bottom < -120 || r.top > H + 120 || !r.width) { o.visible = false; return; }
      any = true; o.visible = true;
      var s = (W < 700 && a.mobile) ? a.mobile : a.s;
      var px = r.left + a.fx * r.width, py = r.top + a.fy * r.height;
      py += Math.sin(t * 0.8 + it.phase) * 7;                   // jemné vznášanie
      o.position.set(px - W / 2, H / 2 - py, 0);
      o.scale.setScalar(s);
      if (a.kind === 'roller') {
        o.rotation.set(0.25 + sy * 0.2, -0.65 + sx * 0.4, -0.55 + Math.sin(t * 0.7 + it.phase) * 0.05);
      } else if (a.kind === 'chip') {
        o.rotation.set(0.15 + sy * 0.25, a.ry + sx * 0.45 + Math.sin(t * 0.6 + it.phase) * 0.14, a.rz + Math.sin(t * 0.5 + it.phase) * 0.05);
      } else {
        o.rotation.y = t * 0.4 + it.phase; o.rotation.z = Math.sin(t * 0.5 + it.phase) * 0.18;
      }
    });
    if (any) renderer.render(scene, camera); else renderer.clear();
    tiltCard();
  };

  if (reduce) {
    var pend = false, once = function () { if (!pend) { pend = true; requestAnimationFrame(function (tm) { pend = false; render(tm); }); } };
    window.addEventListener('scroll', once, { passive: true }); window.addEventListener('resize', once); once();
  } else {
    var loop = function (tm) { if (!document.hidden) render(tm); requestAnimationFrame(loop); };
    render(performance.now());
    requestAnimationFrame(loop);
  }
})();
