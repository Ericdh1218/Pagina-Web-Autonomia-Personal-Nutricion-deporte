<?php
function e($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

function flash($key, $msg=null){
  if($msg!==null){ $_SESSION['flash'][$key]=$msg; return; }
  if(!empty($_SESSION['flash'][$key])){ $v=$_SESSION['flash'][$key]; unset($_SESSION['flash'][$key]); return $v; }
  return null;
}

function old($k,$d=''){ return e($_POST[$k]??$d); }

/**
 * Render de vistas con layout.
 * $ruta debe ser ABSOLUTA (ej: __DIR__.'/views/home.php')
 */
function vista($ruta, array $data=[]){
  if(!file_exists($ruta)){
    // Muestra la ruta que buscó → te ayuda a detectar el path malo
    die("Vista no encontrada: <code>$ruta</code>");
  }
  extract($data, EXTR_SKIP);

  ob_start();
  require $ruta;                 // Renderiza la vista
  $contenido = ob_get_clean();   // HTML resultante

  // Layout base en App/views/layouts/base.php
  $layout = __DIR__ . '/views/layouts/base.php';
  if(file_exists($layout)){
    require $layout;             // el layout imprime $contenido
  } else {
    echo $contenido;             // si no hay layout, muestra directo
  }
}
