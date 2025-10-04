<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php';

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

function require_login(string $BASE) {
    if (empty($_SESSION['user_id'])) {
        $next = $_SERVER['REQUEST_URI'] ?? ($BASE . 'index.php?r=inicio');
        flash('error','⚠️ Necesitas iniciar sesión para acceder a esta sección.');
        header('Location: ' . $BASE . 'index.php?r=login&next=' . urlencode($next));
        exit;
    }

    $currentPage = $_GET['r'] ?? 'inicio';
    if ($currentPage !== 'cuestionario' && $currentPage !== 'cuestionario_post' && $currentPage !== 'logout') {
        global $mysqli; 
        require_once __DIR__ . '/models/UsuariosModelo.php';
        
        $usuario = Usuario::buscarPorId($mysqli, $_SESSION['user_id']);

        if ($usuario && empty($usuario['nivel_actividad'])) {
            flash('info', 'Para continuar, por favor, cuéntanos sobre tus hábitos.');
            header('Location: ' . $BASE . 'index.php?r=cuestionario');
            exit;
        }
    }
}

function enviarCorreoReseteo($correoDestino, $nombreDestino, $token, $BASE) {
    $mail = new PHPMailer(true);
    $resetLink = 'https://4d1f66636246.ngrok-free.app/ProyectoAutonomiaPersonal/Public/index.php?r=reset_password&token=' . $token;

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'vitabalance194@gmail.com';
        $mail->Password   = 'wuaw vsdm abai qskd';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
        $mail->CharSet    = 'UTF-8';

        $mail->setFrom('vitabalance194@gmail.com', 'VitaBalance App');
        $mail->addAddress($correoDestino, $nombreDestino);

        $mail->isHTML(true);
        $mail->Subject = 'Recuperación de Contraseña - VitaBalance';
        $mail->Body    = "Hola " . htmlspecialchars($nombreDestino) . ",<br><br>Has solicitado restablecer tu contraseña. Haz clic en el siguiente enlace para continuar:<br><br><a href='" . $resetLink . "' style='padding:10px 20px; background-color:#6d28d9; color:white; text-decoration:none; border-radius:5px;'>Restablecer mi Contraseña</a><br><br>Si no solicitaste esto, puedes ignorar este correo.";
        $mail->AltBody = 'Para restablecer tu contraseña, copia y pega este enlace en tu navegador: ' . $resetLink;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}