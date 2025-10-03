<?php

class RecetasModelo {

    /**
     * Función unificada para obtener recetas.
     * Puede filtrar por término de búsqueda (q), por categoría, o por ambos.
     * Si no se proporcionan filtros, devuelve todas las recetas.
     */
    public static function filtrar($mysqli, $q = null, $categoria = null) {
        // 1. Consulta base. El "WHERE 1=1" es un truco para añadir cláusulas AND fácilmente.
        $sql = "SELECT * FROM recetas WHERE 1=1";
        $params = []; // Array para los valores a vincular
        $types = "";  // String para los tipos de datos (ej. 's' para string, 'i' para integer)

        // 2. Si hay un término de búsqueda de texto, lo añadimos a la consulta
        if ($q && !empty(trim($q))) {
            $sql .= " AND (titulo LIKE ? OR descripcion LIKE ?)";
            $searchTerm = "%" . $q . "%";
            $params[] = $searchTerm;
            $params[] = $searchTerm;
            $types .= "ss"; // dos parámetros de tipo string
        }

        // 3. Si se seleccionó una categoría, la añadimos a la consulta
        if ($categoria && !empty(trim($categoria))) {
            $sql .= " AND categoria = ?";
            $params[] = $categoria;
            $types .= "s"; // un parámetro de tipo string
        }
        
        // Ordenamos para mostrar las más nuevas primero
        $sql .= " ORDER BY created_at DESC";

        // 4. Preparamos y ejecutamos la consulta de forma segura
        $stmt = $mysqli->prepare($sql);

        // Si hay parámetros, los vinculamos a la consulta para evitar inyección SQL
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Obtiene los detalles de una única receta por su ID.
     * (Esta función ya estaba bien, así que la mantenemos igual).
     */
    public static function detalle($mysqli, $id) {
        $stmt = $mysqli->prepare("SELECT * FROM recetas WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}