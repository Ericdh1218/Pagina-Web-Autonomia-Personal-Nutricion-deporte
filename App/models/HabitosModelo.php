<?php
// Archivo: App/models/HabitosModelo.php

class HabitosModelo {
    /**
     * Obtiene el registro de hábitos de un usuario para una fecha específica.
     */
    public static function obtenerRegistroPorFecha(mysqli $db, int $userId, string $fecha): ?array {
        $stmt = $db->prepare("SELECT * FROM habitos_registro WHERE user_id = ? AND fecha = ?");
        $stmt->bind_param('is', $userId, $fecha);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    /**
     * Guarda o actualiza el registro de hábitos de un día.
     */
    public static function guardarRegistro(mysqli $db, int $userId, string $fecha, array $habitos): bool {
        // Esta consulta especial inserta un nuevo registro o actualiza uno existente si ya existe.
        $sql = "
            INSERT INTO habitos_registro (user_id, fecha, agua_cumplido, sueno_cumplido, entrenamiento_cumplido, alimentacion_cumplida) 
            VALUES (?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE 
            agua_cumplido = VALUES(agua_cumplido),
            sueno_cumplido = VALUES(sueno_cumplido),
            entrenamiento_cumplido = VALUES(entrenamiento_cumplido),
            alimentacion_cumplida = VALUES(alimentacion_cumplida)
        ";
        
        $stmt = $db->prepare($sql);
        $stmt->bind_param('isiiii', 
            $userId, 
            $fecha,
            $habitos['agua'],
            $habitos['sueno'],
            $habitos['entrenamiento'],
            $habitos['alimentacion']
        );
        return $stmt->execute();
    }
}