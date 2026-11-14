<?php
// Základná konfigurácia webu Rofa Painting
const SITE_NAME   = 'Rofa Painting';
const SITE_PHONE  = '0948 708 703';
const SITE_PHONE_E164 = '+421948708703';
const SITE_EMAIL  = 'info@rofapainting.sk';
const SITE_URL    = 'https://www.rofapainting.sk'; // zmeňte podľa skutočnej domény
const MAIL_TO     = 'info@rofapainting.sk';
// Odosielateľ musí byť adresa z vašej domény (Websupport to vyžaduje), inak mail nedoručí.
const MAIL_FROM   = 'info@rofapainting.sk';

$services = [
    'interierove-malby' => [
        'title' => 'Interiérové maľby',
        'short' => 'Stropy, steny, byty, domy a novostavby.',
        'icon'  => 'roller',
        'img'   => 'photo-interier.jpg',
        'lead'  => 'Čisté, rovnomerné a odolné maľby, ktoré dajú vášmu interiéru nový život. Pracujeme v bytoch, rodinných domoch aj novostavbách.',
        'items' => ['Maľby stien a stropov', 'Byty, domy a novostavby', 'Prípravné práce a prekrytie priestoru', 'Oprava prasklín a nerovností', 'Základný náter a finálna povrchová úprava', 'Dôkladné upratanie po práci'],
        'steps' => ['Obhliadka a zameranie', 'Zakrytie podláh a nábytku', 'Príprava podkladu', 'Náter v potrebnom počte vrstiev', 'Upratanie a odovzdanie'],
        'meta'  => 'Profesionálne interiérové maľby stien a stropov v bytoch, domoch a novostavbách. Čisto, rýchlo a spoľahlivo.',
    ],
    'exterierove-malby' => [
        'title' => 'Exteriérové maľby',
        'short' => 'Fasády, sokle, ploty, brány a altánky.',
        'icon'  => 'house',
        'img'   => 'photo-exterier.jpg',
        'lead'  => 'Fasáda je vizitka domu. Natrieme ju tak, aby vyzerala skvele a vydržala poveternostným vplyvom.',
        'items' => ['Fasády rodinných domov', 'Sokle a obklady', 'Ploty a brány', 'Altánky, pergoly a drevené prvky', 'Penetrácia a príprava podkladu', 'Ochranné a dekoratívne nátery'],
        'steps' => ['Obhliadka a výber farby', 'Očistenie a príprava povrchu', 'Penetrácia a opravy', 'Finálny náter', 'Kontrola a odovzdanie'],
        'meta'  => 'Exteriérové maľby fasád, soklov, plotov, brán a altánkov. Kvalitné nátery odolné voči počasiu.',
    ],
    'dekorativne-stierky' => [
        'title' => 'Dekoratívne stierky',
        'short' => 'Travertino, Beton Look, Limewash a ďalšie moderné efekty.',
        'icon'  => 'texture',
        'img'   => 'photo-dekor.jpg',
        'lead'  => 'Moderné povrchy, ktoré z obyčajnej steny urobia dominantu miestnosti. Každá plocha je originál.',
        'items' => ['Travertino', 'Beton Look', 'Limewash', 'Ďalšie moderné dekoratívne efekty', 'Obývacie izby, kuchyne, kúpeľne, komerčné priestory', 'Povrchová ochrana pre dlhú životnosť'],
        'steps' => ['Konzultácia a výber štruktúry', 'Vzorka na ukážku', 'Príprava podkladu', 'Aplikácia stierky a efektu', 'Ochranná povrchová úprava'],
        'meta'  => 'Dekoratívne stierky Travertino, Beton Look, Limewash a ďalšie moderné efekty pre váš interiér.',
    ],
    'sadrokarton-omietky' => [
        'title' => 'Sadrokartón a omietky',
        'short' => 'Precízne spracovanie, rovné steny.',
        'icon'  => 'layers',
        'img'   => 'photo-sadrokarton.jpg',
        'lead'  => 'Rovné steny a hladké stropy sú základom každej peknej maľby. Postaráme sa o precízne spracovanie od podkladu po finálny povrch.',
        'items' => ['Sadrokartónové konštrukcie a opravy', 'Tmelenie a brúsenie', 'Vnútorné omietky', 'Vyrovnanie stien a stropov', 'Príprava pod maľbu alebo dekoratívnu stierku', 'Hladký a rovný finálny povrch'],
        'steps' => ['Obhliadka a posúdenie podkladu', 'Montáž alebo oprava', 'Tmelenie a omietanie', 'Brúsenie a kontrola rovinnosti', 'Príprava na finálnu úpravu'],
        'meta'  => 'Sadrokartón, tmelenie a omietky s precíznym spracovaním. Rovné steny a hladké povrchy pod maľbu.',
    ],
    'airless-malovanie' => [
        'title' => 'Airless maľovanie',
        'short' => 'Rýchlo, rovnomerne, profesionálne.',
        'icon'  => 'spray',
        'img'   => 'photo-airless.jpg',
        'lead'  => 'Bezvzduchové striekanie farby šetrí čas a dáva dokonale rovnomerný výsledok aj na veľkých plochách.',
        'items' => ['Rýchle pokrytie veľkých plôch', 'Rovnomerný náter bez stôp', 'Novostavby a rozsiahle priestory', 'Stropy, steny, fasády', 'Dôkladné maskovanie a ochrana okolia', 'Úspora času a materiálu'],
        'steps' => ['Obhliadka a výber technológie', 'Maskovanie a ochrana priestoru', 'Príprava farby a stroja', 'Striekanie', 'Odkrytie a upratanie'],
        'meta'  => 'Airless maľovanie – rýchle, rovnomerné a profesionálne striekanie farby veľkých plôch.',
    ],
];

