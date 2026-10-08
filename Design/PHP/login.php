<?php
require_once __DIR__ . '/includes/config.php';
if (logado()) { header('Location: index.php'); exit; }

$erro = '';
$email = '';
if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = strtolower(trim($_POST['email'] ?? ''));
  $pass  = $_POST['pass'] ?? '';
  $_SESSION['tentativas'] = $_SESSION['tentativas'] ?? 0;

  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'] ?? '')) {
    $erro = 'Sessão expirada. Tente novamente.';
  } elseif ($_SESSION['tentativas'] >= 5) {
    $erro = 'Demasiadas tentativas. Feche o navegador e tente mais tarde.';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || $pass === '') {
    $erro = 'Introduza um email e uma palavra-passe válidos.';
  } else {
    $u = $utilizadores[$email] ?? null;
    // password_verify também corre com um hash falso para manter o tempo de resposta parecido
    $hash = $u['hash'] ?? '$2y$10$usesomesillystringforsaltuOWzXk5m8nB1tQh6y0o5vYk3dX2e1a';
    if ($u && password_verify($pass, $hash)) {
      session_regenerate_id(true);
      $_SESSION['user'] = ['email' => $email, 'nome' => $u['nome']];
      $_SESSION['tentativas'] = 0;
      header('Location: index.php'); exit;
    }
    $_SESSION['tentativas']++;
    $erro = 'Email ou palavra-passe incorretos.';
  }
}

$titulo = 'Entrar | AutoLeiria';
include __DIR__ . '/includes/header.php';
?>
<main class="login-grid">
  <div class="lado">
    <h1>Bem-vindo de volta à oficina.</h1>
    <p>Entre na sua conta para reservar peças, acompanhar encomendas e levantar na loja ou receber no próprio dia.</p>
    <div class="lista">
      <?php foreach ($parceiros as $p): ?>
      <div class="c-<?= e($p['cor']) ?>"><i></i><b><?= e($p['nome']) ?></b><span><?= e($p['local']) ?></span></div>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="form-wrap">
    <form class="card" method="post" action="login.php" novalidate>
      <h2>Entrar</h2>
      <p class="sub">Acesso para oficinas e empresas parceiras.</p>
      <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">

      <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= e($email) ?>" placeholder="oficina@exemplo.pt" autocomplete="email" required>
      </div>

      <div class="campo">
        <label for="pass">Palavra-passe</label>
        <div class="pw">
          <input type="password" id="pass" name="pass" placeholder="••••••••" autocomplete="current-password" required>
          <button type="button" class="ver" id="ver" aria-label="Mostrar palavra-passe">Mostrar</button>
        </div>
      </div>

      <div class="linha">
        <label><input type="checkbox" name="lembrar"> Manter sessão iniciada</label>
        <a href="#">Esqueci-me da palavra-passe</a>
      </div>

      <?php if ($erro): ?><p class="erro" role="alert"><?= e($erro) ?></p><?php endif; ?>
      <button type="submit" class="entrar">Entrar</button>

      <p class="novo">Ainda não tem conta? <a href="#">Pedir acesso</a></p>
    </form>
  </div>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
