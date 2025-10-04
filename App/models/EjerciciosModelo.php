<?php
// Archivo: App/models/EjerciciosModelo.php

class EjerciciosModelo {
    /**
     * Obtiene todos los ejercicios, ordenados por grupo muscular.
     */
    public static function obtenerTodos(mysqli $db): array {
        // --- CAMBIO AQUÍ: Usamos 'grupo_muscular' en lugar de 'categoria' ---
        $result = $db->query("SELECT * FROM ejercicios ORDER BY grupo_muscular, nombre");
        return $result->fetch_all(MYSQLI_ASSOC);
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