const SOCIAL_FB = 'https://www.facebook.com/profile.php?id=61579037782886&locale=sk_SK';
const SOCIAL_IG = 'https://www.instagram.com/rofapainting/';
const SLOGAN    = 'Farbu meníme na štýl.';
$cities = ['Košice', 'Michalovce', 'Trebišov'];

// Odkaz na vaše Google hodnotenia (vložte, keď budete mať Google Business profil)
const GOOGLE_REVIEWS_URL = '';

// Orientačné ceny pre kalkulačku (€ za m², od – do). UPRAVTE podľa vašich skutočných cien.
$calc = [
    'interierove-malby'   => ['min' => 3.5,  'max' => 6.0],
    'exterierove-malby'   => ['min' => 8.0,  'max' => 14.0],
    'dekorativne-stierky' => ['min' => 18.0, 'max' => 35.0],
    'sadrokarton-omietky' => ['min' => 12.0, 'max' => 22.0],
    'airless-malovanie'   => ['min' => 2.5,  'max' => 4.5],
];
// Násobok ceny podľa stavu povrchu
$calcCondition = [
    ['label' => 'Dobrý stav (stačí natrieť)',          'k' => 1.0],
    ['label' => 'Drobné opravy (praskliny, škvrny)',   'k' => 1.25],
    ['label' => 'Rozsiahle opravy / nerovný podklad',  'k' => 1.5],
];
// Typ priestoru (len informatívne, ide do dopytu)
$calcSpace = ['Byt', 'Rodinný dom', 'Novostavba', 'Komerčný priestor'];
// Doplnkové práce. type: 'm2' = € za m², 'flat' = paušál €, 'pct' = % z ceny. UPRAVTE podľa vašich cien.
$calcExtras = [
    ['key' => 'cover',    'icon' => 'shield',  'label' => 'Zakrytie a ochrana',        'desc' => 'Fólie, lepiace pásky, ochrana nábytku a podláh', 'type' => 'flat', 'min' => 30,  'max' => 60],
    ['key' => 'strip',    'icon' => 'layers',  'label' => 'Odstránenie starého náteru', 'desc' => 'Zoškrabanie starej farby alebo tapety',       'type' => 'm2',   'min' => 1.2, 'max' => 2.2],
    ['key' => 'primer',   'icon' => 'texture', 'label' => 'Penetrácia podkladu',        'desc' => 'Lepšia priľnavosť a vyššia výdrž náteru',     'type' => 'm2',   'min' => 0.5, 'max' => 0.9],
    ['key' => 'material', 'icon' => 'roller',  'label' => 'Materiál od nás',           'desc' => 'Farbu aj pomôcky zabezpečíme my',            'type' => 'm2',   'min' => 0.8, 'max' => 1.5],
    ['key' => 'height',   'icon' => 'house',   'label' => 'Práca vo výške',            'desc' => 'Vysoké stropy, schodiská, lešenie',          'type' => 'pct',  'min' => 10,  'max' => 20],
];
// Príplatok za urgentný termín (%)
$calcUrgent = ['min' => 10, 'max' => 20];
// Najnižšia cena zákazky (€) – kalkulačka ju nepodlezie
const CALC_MIN_ORDER = 80;

