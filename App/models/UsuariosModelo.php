<?php
class Usuario {
    // ... (tu función buscarPorCorreo se queda igual)
    public static function buscarPorCorreo(mysqli $db, string $correo): ?array {
        $stmt = $db->prepare('SELECT * FROM users WHERE correo = ? LIMIT 1');
        $stmt->bind_param('s', $correo);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_assoc() ?: null;
    }

    // --- AÑADE ESTA NUEVA FUNCIÓN ---
    // En App/models/UsuariosModelo.php

public static function buscarPorId(mysqli $db, int $id): ?array {
    // La corrección está en la consulta: usamos SELECT * para traer todas las columnas
    $stmt = $db->prepare('SELECT * FROM users WHERE id = ? LIMIT 1');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $res = $stmt->get_result();
    return $res->fetch_assoc() ?: null;
}
    // --- FIN DE LA NUEVA FUNCIÓN ---

    // ... (tu función crear se queda igual)
    public static function crear(mysqli $db, string $nombre, string $correo, string $pass): bool {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $stmt = $db->prepare('INSERT INTO users (nombre, correo, password_hash) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $nombre, $correo, $hash);
        return $stmt->execute();
    }
     public static function actualizarPassword(mysqli $db, int $userId, string $nuevoPassword): bool {
        // 1. Hashea la nueva contraseña por seguridad
        $hash = password_hash($nuevoPassword, PASSWORD_DEFAULT);

        // 2. Prepara la consulta para actualizar el campo 'password_hash'
        $stmt = $db->prepare('UPDATE users SET password_hash = ? WHERE id = ?');
        $stmt->bind_param('si', $hash, $userId);

        // 3. Ejecuta y devuelve true si fue exitoso
        return $stmt->execute();
    }
    public static function actualizarDatosIMC(mysqli $db, int $userId, float $peso, float $altura, float $imc): bool {
    $stmt = $db->prepare('UPDATE users SET peso = ?, altura = ?, imc = ? WHERE id = ?');
    $stmt->bind_param('dddi', $peso, $altura, $imc, $userId); // 'd' es para decimal/float, 'i' para integer
    return $stmt->execute();
}
public static function actualizarHabitos(mysqli $db, int $userId, string $actividad, string $objetivo, string $alimentacion, int $sueno, int $agua): bool {
    $stmt = $db->prepare(
        'UPDATE users SET 
            nivel_actividad = ?, 
            objetivo_principal = ?, 
            nivel_alimentacion = ?, 
            horas_sueno = ?, 
            consumo_agua = ? 
        WHERE id = ?'
    );
    // Asegúrate que el orden y los tipos coincidan: s, s, s, i, i, i
    $stmt->bind_param('sssiii', $actividad, $objetivo, $alimentacion, $sueno, $agua, $userId);
    return $stmt->execute();
}
public static function actualizarNivelActividad(mysqli $db, int $userId, string $nuevoNivel): bool {
    $stmt = $db->prepare('UPDATE users SET nivel_actividad = ? WHERE id = ?');
    $stmt->bind_param('si', $nuevoNivel, $userId);
    return $stmt->execute();
}
}
