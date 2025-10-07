<?php
// Archivo: App/models/MedidasModelo.php

class MedidasModelo {
    /**
     * Obtiene todo el historial de medidas de un usuario.
     */
    public static function obtenerHistorial(mysqli $db, int $userId): array {
        $stmt = $db->prepare("SELECT * FROM medidas_registro WHERE user_id = ? ORDER BY fecha DESC");
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Guarda o actualiza un registro de medidas para un día específico.
     */
    public static function guardarMedidas(mysqli $db, int $userId, string $fecha, array $medidas): bool {
        $sql = "
            INSERT INTO medidas_registro (user_id, fecha, peso, cintura, cadera, pecho) 
            VALUES (?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE 
            peso = VALUES(peso),
            cintura = VALUES(cintura),
            cadera = VALUES(cadera),
            pecho = VALUES(pecho)
        ";
        
        $stmt = $db->prepare($sql);
        $stmt->bind_param('isdddd', 
            $userId, $fecha,
            $medidas['peso'], $medidas['cintura'],
            $medidas['cadera'], $medidas['pecho']
        );
        
        // Adicionalmente, actualizamos el peso más reciente en la tabla de usuarios
        $stmt_user = $db->prepare("UPDATE users SET peso = ? WHERE id = ?");
        $stmt_user->bind_param('di', $medidas['peso'], $userId);
        $stmt_user->execute();

        return $stmt->execute();
    }
}