// Najčastejšie otázky (zobrazia sa na podstránkach služieb)
$faq = [
    'interierove-malby' => [
        ['Musím pred maľovaním vyprázdniť miestnosť?', 'Nie nutne. Nábytok odsunieme do stredu a zakryjeme fóliou. Menšie predmety a obrazy je dobré odložiť vopred.'],
        ['Kto zabezpečí farbu a materiál?', 'Vieme zabezpečiť materiál aj pracovať s farbou, ktorú si vyberiete sami. Dohodneme to pri obhliadke.'],
        ['Ako dlho trvá maľba izby?', 'Závisí od veľkosti a stavu stien. Presný termín vám povieme po obhliadke.'],
    ],
    'exterierove-malby' => [
        ['Kedy je najlepšie natierať fasádu?', 'Ideálne v suchom a teplom období, keď nehrozí dážď ani mráz. Termín prispôsobíme počasiu.'],
        ['Treba fasádu pred náterom čistiť?', 'Áno, podklad vždy očistíme a podľa potreby opravíme a napenetrujeme, aby náter dobre držal.'],
        ['Natierate aj ploty a brány?', 'Áno, natierame ploty, brány, altánky aj drevené prvky.'],
    ],
    'dekorativne-stierky' => [
        ['Môžem si pozrieť vzorku pred realizáciou?', 'Áno, vieme pripraviť ukážku štruktúry, aby ste vedeli, čo môžete očakávať.'],
        ['Kde sa dekoratívne stierky hodia?', 'Do obývačiek, kuchýň, kúpeľní, chodieb aj komerčných priestorov. Poradíme s výberom podľa miestnosti.'],
        ['Je povrch odolný?', 'Po aplikácii povrch chránime vhodnou finálnou úpravou, aby dlho vydržal a dalo sa ho udržiavať.'],
    ],
    'sadrokarton-omietky' => [
        ['Pripravíte steny aj pod maľbu?', 'Áno, po tmelení a brúsení steny rovno natrieme alebo ich pripravíme na dekoratívnu stierku.'],
        ['Opravujete aj poškodené sadrokartóny?', 'Áno, opravíme prasklinky, diery aj nerovnosti a povrch zjednotíme.'],
        ['Je pri brúsení veľa prachu?', 'Priestor zakryjeme a po práci dôkladne upracieme.'],
    ],
    'airless-malovanie' => [
        ['Prečo airless a nie valček?', 'Na veľkých plochách je striekanie rýchlejšie a výsledok je rovnomerný bez stôp po valčeku.'],
        ['Musí byť priestor prázdny?', 'Čím menej vecí v priestore, tým lepšie. Všetko ostatné starostlivo zamaskujeme.'],
        ['Hodí sa to do bytu?', 'Áno, najmä pri novostavbách a väčších priestoroch. Poradíme, či je to vo vašom prípade vhodné.'],
    ],
];

function e(string $s): string { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }

function icon(string $name, string $class = 'ico'): string {
    $paths = [
        'roller'  => '<path d="M5 3h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z"/><path d="M19 6h2v5a2 2 0 0 1-2 2h-6v3"/><rect x="11" y="16" width="4" height="5" rx="1"/>',
        'house'   => '<path d="m3 11 9-8 9 8"/><path d="M5 10v10h14V10"/><path d="M10 20v-6h4v6"/>',
        'texture' => '<rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9c3-2 6 2 9 0s6-2 9 0M3 15c3-2 6 2 9 0s6-2 9 0"/>',
        'layers'  => '<path d="m12 3 9 5-9 5-9-5 9-5Z"/><path d="m3 13 9 5 9-5"/>',
        'spray'   => '<path d="M4 8h8l2 3v4H8l-1 5H4z"/><path d="M16 7h.01M19 5h.01M19 9h.01M22 7h.01"/>',
        'phone'   => '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2Z"/>',
        'mail'    => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>',
        'check'   => '<path d="m5 12 5 5 9-10"/>',
        'facebook'  => '<path d="M14 8h3V4h-3a4 4 0 0 0-4 4v3H7v4h3v6h4v-6h3l1-4h-4V8.5a.5.5 0 0 1 .5-.5Z"/>',
        'instagram' => '<rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><path d="M17.5 6.5h.01"/>',
        'star'      => '<path d="m12 2 3 7 7.5.6-5.7 4.9 1.8 7.4L12 18l-6.6 3.9 1.8-7.4L1.5 9.6 9 9z"/>',
        'calc'      => '<rect x="5" y="3" width="14" height="18" rx="2"/><path d="M8 7h8M8 12h.01M12 12h.01M16 12h.01M8 16h.01M12 16h.01M16 16h.01"/>',
        'chevron' => '<path d="m6 9 6 6 6-6"/>',
        'arrow'   => '<path d="M5 12h14M13 6l6 6-6 6"/>',
        'clock'   => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
        'sparkle' => '<path d="M12 3v4M12 17v4M3 12h4M17 12h4M6 6l2.5 2.5M15.5 15.5 18 18M18 6l-2.5 2.5M8.5 15.5 6 18"/>',
        'shield'  => '<path d="M12 3 4 6v6c0 5 3.5 8 8 9 4.5-1 8-4 8-9V6l-8-3Z"/><path d="m9 12 2 2 4-4"/>',
        'play'    => '<path d="M8 5v14l11-7z"/>',
        'menu'    => '<path d="M4 7h16M4 12h16M4 17h16"/>',
        'close'   => '<path d="M6 6l12 12M18 6 6 18"/>',
        'pin'     => '<path d="M12 21s7-6 7-12a7 7 0 0 0-14 0c0 6 7 12 7 12Z"/><circle cx="12" cy="9" r="2.5"/>',
    ];
    $p = $paths[$name] ?? '';
    return '<svg class="' . e($class) . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $p . '</svg>';
}
