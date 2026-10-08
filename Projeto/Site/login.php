<?php
require __DIR__ . '/includes/config.php';

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = strtolower(trim($_POST['email'] ?? ''));
    $pass  = $_POST['pass'] ?? '';

    if ($email === '' || $pass === '') {
        $erro = 'Introduza um email e uma palavra-passe válidos.';
    } elseif (isset($utilizadoresDemo[$email]) && $utilizadoresDemo[$email]['pass'] === $pass) {
        $_SESSION['user'] = ['email' => $email, 'nome' => $utilizadoresDemo[$email]['nome']];
        header('Location: index.php');
        exit;
    } else {
        $erro = 'Email ou palavra-passe incorretos.';
    }
}

$pageTitle = 'Entrar | LisAM';
$activeNav = '';
$bodyPage  = 'login';

require __DIR__ . '/includes/header.php';
?>

<main class="login-page">
  <div class="login-side">
    <span class="blob b1"></span><span class="blob b2"></span>
    <div>
      <span class="eyebrow" style="color:#a5b4fc">Área de parceiros</span>
      <h1>Bem-vindo de volta à <span class="gtext">oficina</span>.</h1>
      <p>Entre na sua conta para reservar peças, acompanhar encomendas e levantar na loja ou receber no próprio dia.</p>
      <div class="vant">
        <div><span>⚡</span>Reserve peças em segundos</div>
        <div><span>📍</span>Levante na loja mais próxima</div>
        <div><span>🚚</span>Entrega no próprio dia num raio de 30 km</div>
      </div>
      <div class="lista">
        <?php foreach ($parceiros as $p): ?>
          <div class="c-<?= e($p['cor']) ?>">
            <i></i><b><?= e($p['nome']) ?></b><span><?= e($p['local']) ?></span>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <div class="form-wrap">
    <span class="blob b2"></span>
    <form class="card" id="loginForm" method="post" action="login.php" novalidate>
      <h2>Entrar</h2>
      <p class="sub">Acesso para oficinas e empresas parceiras.</p>

      <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="oficina@exemplo.pt" autocomplete="email" required
               value="<?= e($_POST['email'] ?? '') ?>">
      </div>

      <div class="campo">
        <label for="pass">Palavra-passe</label>
        <div class="pw">
          <input type="password" id="pass" name="pass" placeholder="••••••••" autocomplete="current-password" required>
          <button type="button" class="ver" id="ver">Mostrar</button>
        </div>
      </div>

      <div class="linha">
        <label><input type="checkbox" id="lembrar" name="lembrar"> Manter sessão iniciada</label>
        <a href="#" id="esqueci">Esqueci-me da palavra-passe</a>
      </div>

      <p class="erro" id="erro" role="alert" style="<?= $erro ? '' : 'display:none' ?>"><?= e($erro) ?></p>
      <button type="submit" class="entrar" id="btnEntrar">Entrar</button>

      <p class="novo">Ainda não tem conta? <a href="#" id="pedir">Pedir acesso</a></p>
      <div class="demo-hint">Demo: <b>oficina@exemplo.pt</b> / <b>123456</b></div>
    </form>
  </div>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>