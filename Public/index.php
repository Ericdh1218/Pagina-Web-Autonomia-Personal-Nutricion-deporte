<?php
session_start();

require_once __DIR__ . '/../App/helpers.php';
require_once __DIR__ . '/../inc/db.php';

$BASE = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';
$r = $_GET['r'] ?? 'inicio';

switch ($r) {
  case 'inicio':
    $objetivosCount = $mysqli->query("SELECT COUNT(*) AS total FROM objetivos")->fetch_assoc()['total'];
    $ejerciciosCount = $mysqli->query("SELECT COUNT(*) AS total FROM ejercicios")->fetch_assoc()['total'];
    $recetasCount = $mysqli->query("SELECT COUNT(*) AS total FROM recetas")->fetch_assoc()['total'];

    vista(__DIR__ . '/../App/views/inicio.php', [
      'BASE' => $BASE,
      'objetivosCount' => $objetivosCount,
      'ejerciciosCount' => $ejerciciosCount,
      'recetasCount' => $recetasCount
    ]);
    break;

  case 'objetivos':
    // Obtenemos todos los objetivos de la base de datos
    $objetivos = $mysqli->query("SELECT * FROM objetivos ORDER BY id DESC")->fetch_all(MYSQLI_ASSOC);
    // Mostramos la nueva vista 'objetivos.php' y le pasamos los datos
    vista(__DIR__ . '/../App/views/objetivos.php', [
      'BASE' => $BASE,
      'objetivos' => $objetivos
    ]);
    break;

  case 'ejercicios':
    // Obtenemos todos los ejercicios de la base de datos
    $ejercicios = $mysqli->query("SELECT * FROM ejercicios ORDER BY categoria, nombre")->fetch_all(MYSQLI_ASSOC);
    // Mostramos la nueva vista 'ejercicios.php' y le pasamos los datos
    vista(__DIR__ . '/../App/views/ejercicios.php', [
      'BASE' => $BASE,
      'ejercicios' => $ejercicios
    ]);
    break;

  case 'deporte':
    require_login($BASE);
    vista(__DIR__ . '/../App/views/deporte.php', ['BASE' => $BASE]);
    break;

  case 'nutricion':
    // si no hay usuario logueado, mándalo a login con un aviso
    if (empty($_SESSION['user_id'])) {
      flash('error', 'Debes iniciar sesión o registrarte para acceder a esta sección.');
      header('Location: ' . $BASE . 'index.php?r=login');
      exit;
    }
    require_once __DIR__ . '/../App/models/ComidasModelo.php';
    $comidas = ComidasModelo::obtenerPorUsuario($mysqli, $_SESSION['user_id']);
    vista(__DIR__ . '/../App/views/nutricion.php', [
      'BASE' => $BASE,
      'comidas' => $comidas
    ]);
    break;

    case 'plan_semanal':
    require_login($BASE); // Asegúrate que solo usuarios logueados lo vean
    require_once __DIR__ . '/../App/models/PlanSemanalModelo.php';
    $planSemanal = PlanSemanalModelo::obtenerPorUsuario($mysqli, $_SESSION['user_id']);
    vista(__DIR__ . '/../App/views/plan_semanal.php', [
      'BASE' => $BASE,
      'planSemanal' => $planSemanal
    ]);
    break;
    
  case 'comida_agregar':
    require_once __DIR__ . '/../App/controllers/ComidasControlador.php';
    ComidasControlador::agregar($mysqli);
    break;

  case 'comida_eliminar':
    require_once __DIR__ . '/../App/controllers/ComidasControlador.php';
    ComidasControlador::eliminar($mysqli);
    break;

  case 'recetario':
    require_once __DIR__ . '/../App/controllers/RecetasControlador.php';
    $q = $_GET['q'] ?? null;
    $recetas = RecetasControlador::index($mysqli, $q);
    vista(__DIR__ . '/../App/views/recetario.php', [
      'BASE' => $BASE,
      'recetas' => $recetas
    ]);
    break;

  case 'receta':
    require_once __DIR__ . '/../App/controllers/RecetasControlador.php';
    $id = $_GET['id'] ?? 0;
    $receta = RecetasControlador::detalle($mysqli, $id);
    vista(__DIR__ . '/../App/views/receta.php', [
      'BASE' => $BASE,
      'receta' => $receta
    ]);
    break;



  case 'guias':
    vista(__DIR__ . '/../App/views/guias.php', ['BASE' => $BASE]);
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
