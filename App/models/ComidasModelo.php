<?php
class ComidasModelo {
  public static function crear($mysqli, $user_id, $dia, $comida) {
    $stmt = $mysqli->prepare("INSERT INTO comidas (user_id, dia, comida) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $dia, $comida);
    return $stmt->execute();
  }

  public static function obtenerPorUsuario($mysqli, $user_id) {
    $stmt = $mysqli->prepare("SELECT * FROM comidas WHERE user_id = ? ORDER BY dia ASC");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  }

  public static function eliminar($mysqli, $id, $user_id) {
    $stmt = $mysqli->prepare("DELETE FROM comidas WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $user_id);
    return $stmt->execute();
  }
}
