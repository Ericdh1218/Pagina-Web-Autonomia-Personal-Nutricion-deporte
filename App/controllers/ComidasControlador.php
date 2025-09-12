<?php
require_once __DIR__ . '/../models/ComidasModelo.php';

class ComidasControlador {
  public static function agregar($mysqli) {
    if (empty($_SESSION['user_id'])) {
      header("Location: /index.php?r=login");
      exit;
    }

    $dia = $_POST['dia'] ?? null;
    $comida = trim($_POST['comida'] ?? '');

    if ($dia && $comida) {
      ComidasModelo::crear($mysqli, $_SESSION['user_id'], $dia, $comida);
      flash('ok', 'Comida añadida.');
    } else {
      flash('error', 'Faltan datos.');
    }

    global $BASE;
header("Location: " . $BASE . "index.php?r=nutricion");
exit;

  }

  public static function eliminar($mysqli) {
    if (!empty($_POST['id'])) {
      ComidasModelo::eliminar($mysqli, $_POST['id'], $_SESSION['user_id']);
      flash('ok', 'Comida eliminada.');
    }
    global $BASE;
    header("Location: " . $BASE . "index.php?r=nutricion");
    exit;
  }
}
