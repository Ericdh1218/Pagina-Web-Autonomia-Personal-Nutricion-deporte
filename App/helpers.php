<?php
function e($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

function flash($key, $msg=null){
  if ($msg !== null) {                 // set
    $_SESSION['flash'][$key] = $msg;
    return;
  }
  if (!empty($_SESSION['flash'][$key])){ // get + delete
    $v = $_SESSION['flash'][$key];
    unset($_SESSION['flash'][$key]);
    return $v;
  }
  return null;
}

function old($k,$d=''){ return e($_POST[$k] ?? $d); }

/**
 * Render de vistas con layout.
 * $ruta debe ser ABSOLUTA (ej: __DIR__.'/views/inicio.php')
 * $data (opcional) expone variables dentro de la vista.
 */
function vista(string $ruta, array $data = []) : void {
  if (!is_file($ruta)) {
    http_response_code(500);
    echo "Vista no encontrada: " . e($ruta);
    return;
  }

  extract($data, EXTR_SKIP);

  ob_start();
  include $ruta;               // genera $contenido desde la vista
  $contenido = ob_get_clean();

  $layout = __DIR__ . '/views/layouts/base.php';
  if (is_file($layout)) {
    include $layout;           // el layout imprime $contenido
  } else {
    echo $contenido;           // sin layout, imprime directo
  }
}
