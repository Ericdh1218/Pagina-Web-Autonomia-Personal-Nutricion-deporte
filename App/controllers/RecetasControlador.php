<?php
require_once __DIR__ . '/../models/RecetasModelo.php';

class RecetasControlador {
  public static function index($mysqli, $q = null) {
    if ($q) {
      return RecetasModelo::buscar($mysqli, $q);
    }
    return RecetasModelo::todas($mysqli);
  }

  public static function detalle($mysqli, $id) {
    return RecetasModelo::detalle($mysqli, $id);
  }
}
