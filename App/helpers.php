<?php
// ---------------------------
// Funciones helper globales
// ---------------------------

function e($str) {
    return htmlspecialchars((string)$str, ENT_QUOTES, 'UTF-8');
}

function flash($key, $msg = null) {
    if ($msg !== null) {
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

function old($key, $default = '') {
    return e($_POST[$key] ?? $default);
}

function vista($ruta, array $data = []) {
    extract($data, EXTR_SKIP);
    ob_start();
    include $ruta;
    $contenido = ob_get_clean();
    $layout = __DIR__ . '/views/layouts/base.php';
    if (file_exists($layout)) {
        include $layout;
    } else {
        echo $contenido;
    }
}

// --- FUNCIÓN require_login CORREGIDA Y SIMPLIFICADA ---
function require_login(string $BASE) {
    // 1. Verifica si hay un usuario logueado. Si no, lo manda a login.
    if (empty($_SESSION['user_id'])) {
        $next = $_SERVER['REQUEST_URI'] ?? ($BASE . 'index.php?r=inicio');
        flash('error','⚠️ Necesitas iniciar sesión para acceder a esta sección.');
        header('Location: ' . $BASE . 'index.php?r=login&next=' . urlencode($next));
        exit;
    }
    

    // 2. Verifica si el usuario ha llenado el cuestionario.
    $currentPage = $_GET['r'] ?? 'inicio';
    // En helpers.php, dentro de la función require_login()

if ($currentPage !== 'cuestionario' && $currentPage !== 'cuestionario_post' && $currentPage !== 'logout') {
    
    // --- ESTA ES LA LÍNEA QUE SOLUCIONA TODO ---
    global $mysqli; 

    require_once __DIR__ . '/models/UsuariosModelo.php';
// ...
        
        $usuario = Usuario::buscarPorId($mysqli, $_SESSION['user_id']);

        // Si la columna 'nivel_actividad' está vacía, lo redirige al cuestionario
        if ($usuario && empty($usuario['nivel_actividad'])) {
            flash('info', 'Para continuar, por favor, cuéntanos sobre tus hábitos.');
            header('Location: ' . $BASE . 'index.php?r=cuestionario');
            exit;
        }
    }
}