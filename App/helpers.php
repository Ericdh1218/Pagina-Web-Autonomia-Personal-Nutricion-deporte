<?php
// ---------------------------
// Funciones helper globales
// ---------------------------

// Escapar HTML (seguridad XSS)
function e($str) {
  return htmlspecialchars((string)$str, ENT_QUOTES, 'UTF-8');
}

// Flash messages (guardar un mensaje en sesión para mostrarlo una sola vez)
function flash($key, $msg = null) {
  if ($msg !== null) { // set
    $_SESSION['flash'][$key] = $msg;
    return;
  }
  if (!empty($_SESSION['flash'][$key])) {
    $val = $_SESSION['flash'][$key];
    unset($_SESSION['flash'][$key]);
    return $val;
  }
  return null;
}

// Mantener valores antiguos del formulario tras error
function old($key, $default = '') {
  return e($_POST[$key] ?? $default);
}

// Renderizar vistas con layout base
function vista($ruta, array $data = []) {
  extract($data, EXTR_SKIP);

  ob_start();
  include $ruta;          // se genera la vista
  $contenido = ob_get_clean();  // se guarda en buffer

  // Layout base (debe existir App/views/layouts/base.php)
  $layout = __DIR__ . '/views/layouts/base.php';
  if (file_exists($layout)) {
    include $layout;
  } else {
    echo $contenido; // fallback: imprime directo
  }
}

// Verificar que haya login antes de acceder a páginas privadas
function require_login(string $BASE) {
  if (empty($_SESSION['user_id'])) {
    $next = $_SERVER['REQUEST_URI'] ?? ($BASE . 'index.php?r=inicio');
    flash('error','⚠️ Necesitas iniciar sesión o registrarte para acceder a esta sección y guardar tu historial de progreso.');
    header('Location: ' . $BASE . 'index.php?r=login&next=' . urlencode($next));
    exit;
  }
}
