<?php
require_once __DIR__ . '/includes/config.php';
$titulo = 'AutoLeiria, marketplace automóvel B2B';
$usaMapa = true;
$q = trim($_GET['q'] ?? '');

// Filtro simples da pesquisa (referência, título ou loja)
$lista = $pecas;
if ($q !== '') {
  $lista = array_filter($pecas, fn($p) => stripos($p['titulo'].' '.$p['ref'].' '.$p['loja'], $q) !== false);
}

// Mapa: dados vindos do PHP
$lojasJs = json_encode($lojas, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP);
$scriptsExtra = <<<HTML
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
var lojas = $lojasJs;
var map = L.map('mapa',{scrollWheelZoom:false}).setView([39.915,-8.68],11);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{attribution:'© OpenStreetMap',maxZoom:19}).addTo(map);
function esc(s){var d=document.createElement('div');d.textContent=s;return d.innerHTML;}
lojas.forEach(function(l){
  var icone = L.divIcon({className:'',html:'<div class="pin" style="--c:'+l.cor+'">'+esc(l.sigla)+'</div>',iconSize:[30,30],iconAnchor:[15,15],popupAnchor:[0,-16]});
  L.marker(l.coords,{icon:icone}).addTo(map).bindPopup('<b style="color:'+l.cor+'">'+esc(l.nome)+'</b>'+esc(l.tipo)+'<br>'+esc(l.info)+'<br><a href="'+l.gmaps+'" target="_blank" rel="noopener">Abrir no Google Maps</a>');
});
map.fitBounds(L.featureGroup(lojas.map(function(l){return L.marker(l.coords)})).getBounds().pad(0.25));
</script>
HTML;
include __DIR__ . '/includes/header.php';
?>
<main class="wrap">
  <div class="hero">
    <h1>A peça certa, do parceiro certo, hoje.</h1>
    <p>Peças usadas, recondicionadas e novas de três empresas do distrito de Leiria. Levante na loja ou receba na oficina no próprio dia.</p>
    <form class="procura" method="get" action="index.php#pecas">
      <input type="text" name="q" value="<?= e($q) ?>" aria-label="Pesquisar" placeholder="Referência OEM, marca ou modelo">
      <button>Procurar</button>
    </form>
  </div>

  <section id="parceiros">
    <h2>Empresas parceiras</h2>
    <p class="sub">Cada empresa mantém a sua marca, os seus preços e o seu stock.</p>
    <div class="parceiros">
      <?php foreach ($parceiros as $p): ?>
      <div class="parceiro c-<?= e($p['cor']) ?>"><i></i><b><?= e($p['nome']) ?><small><?= e($p['desc']) ?></small></b><span><?= e($p['local']) ?></span><span>Verificado</span><span class="n"><?= e($p['pecas']) ?> peças</span><span class="n"><?= e($p['nota']) ?> ★</span></div>
      <?php endforeach; ?>
    </div>
  </section>

  <section id="lojas">
    <div class="mapa-top">
      <div><h2>Onde levantar</h2><p class="sub" style="margin:0">Lojas físicas dos parceiros.</p></div>
      <div class="leg">
        <?php foreach ($parceiros as $p): ?><span class="c-<?= e($p['cor']) ?>"><?= e($p['nome']) ?></span><?php endforeach; ?>
      </div>
    </div>
    <div id="mapa"></div>
  </section>

  <section id="projeto">
    <div class="sobre">
      <div>
        <h2>Sobre o projeto</h2>
        <p class="sub">Acelerar a transição digital do setor automóvel na região de Leiria.</p>
        <p class="lead">O AutoLeiria reúne PMEs locais, como centros de abate, retificadoras e recondicionadores, para que vendam online com a sua própria marca. Junta o comércio eletrónico à vantagem de estar perto: levantamento no local e entrega no próprio dia.</p>
      </div>
      <div class="pontos">
        <div><h3>Missão</h3><p>Dar às PMEs locais as ferramentas para competir com os grandes marketplaces nacionais.</p></div>
        <div><h3>Modelo B2B</h3><p>As empresas decidem preços e stock. O AutoLeiria é o canal de venda, não um concorrente.</p></div>
        <div><h3>Proximidade</h3><p>Entrega no próprio dia para oficinas num raio de 30 km.</p></div>
        <div><h3>Economia circular</h3><p>Cada peça reutilizada evita uma peça nova: menos CO₂ e mais anos de vida para os veículos.</p></div>
      </div>
    </div>
  </section>

  <section id="categorias">
    <h2>Categorias</h2>
    <p class="sub">Comece pelo sistema do veículo.</p>
    <div class="cats">
      <?php foreach ($categorias as $c): ?><a href="index.php?q=<?= urlencode($c) ?>#pecas"><?= e($c) ?></a><?php endforeach; ?>
    </div>
  </section>

  <section id="pecas">
    <h2>Peças disponíveis</h2>
    <p class="sub"><?= $q !== '' ? count($lista).' resultado(s) para "'.e($q).'". ' : '' ?>Stock atualizado pelas próprias lojas.</p>
    <div class="pecas">
      <?php foreach ($lista as $p): ?>
      <article class="peca c-<?= e($p['cor']) ?>">
        <div class="foto"><em>Foto em breve</em><strong><?= e($p['estado']) ?></strong></div>
        <div class="pb">
          <h3><?= e($p['titulo']) ?></h3>
          <p class="ref">Ref. <b><?= e($p['ref']) ?></b></p>
          <p class="loja"><?= e($p['loja']) ?></p>
          <div class="pf"><span class="preco"><?= number_format($p['preco'], 0, ',', ' ') ?> €</span><button class="res" type="button">Reservar</button></div>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </section>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
