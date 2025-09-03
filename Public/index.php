<?php
session_start();

require_once __DIR__ . '/../App/helpers.php';
// (si usas DB) require_once __DIR__ . '/../inc/db.php';

$r = $_GET['r'] ?? 'inicio'; // ← por defecto 'inicio' (antes era 'home')

switch ($r) {
  case 'inicio':
    vista(__DIR__ . '/../App/views/inicio.php');
    break;

  case 'login':
    vista(__DIR__ . '/../App/views/auth/login.php');
    break;

  case 'registro':
    vista(__DIR__ . '/../App/views/auth/registro.php');
    break;

  // …más rutas (nutricion, deporte, herramientas) si las separas
  default:
    http_response_code(404);
    echo 'Página no encontrada';
}
