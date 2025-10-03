<?php
require_once __DIR__ . '/../models/RecetasModelo.php';

class RecetasControlador {

    // MÉTODO INDEX MODIFICADO
    public static function index($mysqli, $q = null, $categoria = null) {
        // Llama a la nueva función del modelo pasándole todos los filtros
        return RecetasModelo::filtrar($mysqli, $q, $categoria);
    }

    public static function detalle($mysqli, $id) {
        return RecetasModelo::detalle($mysqli, $id);
    }
}