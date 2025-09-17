<?php
class RecetasModelo {
  public static function todas($mysqli) {
    $result = $mysqli->query("SELECT * FROM recetas ORDER BY created_at DESC");
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public static function buscar($mysqli, $q) {
    $stmt = $mysqli->prepare("SELECT * FROM recetas WHERE titulo LIKE CONCAT('%', ?, '%') OR descripcion LIKE CONCAT('%', ?, '%')");
    $stmt->bind_param("ss", $q, $q);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  }

  public static function detalle($mysqli, $id) {
    $stmt = $mysqli->prepare("SELECT * FROM recetas WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
  }
}
