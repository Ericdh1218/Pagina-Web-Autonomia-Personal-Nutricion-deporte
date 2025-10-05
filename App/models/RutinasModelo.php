<?php
// Archivo: App/models/RutinasModelo.php

class RutinasModelo
{
    /**
     * Sugiere una rutina prediseñada basada en el nivel de actividad del usuario.
     */
    public static function sugerirRutina(mysqli $db, string $nivelActividad): ?array
    {
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
    public static function obtenerTodasPrediseñadas(mysqli $db): array
    {
        $rutinas = [];
        $result = $db->query("SELECT id, nombre_rutina, descripcion, nivel FROM rutinas_prediseñadas ORDER BY nivel");

        while ($rutina = $result->fetch_assoc()) {
            // Para cada rutina, obtenemos sus ejercicios
            $stmt = $db->prepare("
            SELECT e.nombre, rpe.series_reps
            FROM rutina_prediseñada_ejercicios rpe
            JOIN ejercicios e ON rpe.ejercicio_id = e.id
            WHERE rpe.rutina_id = ?
        ");
            $stmt->bind_param('i', $rutina['id']);
            $stmt->execute();
            $ejercicios = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $rutina['ejercicios'] = $ejercicios;
            $rutinas[] = $rutina;
        }
        return $rutinas;
    }
    public static function obtenerRutinasPorUsuario(mysqli $db, int $userId): array
    {
        $rutinas = [];
        // Primero, obtenemos todas las rutinas del usuario
        $stmt = $db->prepare("SELECT * FROM rutinas WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        // Ahora, para cada rutina, buscamos sus ejercicios
        while ($rutina = $result->fetch_assoc()) {
            $stmt_ejercicios = $db->prepare("
            SELECT e.nombre, e.media_url 
            FROM rutina_ejercicios re
            JOIN ejercicios e ON re.ejercicio_id = e.id
            WHERE re.rutina_id = ?
        ");
            $stmt_ejercicios->bind_param('i', $rutina['id']);
            $stmt_ejercicios->execute();
            $ejercicios = $stmt_ejercicios->get_result()->fetch_all(MYSQLI_ASSOC);

            // Añadimos la lista de ejercicios a la rutina
            $rutina['ejercicios'] = $ejercicios;
            $rutinas[] = $rutina;
        }
        return $rutinas;
    }

    /**
     * Crea una nueva rutina personalizada para un usuario y le asigna los ejercicios seleccionados.
     */
    public static function crearRutina(mysqli $db, int $userId, string $nombreRutina, array $ejerciciosIds): bool
    {
        // 1. Iniciar una transacción para asegurar que todo se guarde correctamente
        $db->begin_transaction();

        try {
            // 2. Insertar la nueva rutina en la tabla 'rutinas'
            $stmt = $db->prepare("INSERT INTO rutinas (user_id, nombre_rutina) VALUES (?, ?)");
            $stmt->bind_param('is', $userId, $nombreRutina);
            $stmt->execute();

            // 3. Obtener el ID de la rutina que acabamos de crear
            $rutinaId = $db->insert_id;

            // 4. Preparar la consulta para vincular los ejercicios
            $stmt = $db->prepare("INSERT INTO rutina_ejercicios (rutina_id, ejercicio_id) VALUES (?, ?)");

            // 5. Recorrer la lista de IDs de ejercicios y guardarlos uno por uno
            foreach ($ejerciciosIds as $ejercicioId) {
                $stmt->bind_param('ii', $rutinaId, $ejercicioId);
                $stmt->execute();
            }

            // 6. Si todo salió bien, confirmar los cambios
            $db->commit();
            return true;

        } catch (Exception $e) {
            // 7. Si algo falló, deshacer todos los cambios
            $db->rollback();
            // error_log($e->getMessage()); // Opcional: guardar el error en un log
            return false;
        }
    }
}