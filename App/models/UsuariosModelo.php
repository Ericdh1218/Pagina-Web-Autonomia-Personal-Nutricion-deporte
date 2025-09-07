<?php
class Usuario {
  public static function buscarPorCorreo(mysqli $db, string $correo): ?array {
    $stmt = $db->prepare('SELECT * FROM users WHERE correo = ? LIMIT 1');
    $stmt->bind_param('s', $correo);
    $stmt->execute();
    $res = $stmt->get_result();
    return $res->fetch_assoc() ?: null;
  }

  public static function crear(mysqli $db, string $nombre, string $correo, string $pass): bool {
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    $stmt = $db->prepare('INSERT INTO users (nombre, correo, password_hash) VALUES (?, ?, ?)');
    $stmt->bind_param('sss', $nombre, $correo, $hash);
    return $stmt->execute();
  }
}
