<?php
// Archivo: App/models/RutinasModelo.php

class RutinasModelo {
    /**
     * Sugiere una rutina prediseñada basada en el nivel de actividad del usuario.
     */
    public static function sugerirRutina(mysqli $db, string $nivelActividad): ?array {
        // Mapeo: convierte el nivel de actividad del usuario a un nivel de rutina
        $nivelRutina = 'principiante'; // Por defecto
        if ($nivelActividad === 'activo' || $nivelActividad === 'muy_activo') {
            $nivelRutina = 'intermedio';
        }
        
        // Busca una rutina aleatoria del nivel correspondiente
        $stmt = $db->prepare("SELECT * FROM rutinas_prediseñadas WHERE nivel = ? ORDER BY RAND() LIMIT 1");
        $stmt->bind_param('s', $nivelRutina);
        $stmt->execute();
        $rutina = $stmt->get_result()->fetch_assoc();

        if (!$rutina) {
            return null; // No se encontró ninguna rutina para ese nivel
        }

        // Si se encontró una rutina, busca sus ejercicios asociados
        $stmt = $db->prepare("
            SELECT e.nombre, e.media_url, rpe.series_reps
            FROM rutina_prediseñada_ejercicios rpe
            JOIN ejercicios e ON rpe.ejercicio_id = e.id
            WHERE rpe.rutina_id = ?
        ");
        $stmt->bind_param('i', $rutina['id']);
        $stmt->execute();
        $ejercicios = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        $rutina['ejercicios'] = $ejercicios;
        return $rutina;
    }
}