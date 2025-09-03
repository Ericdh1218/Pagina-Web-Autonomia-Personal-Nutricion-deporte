<?php
require_once __DIR__ . '/../models/UsuariosModelo.php';

class AuthControlador {
  public static function mostrarLogin() {
    vista(__DIR__ . '/../views/auth/login.php');
  }

  public static function mostrarRegistro() {
    vista(__DIR__ . '/../views/auth/registro.php');
  }

  public static function registrar($mysqli) {
    $nombre  = trim($_POST['nombre'] ?? '');
    $correo  = trim($_POST['correo'] ?? '');
    $pass    = $_POST['password'] ?? '';
    $pass2   = $_POST['password2'] ?? '';

    if ($nombre === '' || !filter_var($correo, FILTER_VALIDATE_EMAIL) || strlen($pass) < 6 || $pass !== $pass2) {
      flash('error', 'Datos inválidos. Revisa el formulario.');
      return self::mostrarRegistro();
    }

    if (Usuario::buscarPorCorreo($mysqli, $correo)) {
      flash('error', 'El correo ya está registrado.');
      return self::mostrarRegistro();
    }

    Usuario::crear($mysqli, $nombre, $correo, $pass);
    flash('ok', 'Cuenta creada. Ahora inicia sesión.');
    header('Location: /index.php?r=login'); exit;
  }

  public static function login($mysqli) {
    $correo = trim($_POST['correo'] ?? '');
    $pass   = $_POST['password'] ?? '';
    $user   = Usuario::buscarPorCorreo($mysqli, $correo);

    if (!$user || !password_verify($pass, $user['password_hash'])) {
      flash('error', 'Credenciales inválidas.');
      return self::mostrarLogin();
    }

    $_SESSION['user_id']   = $user['id'];
    $_SESSION['user_name'] = $user['nombre'];
    $_SESSION['tipo_user'] = $user['tipo_user']; // <- tu campo en DB

    header('Location: /index.php'); exit;
  }

  public static function logout() {
    session_destroy();
    header('Location: /index.php'); exit;
  }
}
