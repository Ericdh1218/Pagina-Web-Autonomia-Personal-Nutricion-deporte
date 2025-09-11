<?php
session_start();

require_once __DIR__ . '/../App/helpers.php';
require_once __DIR__ . '/../inc/db.php';

$BASE = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';
$r = $_GET['r'] ?? 'inicio';

switch ($r) {
  case 'inicio':
    vista(__DIR__ . '/../App/views/inicio.php', ['BASE' => $BASE]);
    break;

  case 'deporte':
    require_login($BASE);
    vista(__DIR__ . '/../App/views/deporte.php', ['BASE' => $BASE]);
    break;

  case 'nutricion':
    require_login($BASE);
    vista(__DIR__ . '/../App/views/nutricion.php', ['BASE' => $BASE]);
    break;

  case 'herramientas':
    require_login($BASE);
    vista(__DIR__ . '/../App/views/herramientas.php', ['BASE' => $BASE]);
    break; 

  case 'login':
    vista(__DIR__ . '/../App/views/auth/login.php', ['BASE' => $BASE]);
    break;

  case 'login_post':
    require_once __DIR__ . '/../App/models/UsuariosModelo.php';

    $correo = trim($_POST['correo'] ?? '');
    $pass = $_POST['password'] ?? '';
    $next = $_POST['next'] ?? ($BASE . 'index.php?r=inicio'); // recupera el "next"

    $user = Usuario::buscarPorCorreo($mysqli, $correo);

    if (!$user || !password_verify($pass, $user['password_hash'])) {
      flash('error', 'Credenciales inválidas.');
      header('Location: ' . $BASE . 'index.php?r=login&next=' . urlencode($next));
      exit;
    }

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['nombre'];
    $_SESSION['is_admin'] = $user['is_admin'];

    // vuelve a donde quería ir, o al inicio
    header('Location: ' . $next);
    exit;


  case 'registro':
    vista(__DIR__ . '/../App/views/auth/registro.php', ['BASE' => $BASE]);
    break;

  case 'registro_post':
    require_once __DIR__ . '/../App/models/UsuariosModelo.php';

    $nombre = trim($_POST['nombre'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $pass = $_POST['password'] ?? '';
    $pass2 = $_POST['password2'] ?? '';

    if ($nombre === '' || !filter_var($correo, FILTER_VALIDATE_EMAIL) || strlen($pass) < 6 || $pass !== $pass2) {
      flash('error', 'Datos inválidos.');
      header('Location: ' . $BASE . 'index.php?r=registro');
      exit;
    }

    if (Usuario::buscarPorCorreo($mysqli, $correo)) {
      flash('error', 'El correo ya está registrado.');
      header('Location: ' . $BASE . 'index.php?r=registro');
      exit;
    }

    Usuario::crear($mysqli, $nombre, $correo, $pass);
    flash('ok', 'Cuenta creada. Ahora inicia sesión.');
    header('Location: ' . $BASE . 'index.php?r=login');
    exit;

  case 'logout':
    session_destroy();
    header('Location: ' . $BASE . 'index.php?r=inicio');
    exit;


  default:
    http_response_code(404);
    echo 'Página no encontrada';
}
