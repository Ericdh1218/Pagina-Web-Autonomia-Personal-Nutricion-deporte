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

    // Cargar todos los modelos necesarios
    require_once __DIR__ . '/../App/models/EjerciciosModelo.php';
    require_once __DIR__ . '/../App/models/UsuariosModelo.php';
    require_once __DIR__ . '/../App/models/RutinasModelo.php';

    // Obtener datos para la vista
    $ejercicios = EjerciciosModelo::obtenerTodos($mysqli);
    $usuario = Usuario::buscarPorId($mysqli, $_SESSION['user_id']);
    $nivelActividad = $usuario['nivel_actividad'] ?? 'sedentario';

    // Pedir una rutina sugerida al modelo
    $rutinaSugerida = RutinasModelo::sugerirRutina($mysqli, $nivelActividad);

    // Enviar todos los datos a la vista
    vista(__DIR__ . '/../App/views/deporte.php', [
      'BASE' => $BASE,
      'ejercicios' => $ejercicios,
      'rutinaSugerida' => $rutinaSugerida,
      'nivelActual' => $nivelActividad
    ]);
    break;

  // En index.php

  // ... (después del 'case deporte')

  case 'ejercicio': // <-- NUEVA RUTA
    require_login($BASE);

    // 1. Cargar el modelo
    require_once __DIR__ . '/../App/models/EjerciciosModelo.php';

    // 2. Obtener el ID de la URL
    $id = (int) ($_GET['id'] ?? 0);

    // 3. Buscar el ejercicio específico
    $ejercicio = EjerciciosModelo::buscarPorId($mysqli, $id);

    // Si no se encuentra el ejercicio, puedes redirigir o mostrar un error
    if (!$ejercicio) {
      http_response_code(404);
      echo "Ejercicio no encontrado.";
      exit;
    }

    // 4. Mostrar la nueva vista de detalle
    vista(__DIR__ . '/../App/views/ejercicio_detalle.php', [
      'BASE' => $BASE,
      'ejercicio' => $ejercicio
    ]);
    break;
  case 'actualizar_nivel':
    require_login($BASE);
    require_once __DIR__ . '/../App/models/UsuariosModelo.php';

    $nuevoNivel = $_POST['nuevo_nivel'] ?? 'sedentario';
    $userId = $_SESSION['user_id'];

    // Validar que el valor sea uno de los permitidos para seguridad
    if (in_array($nuevoNivel, ['sedentario', 'ligero', 'activo', 'muy_activo'])) {
      Usuario::actualizarNivelActividad($mysqli, $userId, $nuevoNivel);
      flash('ok', '¡Tu nivel de actividad ha sido actualizado! Aquí tienes una nueva sugerencia.');
    } else {
      flash('error', 'Nivel no válido.');
    }

    // Redirigir de vuelta a la página de deporte para ver la nueva sugerencia
    header('Location: ' . $BASE . 'index.php?r=deporte');
    exit;
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

    // 1. Capturamos AMBOS parámetros de la URL (texto y categoría)
    $q = $_GET['q'] ?? null;
    $categoria = $_GET['categoria'] ?? null;

    // 2. Llamamos al controlador con AMBOS parámetros
    $recetas = RecetasControlador::index($mysqli, $q, $categoria);

    // 3. Pasamos los resultados Y los términos de búsqueda a la vista
    vista(__DIR__ . '/../App/views/recetario.php', [
      'BASE' => $BASE,
      'recetas' => $recetas,
      'searchTerm' => $q,          // Para que el campo de texto recuerde lo que se buscó
      'selectedCategory' => $categoria   // Para que el menú desplegable recuerde la selección
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

  case 'Micuenta':
    require_login($BASE); // Correcto, mantiene al usuario seguro

    // --- LÓGICA MODIFICADA ---
    // 1. Carga el modelo que acabamos de modificar
    require_once __DIR__ . '/../App/models/UsuariosModelo.php';

    // 2. Busca los datos completos del usuario usando el ID de la sesión
    $usuario = Usuario::buscarPorId($mysqli, $_SESSION['user_id']);

    // 3. Pasa los datos del usuario a la vista
    vista(__DIR__ . '/../App/views/Micuenta.php', [
      'BASE' => $BASE,
      'usuario' => $usuario // Pasamos el array completo con los datos del usuario
    ]);
    // --- FIN DE LA MODIFICACIÓN ---
    break;

  case 'guias':
    vista(__DIR__ . '/../App/views/guias.php', ['BASE' => $BASE]);
    break;

  case 'herramientas':
    require_login($BASE);
    vista(__DIR__ . '/../App/views/herramientas.php', ['BASE' => $BASE]);
    break;
  case 'guardar_imc':
    // Solo responde a peticiones POST y si el usuario está logueado
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_SESSION['user_id'])) {
      http_response_code(403); // Forbidden
      echo json_encode(['status' => 'error', 'message' => 'Acceso no permitido']);
      exit;
    }

    // 1. Obtener los datos JSON enviados desde JavaScript
    $data = json_decode(file_get_contents('php://input'), true);
    $peso = $data['peso'] ?? 0;
    $altura = $data['altura'] ?? 0;

    // 2. Validar y calcular el IMC en el servidor (más seguro)
    if ($peso > 0 && $altura > 0) {
      $alturaEnMetros = $altura / 100;
      $imc = round($peso / ($alturaEnMetros ** 2), 1);

      // 3. Guardar en la base de datos
      require_once __DIR__ . '/../App/models/UsuariosModelo.php';
      Usuario::actualizarDatosIMC($mysqli, $_SESSION['user_id'], $peso, $altura, $imc);

      // 4. Enviar respuesta de éxito
      header('Content-Type: application/json');
      echo json_encode(['status' => 'ok', 'message' => 'Datos guardados']);
    } else {
      // Enviar respuesta de error
      header('Content-Type: application/json');
      http_response_code(400); // Bad Request
      echo json_encode(['status' => 'error', 'message' => 'Datos inválidos']);
    }
    exit; // Termina la ejecución aquí

  case 'cuestionario':
    require_login($BASE);
    vista(__DIR__ . '/../App/views/cuestionario.php', ['BASE' => $BASE]);
    break;

  // Ruta para PROCESAR y GUARDAR los datos del cuestionario
  case 'cuestionario_post':
    require_login($BASE);

    $userId = $_SESSION['user_id'];
    $actividad = $_POST['nivel_actividad'] ?? '';
    $objetivo = $_POST['objetivo_principal'] ?? '';
    $alimentacion = $_POST['nivel_alimentacion'] ?? '';
    $sueno = (int) ($_POST['horas_sueno'] ?? 0);
    $agua = (int) ($_POST['consumo_agua'] ?? 0);

    require_once __DIR__ . '/../App/models/UsuariosModelo.php';
    Usuario::actualizarHabitos($mysqli, $userId, $actividad, $objetivo, $alimentacion, $sueno, $agua);

    flash('ok', '¡Tu perfil ha sido actualizado con tus hábitos!');
    header('Location: ' . $BASE . 'index.php?r=Micuenta');
    exit;
  // --- FIN DE LOS NUEVOS CASOS ---

  case 'login':
    vista(__DIR__ . '/../App/views/auth/login.php', ['BASE' => $BASE]);
    break;

  // ... otros casos como 'login', 'registro', etc. ...

  // --- AÑADE ESTAS DOS NUEVAS RUTAS ---

  // Ruta para MOSTRAR el formulario de cambio de contraseña
  case 'cambiar_password':
    require_login($BASE); // Solo usuarios logueados pueden acceder
    vista(__DIR__ . '/../App/views/auth/cambiar_password.php', ['BASE' => $BASE]);
    break;

  // Ruta para PROCESAR el formulario enviado
  case 'cambiar_password_post':
    require_login($BASE); // Seguridad primero

    // 1. Cargar el modelo
    require_once __DIR__ . '/../App/models/UsuariosModelo.php';

    // 2. Obtener datos del formulario y el ID de la sesión
    $userId = $_SESSION['user_id'];
    $passActual = $_POST['password_actual'] ?? '';
    $nuevoPass = $_POST['nuevo_password'] ?? '';
    $nuevoPass2 = $_POST['nuevo_password2'] ?? '';

    // 3. Validaciones
    if (empty($passActual) || empty($nuevoPass) || empty($nuevoPass2)) {
      flash('error', 'Todos los campos son obligatorios.');
      header('Location: ' . $BASE . 'index.php?r=cambiar_password');
      exit;
    }

    if (strlen($nuevoPass) < 8) {
      flash('error', 'La nueva contraseña debe tener al menos 8 caracteres.');
      header('Location: ' . $BASE . 'index.php?r=cambiar_password');
      exit;
    }

    if ($nuevoPass !== $nuevoPass2) {
      flash('error', 'Las nuevas contraseñas no coinciden.');
      header('Location: ' . $BASE . 'index.php?r=cambiar_password');
      exit;
    }

    // ... en index.php dentro de case 'cambiar_password_post':

    // 4. Verificar la contraseña actual
    $usuario = Usuario::buscarPorId($mysqli, $userId);

    if (!$usuario || !password_verify($passActual, $usuario['password_hash'])) {
      flash('error', 'La contraseña actual es incorrecta.');
      header('Location: ' . $BASE . 'index.php?r=cambiar_password');
      exit;
    }

    // ...

    // 5. Si todo es correcto, actualizar la contraseña
    Usuario::actualizarPassword($mysqli, $userId, $nuevoPass);

    flash('ok', '¡Contraseña actualizada correctamente!');
    header('Location: ' . $BASE . 'index.php?r=Micuenta');
    exit;

  // ... otros casos como 'logout', etc. ...

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

    // --- VALIDACIÓN DE CONTRASEÑA MEJORADA ---
    $passwordRegex = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/';

    if (
      empty($nombre) ||
      !filter_var($correo, FILTER_VALIDATE_EMAIL) ||
      !preg_match($passwordRegex, $pass) || // Nueva validación más segura
      $pass !== $pass2
    ) {
      flash('error', 'Datos inválidos. La contraseña debe tener al menos 8 caracteres, incluyendo letras y números.');
      header('Location: ' . $BASE . 'index.php?r=registro');
      exit;
    }

    if (Usuario::buscarPorCorreo($mysqli, $correo)) {
      flash('error', 'El correo ya está registrado.');
      header('Location: ' . $BASE . 'index.php?r=registro');
      exit;
    }

    // Crea el usuario en la base de datos
    Usuario::crear($mysqli, $nombre, $correo, $pass);

    // --- REDIRECCIÓN MEJORADA ---
    // Inicia sesión automáticamente al nuevo usuario
    $user = Usuario::buscarPorCorreo($mysqli, $correo);
    if ($user) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_name'] = $user['nombre'];
    }

    // Redirige al cuestionario en lugar de a la página de login
    flash('ok', '¡Cuenta creada! Ahora, cuéntanos sobre tus hábitos.');
    header('Location: ' . $BASE . 'index.php?r=cuestionario');
    exit;

  case 'logout':
    session_destroy();
    header('Location: ' . $BASE . 'index.php?r=inicio');
    exit;


  default:
    http_response_code(404);
    echo 'Página no encontrada';
}
