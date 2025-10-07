<?php
// Archivo: App/models/EjerciciosModelo.php

class EjerciciosModelo {
    /**
     * Obtiene todos los ejercicios, ordenados por grupo muscular.
     */
    public static function obtenerTodos(mysqli $db, ?string $q = null): array {
    $sql = "SELECT * FROM ejercicios";
    $params = [];
    $types = "";

    // Si se proporciona un término de búsqueda, lo añadimos a la consulta
    if ($q) {
        $sql .= " WHERE nombre LIKE ? OR descripcion LIKE ?";
        $searchTerm = "%" . $q . "%";
        $params[] = $searchTerm;
        $params[] = $searchTerm;
        $types = "ss";
    }

    $sql .= " ORDER BY grupo_muscular, nombre";
    
    $stmt = $db->prepare($sql);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->fetch_all(MYSQLI_ASSOC);
}
    /**
     * Busca un único ejercicio por su ID.
     */
    public static function buscarPorId(mysqli $db, int $id): ?array {
        $stmt = $db->prepare("SELECT * FROM ejercicios WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }
}