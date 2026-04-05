@php use Illuminate\Support\Str; @endphp
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kategori Produk - Faizal Motor 139</title>
  <meta name="description" content="Lihat semua produk custom lampu motor dari Faizal Motor 139. Filter berdasarkan brand dan model motor.">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <style>
    /* ========== RESET & BASE ========== */
    * { margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',sans-serif; }

    :root {
      --ice-50:#f0f9ff; --ice-100:#e0f2fe; --ice-200:#bae6fd; --ice-300:#7dd3fc;
      --ice-400:#38bdf8; --ice-500:#0ea5e9; --ice-600:#0284c7; --ice-700:#0369a1;
      --navy-800:#0c4a6e; --navy-900:#0f172a; --navy-950:#020617;
      --frost-white:rgba(255,255,255,0.85); --frost-border:rgba(255,255,255,0.3);
      --shadow-ice:rgba(14,165,233,0.15); --shadow-dark:rgba(15,23,42,0.08);
    }

    body {
      color:#1e293b; padding-top:70px; overflow-x:hidden; min-height:100vh;
      background: var(--ice-50);
      background-image:
        radial-gradient(ellipse 80% 50% at 20% 60%, rgba(56,189,248,0.07) 0%, transparent 70%),
        radial-gradient(ellipse 60% 40% at 80% 30%, rgba(14,165,233,0.05) 0%, transparent 70%),
        radial-gradient(ellipse 50% 50% at 50% 100%, rgba(3,105,161,0.04) 0%, transparent 60%);
      background-attachment: fixed;
    }

    /* ========== LOADING SCREEN ========== */
    .loading-screen {
      position:fixed; top:0; left:0; width:100%; height:100%; z-index:9999;
      background: linear-gradient(135deg, var(--navy-950) 0%, var(--navy-900) 50%, var(--navy-800) 100%);
      display:flex; flex-direction:column; align-items:center; justify-content:center;
      transition: opacity 0.5s ease, visibility 0.5s ease;
    }
    .loading-screen.hide { opacity:0; visibility:hidden; pointer-events:none; }

    .loader-bulb {
      width:80px; height:80px; position:relative; margin-bottom:28px;
    }
    /* Bulb body */
    .loader-bulb .bulb {
      width:50px; height:50px; border-radius:50% 50% 45% 45%;
      background: radial-gradient(circle at 40% 35%, #fff 0%, var(--ice-300) 30%, var(--ice-500) 70%, var(--ice-700) 100%);
      position:absolute; top:0; left:50%; transform:translateX(-50%);
      box-shadow: 0 0 20px var(--ice-400), 0 0 60px rgba(56,189,248,0.4), 0 0 100px rgba(56,189,248,0.2);
      animation: glowPulse 1.5s ease-in-out infinite;
    }
    /* Bulb base */
    .loader-bulb .base {
      width:24px; height:14px; position:absolute; bottom:8px; left:50%; transform:translateX(-50%);
      background: repeating-linear-gradient(0deg, #94a3b8 0px, #94a3b8 3px, #64748b 3px, #64748b 5px);
      border-radius:0 0 6px 6px;
    }
    /* Light rays */
    .loader-bulb .ray {
      position:absolute; background:var(--ice-300); border-radius:2px; opacity:0;
      animation: rayShoot 1.5s ease-in-out infinite;
    }
    .loader-bulb .ray:nth-child(3){ width:2px; height:18px; top:-20px; left:50%; transform:translateX(-50%); animation-delay:0s; }
    .loader-bulb .ray:nth-child(4){ width:2px; height:14px; top:-14px; left:12px; transform:rotate(-35deg); animation-delay:0.15s; }
    .loader-bulb .ray:nth-child(5){ width:2px; height:14px; top:-14px; right:12px; transform:rotate(35deg); animation-delay:0.3s; }
    .loader-bulb .ray:nth-child(6){ width:14px; height:2px; top:20px; left:-16px; animation-delay:0.45s; }
    .loader-bulb .ray:nth-child(7){ width:14px; height:2px; top:20px; right:-16px; animation-delay:0.6s; }

    @keyframes glowPulse {
      0%,100% { box-shadow: 0 0 20px var(--ice-400), 0 0 40px rgba(56,189,248,0.3); }
      50% { box-shadow: 0 0 30px var(--ice-300), 0 0 80px rgba(56,189,248,0.5), 0 0 120px rgba(56,189,248,0.2); }
    }
    @keyframes rayShoot {
      0%,100% { opacity:0; transform-origin:center; }
      30%,70% { opacity:0.8; }
    }

    .loading-text {
      color:var(--ice-200); font-size:14px; font-weight:500; letter-spacing:2px; text-transform:uppercase;
    }
    .loading-text span {
      display:inline-block; animation: typeBlink 1.5s steps(3) infinite;
    }
    @keyframes typeBlink { 0%{opacity:0} 50%{opacity:1} 100%{opacity:0} }

    .loading-bar {
      width:180px; height:3px; background:rgba(255,255,255,0.1); border-radius:3px;
      margin-top:16px; overflow:hidden;
    }
    .loading-bar .fill {
      width:0; height:100%; background:linear-gradient(90deg,var(--ice-400),var(--ice-300),var(--ice-400));
      border-radius:3px; animation: barFill 1.8s ease-in-out infinite;
    }
    @keyframes barFill { 0%{width:0;margin-left:0} 50%{width:60%} 100%{width:0;margin-left:100%} }

    /* ========== NAVBAR ========== */
    .navbar {
      height:70px; position:fixed; top:0; width:100%;
      background:linear-gradient(90deg,var(--navy-900),var(--navy-950));
      backdrop-filter:blur(10px); display:flex; align-items:center;
      justify-content:space-between; padding:0 40px; z-index:999; transition:top .3s ease;
    }
    .navbar .left { display:flex; align-items:center; gap:10px; }
    .navbar .left img { height:40px; }
    .navbar .left h1 { font-size:18px; color:#fff; font-weight:700; }
    .navbar ul { display:flex; gap:25px; list-style:none; }
    .navbar a { color:rgba(255,255,255,.8); text-decoration:none; font-weight:500; font-size:15px; transition:color .3s; position:relative; }
    .navbar a:hover, .navbar a.active { color:var(--ice-300); }
    .navbar a.active::after {
      content:''; position:absolute; bottom:-5px; left:0; width:100%; height:2px;
      background:var(--ice-400); border-radius:2px;
    }

    /* ========== HERO BANNER ========== */
    .page-hero {
      background: linear-gradient(135deg, var(--navy-900) 0%, var(--navy-800) 40%, var(--ice-600) 100%);
      padding:60px 40px 50px; position:relative; overflow:hidden;
    }
    .page-hero::before {
      content:''; position:absolute; top:-50%; right:-20%; width:600px; height:600px;
      background:radial-gradient(circle,rgba(56,189,248,.2) 0%,transparent 70%);
      border-radius:50%; animation:float 8s ease-in-out infinite;
    }
    .page-hero::after {
      content:''; position:absolute; bottom:-30%; left:-10%; width:400px; height:400px;
      background:radial-gradient(circle,rgba(125,211,252,.15) 0%,transparent 70%);
      border-radius:50%; animation:float 6s ease-in-out infinite reverse;
    }

    /* Floating particles in hero */
    .particle {
      position:absolute; border-radius:50%; pointer-events:none;
      background:rgba(56,189,248,.3); animation:particleFloat linear infinite;
    }

    @keyframes float { 0%,100%{transform:translateY(0) scale(1)} 50%{transform:translateY(-20px) scale(1.05)} }
    @keyframes particleFloat {
      0%{transform:translateY(0) translateX(0); opacity:0}
      10%{opacity:1}
      90%{opacity:1}
      100%{transform:translateY(-200px) translateX(30px); opacity:0}
    }

    .page-hero h1 { color:#fff; font-size:36px; font-weight:800; position:relative; z-index:2; margin-bottom:8px; }
    .page-hero h1 span {
      background:linear-gradient(90deg,var(--ice-300),var(--ice-200));
      -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
    }
    .page-hero p { color:var(--ice-200); font-size:16px; font-weight:300; position:relative; z-index:2; }

    .breadcrumb { display:flex; gap:8px; align-items:center; margin-bottom:16px; position:relative; z-index:2; }
    .breadcrumb a { color:var(--ice-300); text-decoration:none; font-size:14px; transition:color .3s; }
    .breadcrumb a:hover { color:#fff; }
    .breadcrumb span { color:var(--ice-400); font-size:14px; }
    .breadcrumb .current { color:rgba(255,255,255,.6); font-size:14px; }

    /* ========== FILTER SECTION ========== */
    .filter-section { max-width:1280px; margin:-30px auto 0; padding:0 24px; position:relative; z-index:10; }
    .filter-card {
      background:var(--frost-white); backdrop-filter:blur(20px);
      border:1px solid var(--frost-border); border-radius:20px; padding:28px 32px;
      box-shadow:0 8px 32px var(--shadow-ice), 0 2px 8px var(--shadow-dark);
    }
    .filter-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:20px; }
    .filter-header h3 { font-size:16px; font-weight:600; color:var(--navy-900); display:flex; align-items:center; gap:8px; }
    .filter-header h3 .icon {
      background:linear-gradient(135deg,var(--ice-400),var(--ice-600)); color:#fff;
      width:32px; height:32px; border-radius:10px; display:flex; align-items:center;
      justify-content:center; font-size:16px;
    }
    .filter-reset {
      color:var(--ice-500); text-decoration:none; font-size:13px; font-weight:500;
      padding:6px 14px; border-radius:20px; border:1px solid var(--ice-200); transition:all .3s;
    }
    .filter-reset:hover { background:var(--ice-500); color:#fff; border-color:var(--ice-500); }

    .filter-group { margin-bottom:16px; }
    .filter-group:last-child { margin-bottom:0; }
    .filter-label { font-size:13px; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:.5px; margin-bottom:10px; display:block; }
    .filter-chips { display:flex; gap:8px; flex-wrap:wrap; }

    .chip {
      padding:8px 18px; border-radius:50px; border:1.5px solid var(--ice-200);
      background:#fff; color:#475569; font-size:13px; font-weight:500;
      text-decoration:none; transition:all .3s ease; cursor:pointer;
    }
    .chip:hover { border-color:var(--ice-400); color:var(--ice-600); background:var(--ice-50); transform:translateY(-2px); box-shadow:0 4px 12px var(--shadow-ice); }
    .chip.active { background:linear-gradient(135deg,var(--ice-400),var(--ice-600)); color:#fff; border-color:transparent; box-shadow:0 4px 16px rgba(14,165,233,.35); }

    .filter-row { display:flex; gap:24px; align-items:flex-start; flex-wrap:wrap; }
    .filter-col { flex:1; min-width:200px; }

    .sort-select {
      padding:10px 16px; border-radius:12px; border:1.5px solid var(--ice-200);
      background:#fff; color:#475569; font-size:13px; font-weight:500;
      font-family:'Poppins',sans-serif; cursor:pointer; outline:none; transition:all .3s;
      min-width:180px; appearance:none;
      background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%2364748b' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
      background-repeat:no-repeat; background-position:right 14px center; padding-right:36px;
    }
    .sort-select:focus { border-color:var(--ice-400); box-shadow:0 0 0 3px rgba(56,189,248,.15); }

    /* ========== RESULTS BAR ========== */
    .results-bar { max-width:1280px; margin:28px auto 0; padding:0 24px; display:flex; align-items:center; justify-content:space-between; }
    .results-count { font-size:14px; color:#64748b; font-weight:500; }
    .results-count strong { color:var(--navy-900); font-weight:700; }

    /* ========== PRODUCT GRID ========== */
    .products-section { max-width:1280px; margin:20px auto 0; padding:0 24px; }
    .product-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:24px; }

    .product-card {
      background:#fff; border-radius:18px; overflow:hidden;
      transition:all .4s cubic-bezier(.175,.885,.32,1.275);
      border:1px solid rgba(0,0,0,.04); position:relative;
      opacity:0; transform:translateY(30px);
    }
    .product-card.visible { opacity:1; transform:translateY(0); }
    .product-card:hover { transform:translateY(-8px); box-shadow:0 20px 40px rgba(14,165,233,.15),0 8px 16px rgba(0,0,0,.06); }

    .product-card .image-wrapper {
      position:relative; overflow:hidden; height:220px;
      background:linear-gradient(135deg,var(--ice-50),var(--ice-100));
    }
    .product-card .image-wrapper img { width:100%; height:100%; object-fit:cover; transition:transform .5s ease; }
    .product-card:hover .image-wrapper img { transform:scale(1.08); }
    .product-card .image-wrapper .badge-overlay {
      position:absolute; top:14px; left:14px;
      background:linear-gradient(135deg,var(--ice-400),var(--ice-600)); color:#fff;
      padding:5px 12px; border-radius:20px; font-size:11px; font-weight:600; letter-spacing:.3px;
      box-shadow:0 4px 12px rgba(14,165,233,.3);
    }

    .product-card .card-body { padding:20px; }
    .product-card .motor-tag {
      display:inline-flex; align-items:center; gap:4px; background:var(--ice-50);
      color:var(--ice-700); padding:4px 10px; border-radius:6px; font-size:11px;
      font-weight:600; margin-bottom:10px; border:1px solid var(--ice-100);
    }
    .product-card h3 {
      font-size:16px; font-weight:700; color:var(--navy-900); margin-bottom:6px; line-height:1.4;
      display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;
    }
    .product-card .description {
      font-size:13px; color:#94a3b8; margin-bottom:16px;
      display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; line-height:1.6;
    }
    .product-card .card-footer {
      display:flex; align-items:center; justify-content:space-between;
      padding-top:14px; border-top:1px solid #f1f5f9;
    }
    .product-card .price {
      font-size:18px; font-weight:800;
      background:linear-gradient(135deg,var(--ice-500),var(--ice-700));
      -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
    }

    .btn-detail {
      display:inline-flex; align-items:center; gap:4px; padding:8px 16px;
      background:linear-gradient(135deg,var(--ice-400),var(--ice-500)); color:#fff;
      border-radius:10px; text-decoration:none; font-size:12px; font-weight:600;
      transition:all .3s; box-shadow:0 2px 8px rgba(14,165,233,.2);
    }
    .btn-detail:hover { background:linear-gradient(135deg,var(--ice-500),var(--ice-600)); box-shadow:0 4px 16px rgba(14,165,233,.35); transform:translateY(-1px); }

    .btn-wa {
      display:flex; align-items:center; justify-content:center; gap:8px;
      margin-top:14px; padding:10px 16px;
      background:linear-gradient(135deg,#22c55e,#16a34a); color:#fff;
      border-radius:12px; text-decoration:none; font-size:13px; font-weight:600;
      transition:all .3s; box-shadow:0 2px 8px rgba(34,197,94,.25);
    }
    .btn-wa:hover { background:linear-gradient(135deg,#16a34a,#15803d); box-shadow:0 6px 20px rgba(34,197,94,.35); transform:translateY(-2px); }

    /* ========== CTA - Tanya Admin ========== */
    .cta-section {
      max-width:1280px; margin:48px auto 60px; padding:0 24px;
    }
    .cta-card {
      background: linear-gradient(135deg, var(--navy-900) 0%, var(--navy-800) 50%, var(--ice-700) 100%);
      border-radius:24px; padding:48px 40px; position:relative; overflow:hidden;
      display:flex; align-items:center; gap:40px; flex-wrap:wrap;
    }
    .cta-card::before {
      content:''; position:absolute; top:-40%; right:-10%; width:400px; height:400px;
      background:radial-gradient(circle,rgba(56,189,248,.15) 0%,transparent 70%);
      border-radius:50%; animation:float 10s ease-in-out infinite;
    }
    .cta-card::after {
      content:''; position:absolute; bottom:-50%; left:10%; width:300px; height:300px;
      background:radial-gradient(circle,rgba(125,211,252,.1) 0%,transparent 70%);
      border-radius:50%; animation:float 7s ease-in-out infinite reverse;
    }
    .cta-icon {
      font-size:56px; width:100px; height:100px; display:flex; align-items:center; justify-content:center;
      background:rgba(255,255,255,.08); border-radius:24px; border:1px solid rgba(255,255,255,.1);
      flex-shrink:0; position:relative; z-index:2;
    }
    .cta-content { flex:1; min-width:240px; position:relative; z-index:2; }
    .cta-content h2 { color:#fff; font-size:24px; font-weight:700; margin-bottom:8px; }
    .cta-content p { color:var(--ice-200); font-size:15px; line-height:1.7; margin-bottom:20px; }
    .cta-buttons { display:flex; gap:12px; flex-wrap:wrap; }
    .cta-btn-wa {
      display:inline-flex; align-items:center; gap:8px; padding:14px 28px;
      background:linear-gradient(135deg,#22c55e,#16a34a); color:#fff; border-radius:14px;
      text-decoration:none; font-size:14px; font-weight:600; transition:all .3s;
      box-shadow:0 4px 16px rgba(34,197,94,.3);
    }
    .cta-btn-wa:hover { box-shadow:0 8px 28px rgba(34,197,94,.45); transform:translateY(-2px); }
    .cta-btn-wa2 {
      display:inline-flex; align-items:center; gap:8px; padding:14px 28px;
      background:rgba(255,255,255,.08); color:#fff; border-radius:14px;
      text-decoration:none; font-size:14px; font-weight:600; transition:all .3s;
      border:1px solid rgba(255,255,255,.15);
    }
    .cta-btn-wa2:hover { background:rgba(255,255,255,.15); transform:translateY(-2px); }

    /* ========== EMPTY STATE ========== */
    .empty-state { text-align:center; padding:80px 20px; grid-column:1/-1; }
    .empty-state .empty-icon { font-size:64px; margin-bottom:16px; opacity:.6; }
    .empty-state h3 { font-size:20px; color:var(--navy-900); margin-bottom:8px; }
    .empty-state p { color:#94a3b8; font-size:14px; margin-bottom:20px; }
    .empty-state .empty-actions { display:flex; gap:12px; justify-content:center; flex-wrap:wrap; }
    .empty-state .btn-all {
      display:inline-block; padding:10px 24px;
      background:linear-gradient(135deg,var(--ice-400),var(--ice-600)); color:#fff;
      border-radius:12px; text-decoration:none; font-weight:600; font-size:14px; transition:all .3s;
    }
    .empty-state .btn-all:hover { box-shadow:0 6px 20px rgba(14,165,233,.35); transform:translateY(-2px); }
    .empty-state .btn-ask {
      display:inline-flex; align-items:center; gap:6px; padding:10px 24px;
      background:linear-gradient(135deg,#22c55e,#16a34a); color:#fff;
      border-radius:12px; text-decoration:none; font-weight:600; font-size:14px; transition:all .3s;
    }
    .empty-state .btn-ask:hover { box-shadow:0 6px 20px rgba(34,197,94,.35); transform:translateY(-2px); }

    /* ========== FOOTER ========== */
    .footer {
      background:linear-gradient(90deg,var(--navy-900),var(--navy-950));
      color:#fff; text-align:center; padding:30px 20px; font-size:14px;
    }
    .footer span { color:var(--ice-400); font-weight:600; }

    /* ========== FLOATING WA BUTTON ========== */
    .float-wa {
      position:fixed; bottom:28px; right:28px; z-index:900;
      width:60px; height:60px; border-radius:50%;
      background:linear-gradient(135deg,#22c55e,#16a34a); color:#fff;
      display:flex; align-items:center; justify-content:center;
      font-size:28px; text-decoration:none; transition:all .3s;
      box-shadow:0 6px 24px rgba(34,197,94,.4);
      animation: bounceIn 0.6s ease forwards;
    }
    .float-wa:hover { transform:scale(1.1) translateY(-4px); box-shadow:0 10px 32px rgba(34,197,94,.5); }
    .float-wa .tooltip {
      position:absolute; right:72px; top:50%; transform:translateY(-50%);
      background:var(--navy-900); color:#fff; padding:8px 14px; border-radius:10px;
      font-size:12px; font-weight:500; white-space:nowrap;
      opacity:0; transition:opacity .3s; pointer-events:none;
    }
    .float-wa .tooltip::after {
      content:''; position:absolute; right:-6px; top:50%; transform:translateY(-50%);
      border:6px solid transparent; border-left-color:var(--navy-900);
    }
    .float-wa:hover .tooltip { opacity:1; }

    @keyframes bounceIn {
      0%{ transform:scale(0); opacity:0; }
      60%{ transform:scale(1.15); opacity:1; }
      100%{ transform:scale(1); }
    }

    /* ========== BG DECORATIONS ========== */
    .bg-orb {
      position:fixed; border-radius:50%; pointer-events:none; z-index:0;
      filter:blur(60px); opacity:.4;
    }
    .bg-orb-1 { width:300px; height:300px; top:20%; left:-80px; background:rgba(56,189,248,.08); animation:orbDrift 20s ease-in-out infinite; }
    .bg-orb-2 { width:250px; height:250px; top:60%; right:-60px; background:rgba(14,165,233,.06); animation:orbDrift 15s ease-in-out infinite reverse; }
    .bg-orb-3 { width:200px; height:200px; bottom:10%; left:30%; background:rgba(3,105,161,.05); animation:orbDrift 18s ease-in-out infinite 3s; }

    @keyframes orbDrift {
      0%,100%{ transform:translate(0,0) scale(1); }
      33%{ transform:translate(30px,-40px) scale(1.1); }
      66%{ transform:translate(-20px,30px) scale(.95); }
    }

    /* ========== RESPONSIVE ========== */
    @media(max-width:768px){
      .navbar { padding:0 20px; }
      .navbar .left h1 { font-size:15px; }
      .navbar ul { gap:15px; }
      .navbar a { font-size:13px; }
      .page-hero { padding:40px 20px; }
      .page-hero h1 { font-size:24px; }
      .page-hero p { font-size:14px; }
      .filter-section { padding:0 16px; }
      .filter-card { padding:20px; }
      .filter-row { flex-direction:column; gap:16px; }
      .products-section { padding:0 16px; }
      .product-grid { grid-template-columns:repeat(auto-fill,minmax(240px,1fr)); gap:16px; }
      .product-card .image-wrapper { height:180px; }
      .results-bar { padding:0 16px; flex-direction:column; gap:8px; align-items:flex-start; }
      .cta-section { padding:0 16px; }
      .cta-card { padding:32px 24px; gap:24px; }
      .cta-icon { width:72px; height:72px; font-size:40px; }
      .cta-content h2 { font-size:20px; }
      .float-wa { bottom:20px; right:20px; width:52px; height:52px; font-size:24px; }
    }
    @media(max-width:480px){
      .product-grid { grid-template-columns:1fr; }
      .page-hero h1 { font-size:22px; }
      .cta-buttons { flex-direction:column; }
    }
  </style>
</head>

<body>

<!-- LOADING SCREEN -->
<div class="loading-screen" id="loadingScreen">
  <div class="loader-bulb">
    <div class="bulb"></div>
    <div class="base"></div>
    <div class="ray"></div>
    <div class="ray"></div>
    <div class="ray"></div>
    <div class="ray"></div>
    <div class="ray"></div>
  </div>
  <div class="loading-text">Memuat Produk <span>...</span></div>
  <div class="loading-bar"><div class="fill"></div></div>
</div>

<!-- BG DECORATIONS -->
<div class="bg-orb bg-orb-1"></div>
<div class="bg-orb bg-orb-2"></div>
<div class="bg-orb bg-orb-3"></div>

<!-- NAVBAR -->
<div class="navbar" id="navbar">
  <div class="left">
    <img src="{{ asset('img/faizalmotor_logo.png') }}" alt="Logo">
    <h1>Faizal Motor 139</h1>
  </div>
  <ul>
    <li><a href="/">Beranda</a></li>
    <li><a href="/kategori" class="active">Kategori</a></li>
    <li><a href="#">Kontak</a></li>
  </ul>
</div>

<!-- HERO BANNER -->
<section class="page-hero" id="pageHero">
  <div class="breadcrumb">
    <a href="/">Beranda</a>
    <span>›</span>
    <span class="current">Kategori</span>
  </div>
  <h1>Temukan <span>Custom Lampu</span> Impianmu</h1>
  <p>Jelajahi koleksi lengkap custom lampu motor premium dari Faizal Motor 139</p>
</section>

<!-- FILTER -->
<section class="filter-section">
  <div class="filter-card">
    <div class="filter-header">
      <h3>
        <span class="icon">⚡</span>
        Filter Produk
      </h3>
      @if(request('brand') || request('model') || request('sort'))
        <a href="/kategori" class="filter-reset">✕ Reset Filter</a>
      @endif
    </div>

    <form method="GET" action="/kategori">
      <div class="filter-row">
        <!-- BRAND -->
        <div class="filter-col">
          <div class="filter-group">
            <span class="filter-label">🏍️ Brand Motor</span>
            <div class="filter-chips">
              @foreach($brands as $b)
                <a href="?brand={{ $b->name }}{{ request('model') ? '&model='.request('model') : '' }}{{ request('sort') ? '&sort='.request('sort') : '' }}"
                   class="chip {{ request('brand') == $b->name ? 'active' : '' }}">
                  {{ $b->name }}
                </a>
              @endforeach
            </div>
          </div>
        </div>

        <!-- MODEL -->
        <div class="filter-col">
          <div class="filter-group">
            <span class="filter-label">🔧 Model Motor</span>
            <div class="filter-chips">
              @foreach($models as $m)
                <a href="?model={{ $m->name }}{{ request('brand') ? '&brand='.request('brand') : '' }}{{ request('sort') ? '&sort='.request('sort') : '' }}"
                   class="chip {{ request('model') == $m->name ? 'active' : '' }}">
                  {{ $m->name }}
                </a>
              @endforeach
            </div>
          </div>
        </div>

        <!-- SORT -->
        <div class="filter-col" style="flex:0 0 auto;">
          <div class="filter-group">
            <span class="filter-label">💰 Urutkan Harga</span>
            <select name="sort" class="sort-select" onchange="
              let params = new URLSearchParams(window.location.search);
              params.set('sort', this.value);
              if (!this.value) params.delete('sort');
              window.location.href = '/kategori?' + params.toString();
            ">
              <option value="">Semua Harga</option>
              <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>⬆ Termurah</option>
              <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>⬇ Termahal</option>
            </select>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>

<!-- RESULTS BAR -->
<div class="results-bar">
  <p class="results-count">
    Menampilkan <strong>{{ $products->count() }}</strong> produk
    @if(request('brand'))
      untuk brand <strong>{{ request('brand') }}</strong>
    @endif
    @if(request('model'))
      model <strong>{{ request('model') }}</strong>
    @endif
  </p>
</div>

<!-- PRODUK -->
<section class="products-section">
  <div class="product-grid">

    @forelse($products as $p)
    <div class="product-card">
      <a href="/product/{{ $p->id }}-{{ Str::slug($p->name) }}" style="text-decoration:none; color:inherit;">
        <div class="image-wrapper">
          <img src="{{ asset('storage/' . $p->image) }}" alt="{{ $p->name }}">
          <div class="badge-overlay">⚡ Custom</div>
        </div>
        <div class="card-body">
          <div class="motor-tag">
            🏍️ {{ $p->model->brand->name ?? '-' }} — {{ $p->model->name ?? '-' }}
          </div>
          <h3>{{ $p->name }}</h3>
          <p class="description">{{ $p->description }}</p>
          <div class="card-footer">
            <div class="price">Rp {{ number_format($p->price, 0, ',', '.') }}</div>
            <span class="btn-detail">Lihat →</span>
          </div>
        </div>
      </a>
      <div style="padding:0 20px 20px;">
        <a href="https://wa.me/6281223466068?text={{ rawurlencode(
            "Halo kak, saya mau pesan {$p->name}\n" .
            "Motor: " . ($p->model->name ?? '-') . "\n" .
            "Harga: Rp " . number_format($p->price, 0, ',', '.') . "\n\n" .
            "Apakah masih tersedia?"
        ) }}"
           target="_blank" class="btn-wa">
          💬 Pesan via WhatsApp
        </a>
      </div>
    </div>
    @empty
    <div class="empty-state">
      <div class="empty-icon">🔍</div>
      <h3>Produk Tidak Ditemukan</h3>
      <p>Motor atau produk yang kamu cari belum tersedia di katalog kami.<br>Tapi jangan khawatir, hubungi admin untuk cek ketersediaan!</p>
      <div class="empty-actions">
        <a href="/kategori" class="btn-all">🔄 Lihat Semua Produk</a>
        <a href="https://wa.me/6281223466068?text={{ rawurlencode("Halo kak, saya ingin tanya apakah ada custom lampu untuk motor " . (request('model') ?? request('brand') ?? 'saya') . "? Terima kasih.") }}"
           target="_blank" class="btn-ask">
          💬 Tanya Admin via WhatsApp
        </a>
      </div>
    </div>
    @endforelse

  </div>
</section>

<!-- CTA - Tidak menemukan motor? -->
<section class="cta-section">
  <div class="cta-card">
    <div class="cta-icon">💡</div>
    <div class="cta-content">
      <h2>Tidak menemukan motor kamu?</h2>
      <p>
        Jangan khawatir! Kami bisa custom lampu untuk <strong>semua jenis motor</strong>.
        Hubungi admin kami langsung untuk konsultasi gratis dan tanyakan ketersediaan produk untuk motor kamu.
      </p>
      <div class="cta-buttons">
        <a href="https://wa.me/6281223466068?text={{ rawurlencode("Halo kak, saya mau tanya apakah bisa custom lampu untuk motor saya? Terima kasih.") }}"
           target="_blank" class="cta-btn-wa">
          💬 Chat Admin 1
        </a>
        <a href="https://wa.me/6281220660964?text={{ rawurlencode("Halo kak, saya mau tanya apakah bisa custom lampu untuk motor saya? Terima kasih.") }}"
           target="_blank" class="cta-btn-wa2">
          📱 Chat Admin 2
        </a>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer class="footer">
  <p>© 2026 <span>Faizal Motor 139</span> — Custom Lampu Motor Premium</p>
</footer>

<!-- FLOATING WA BUTTON -->
<a href="https://wa.me/6281223466068?text={{ rawurlencode("Halo kak, saya mau tanya tentang custom lampu motor.") }}"
   target="_blank" class="float-wa">
  💬
  <div class="tooltip">Chat Admin Sekarang!</div>
</a>

<!-- SCRIPT -->
<script>
  // Loading screen
  window.addEventListener('load', () => {
    setTimeout(() => {
      document.getElementById('loadingScreen').classList.add('hide');
    }, 1200);
  });

  // Hero particles
  const hero = document.getElementById('pageHero');
  for(let i = 0; i < 8; i++){
    const p = document.createElement('div');
    p.className = 'particle';
    const size = Math.random() * 4 + 2;
    p.style.width = size + 'px';
    p.style.height = size + 'px';
    p.style.left = Math.random() * 100 + '%';
    p.style.bottom = '0';
    p.style.animationDuration = (Math.random() * 4 + 4) + 's';
    p.style.animationDelay = (Math.random() * 5) + 's';
    hero.appendChild(p);
  }

  // Navbar auto-hide
  let prevScroll = window.pageYOffset;
  const navbar = document.getElementById('navbar');
  window.addEventListener('scroll', () => {
    const cur = window.pageYOffset;
    navbar.style.top = (prevScroll > cur) ? '0' : (cur > 100 ? '-80px' : '0');
    prevScroll = cur;
  });

  // Scroll-reveal for product cards
  const cards = document.querySelectorAll('.product-card');
  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry, i) => {
      if(entry.isIntersecting){
        setTimeout(() => entry.target.classList.add('visible'), i * 80);
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1 });
  cards.forEach(c => observer.observe(c));
</script>

</body>
</html>