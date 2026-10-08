<?php
require __DIR__ . '/includes/config.php';

$pageTitle = 'Stock | LisAM';
$activeNav = 'stock';
$bodyPage  = 'stock';

require __DIR__ . '/includes/header.php';
?>

<main class="wrap">
  <div class="page-head">
    <div>
      <span class="eyebrow">Painel</span>
      <h1>Stock</h1>
      <p>Disponibilidade por empresa, atualizada pelas próprias lojas.</p>
    </div>
    <button class="btn btn-ghost" id="exportar" type="button">⬇ Exportar CSV</button>
  </div>

  <div class="resumo" id="resumo"></div>
  <div class="tabs" id="tabs"></div>

  <form class="filtros" id="filtros" onsubmit="return false">
    <input type="text" id="qStock" placeholder="Referência, peça ou categoria" aria-label="Pesquisar no stock">
    <select id="estado" aria-label="Estado do stock">
      <option value="">Todo o stock</option>
      <option value="ok">Em stock</option>
      <option value="baixo">Stock baixo</option>
      <option value="esgotado">Esgotado</option>
    </select>
    <button class="btn btn-primary" type="submit">Filtrar</button>
    <a class="limpar" id="limpar" style="display:none">Limpar</a>
  </form>

  <div id="conteudoStock"></div>
</main>

<script id="data-stock" type="application/json">
<?= json_encode([
  'parceiros' => $parceiros,
  'stock'     => $stock,
], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) ?>
</script>

<?php require __DIR__ . '/includes/footer.php'; ?>