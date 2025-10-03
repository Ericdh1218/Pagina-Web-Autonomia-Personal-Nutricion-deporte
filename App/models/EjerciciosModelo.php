<?php
// Archivo: App/models/EjerciciosModelo.php

class EjerciciosModelo {
    /**
     * Obtiene todos los ejercicios de la base de datos, ordenados por categoría.
     */
    public static function obtenerTodos(mysqli $db): array {
        $result = $db->query("SELECT * FROM ejercicios ORDER BY categoria, nombre");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public static function buscarPorId(mysqli $db, int $id): ?array {
        $stmt = $db->prepare("SELECT * FROM ejercicios WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }
}