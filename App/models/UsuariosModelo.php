<?php
class Usuario {
  public static function buscarPorCorreo(mysqli $mysqli, string $correo): ?array {
    $sql  = "SELECT id, nombre, correo, password_hash, tipo_user FROM users WHERE correo=? LIMIT 1";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();
    return $res ?: null;
  }

  public static function crear(mysqli $mysqli, string $nombre, string $correo, string $password): bool {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $sql  = "INSERT INTO users (nombre, correo, password_hash) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sss", $nombre, $correo, $hash);
    return $stmt->execute();
  }
}
