<?php
class PlanSemanalModelo {
    public static function obtenerPorUsuario($mysqli, $userId) {
        $sql = "SELECT ps.dia_semana, ps.tipo_comida, r.id AS receta_id, r.titulo
                FROM plan_semanal ps
                JOIN recetas r ON ps.receta_id = r.id
                WHERE ps.user_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        $plan = [];
        while ($row = $result->fetch_assoc()) {
            $dia = ucfirst($row['dia_semana']); // Lunes, Martes...
            $tipo = ucfirst($row['tipo_comida']); // Desayuno, Almuerzo, Cena
            $plan[$dia][$tipo] = [
                'id' => $row['receta_id'],
                'titulo' => $row['titulo']
            ];
        }
        return $plan;
    }
}
