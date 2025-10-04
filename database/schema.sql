CREATE DATABASE IF NOT EXISTS NutriUsers CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE NutriUsers;

-- --------------------------------------------------------
-- TABLAS PRINCIPALES (SIN DEPENDENCIAS EXTERNAS)
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    is_admin TINYINT(1) NOT NULL DEFAULT 0,
    peso DECIMAL(5,2) NULL,
    altura DECIMAL(5,1) NULL,
    imc DECIMAL(5,1) NULL,
    nivel_actividad ENUM('sedentario', 'ligero', 'activo', 'muy_activo') NULL,
    objetivo_principal VARCHAR(255) NULL,
    nivel_alimentacion ENUM('novato', 'aprendiendo', 'consciente', 'autonomo') NULL,
    horas_sueno INT NULL,
    consumo_agua INT NULL,
    password_reset_token VARCHAR(255) NULL,
    password_reset_expires DATETIME NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS recetas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT,
    ingredientes TEXT,
    instrucciones TEXT,
    imagen VARCHAR(255) NULL,
    categoria ENUM('pre entreno', 'post entreno', 'intra entreno', 'antes de dormir', 'comida de descanso') NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- TABLA DE EJERCICIOS ACTUALIZADA CON MÚLTIPLES CATEGORÍAS
CREATE TABLE IF NOT EXISTS ejercicios (
   id INT AUTO_INCREMENT PRIMARY KEY,
   nombre VARCHAR(100) NOT NULL,
   grupo_muscular ENUM('Tren Superior', 'Tren Inferior', 'Core', 'Cuerpo Completo') NOT NULL,
   tipo_entrenamiento ENUM('Fuerza', 'Cardio', 'Flexibilidad', 'Calentamiento') NOT NULL,
   equipamiento ENUM('Sin Equipo', 'Equipo Ligero', 'Gimnasio') NOT NULL,
   descripcion TEXT,
   media_url VARCHAR(255) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS objetivos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    descripcion TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS rutinas_prediseñadas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_rutina VARCHAR(255) NOT NULL,
    descripcion TEXT,
    nivel ENUM('principiante', 'intermedio', 'avanzado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------
-- TABLAS SECUNDARIAS (CON DEPENDENCIAS / FOREIGN KEYS)
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS comidas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    dia DATE NOT NULL,
    comida TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS plan_semanal (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    dia_semana ENUM('lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo') NOT NULL,
    tipo_comida ENUM('desayuno', 'almuerzo', 'cena') NOT NULL,
    receta_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (receta_id) REFERENCES recetas(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS rutina_prediseñada_ejercicios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rutina_id INT NOT NULL,
    ejercicio_id INT NOT NULL,
    series_reps VARCHAR(50),
    FOREIGN KEY (rutina_id) REFERENCES rutinas_prediseñadas(id) ON DELETE CASCADE,
    FOREIGN KEY (ejercicio_id) REFERENCES ejercicios(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;