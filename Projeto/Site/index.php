<?php
require __DIR__ . '/includes/config.php';

$pageTitle = 'LisAM, marketplace automóvel B2B';
$activeNav = 'inicio';
$bodyPage  = 'home';
$extraHead = '<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">';
$extraJsHtml = '<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>';

require __DIR__ . '/includes/header.php';
?>

<div class="hero">
  <span class="blob b1"></span><span class="blob b2"></span><span class="blob b3"></span>
  <div class="hero-inner">
    <div class="float f1"><span class="fe">🛑</span><div><b>Pastilhas de travão</b><small>120 € · Leiria Peças</small></div></div>
    <div class="float f2"><span class="fe ok">✓</span><div><b>Peça reservada</b><small>Levante hoje na loja</small></div></div>
    <div class="float f3"><span class="fe">🚚</span><div><b>Entrega em 30 km</b><small>No próprio dia</small></div></div>

    <div class="pill"><i></i> Entrega no próprio dia · Distrito de Leiria</div>
    <h1>A peça certa, do <em>parceiro certo</em>, hoje.</h1>
    <p class="lede">Peças usadas, recondicionadas e novas de três empresas do distrito de Leiria. Levante na loja ou receba na oficina no próprio dia.</p>
    <form class="procura" id="formProcura" onsubmit="return false">
      <input type="text" id="q" aria-label="Pesquisar" placeholder="Referência OEM, peça, marca ou categoria">
      <button class="btn btn-primary" type="submit">Procurar</button>
    </form>
    <div class="quick" id="quick"></div>
  </div>
  <div class="stats rv" id="stats"></div>
</div>

<div class="ticker"><div class="track" id="track"></div></div>

<main class="wrap">
  <section id="pecas">
    <div class="sec-head rv">
      <span class="eyebrow">Catálogo</span>
      <h2>Peças disponíveis</h2>
      <p id="pecasSub">Stock atualizado pelas próprias lojas.</p>
    </div>
    <div class="cats" id="cats"></div>
    <div class="toolbar">
      <div class="chips" id="chipsEstado"></div>
      <select id="ordem" aria-label="Ordenar">
        <option value="">Ordenar: relevância</option>
        <option value="asc">Preço: mais baixo</option>
        <option value="desc">Preço: mais alto</option>
      </select>
    </div>
    <div class="pecas" id="pecasGrid"></div>
  </section>

  <section id="como">
    <div class="sec-head rv">
      <span class="eyebrow">Como funciona</span>
      <h2>Da pesquisa à oficina em 3 passos</h2>
    </div>
    <div class="passos">
      <div class="passo rv"><span class="n">1</span><div class="pi">🔎</div><h3>Pesquise</h3><p>Procure por referência OEM, peça ou categoria em todo o stock dos parceiros.</p></div>
      <div class="passo rv"><span class="n">2</span><div class="pi">🛒</div><h3>Reserve</h3><p>Reserve a peça com um clique. A loja confirma a disponibilidade.</p></div>
      <div class="passo rv"><span class="n">3</span><div class="pi">🚚</div><h3>Levante ou receba</h3><p>Levante na loja mais próxima ou receba na oficina no próprio dia, num raio de 30 km.</p></div>
    </div>
  </section>

  <section id="lojas">
    <div class="mapa-top">
      <div class="sec-head rv" style="margin:0">
        <span class="eyebrow">Localização</span>
        <h2>Onde levantar</h2>
        <p>Lojas físicas dos parceiros.</p>
      </div>
      <div class="leg" id="leg"></div>
    </div>
    <div id="mapa"></div>
  </section>

  <section id="parceiros">
    <div class="sec-head rv">
      <span class="eyebrow">Rede</span>
      <h2>Empresas parceiras</h2>
      <p>Cada empresa mantém a sua marca, os seus preços e o seu stock.</p>
    </div>
    <div class="parceiros" id="parceirosList"></div>
  </section>

  <section id="projeto">
    <div class="sobre rv">
      <div>
        <span class="eyebrow">Sobre o projeto</span>
        <h2>Digitalizar o setor automóvel da região.</h2>
        <p class="lead">O LisAM reúne PMEs locais, como centros de abate, retificadoras e recondicionadores, para que vendam online com a sua própria marca. Junta o comércio eletrónico à vantagem de estar perto: levantamento no local e entrega no próprio dia.</p>
      </div>
      <div class="pontos">
        <div><span class="pe">🎯</span><h3>Missão</h3><p>Dar às PMEs locais as ferramentas para competir com os grandes marketplaces nacionais.</p></div>
        <div><span class="pe">🤝</span><h3>Modelo B2B</h3><p>As empresas decidem preços e stock. O LisAM é o canal de venda, não um concorrente.</p></div>
        <div><span class="pe">📍</span><h3>Proximidade</h3><p>Entrega no próprio dia para oficinas num raio de 30 km.</p></div>
        <div><span class="pe">♻️</span><h3>Economia circular</h3><p>Cada peça reutilizada evita uma peça nova: menos CO₂ e mais anos de vida para os veículos.</p></div>
      </div>
    </div>
  </section>

  <section class="cta-band rv" style="margin-bottom:0">
    <div>
      <h2>Pronto para encontrar a peça certa?</h2>
      <p>Entre com a sua conta de oficina e reserve em segundos.</p>
    </div>
    <a class="btn btn-light" href="login.php">Entrar na plataforma →</a>
  </section>
</main>

<script id="data-lisam" type="application/json">
<?= json_encode([
  'categorias' => array_map(fn($k,$v) => [$k,$v], array_keys($categorias), array_values($categorias)),
  'parceiros'  => $parceiros,
  'lojas'      => $lojas,
  'pecas'      => $pecas,
], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) ?>
</script>

<?php require __DIR__ . '/includes/footer.php'; ?>