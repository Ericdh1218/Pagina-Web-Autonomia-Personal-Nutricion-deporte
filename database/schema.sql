CREATE DATABASE IF NOT EXISTS NutriUsers CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE NutriUsers;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  correo VARCHAR(100) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  is_admin TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE comidas (
   id INT AUTO_INCREMENT PRIMARY KEY,
   user_id INT NOT NULL,
   dia DATE NOT NULL,
   comida TEXT NOT NULL,
   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
 );
 
 CREATE TABLE recetas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    ingredientes TEXT NOT NULL,
    instrucciones TEXT NOT NULL,
    imagen VARCHAR(255) NOT NULL,
    categoria VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

  CREATE TABLE objetivos (
     id INT AUTO_INCREMENT PRIMARY KEY,
     titulo VARCHAR(100) NOT NULL,
     descripcion TEXT
   );

  CREATE TABLE ejercicios (
   id INT AUTO_INCREMENT PRIMARY KEY,
   nombre VARCHAR(100) NOT NULL,
   categoria VARCHAR(50),
   descripcion TEXT
 );

 CREATE TABLE plan_semanal (
     id INT AUTO_INCREMENT PRIMARY KEY,
     user_id INT NOT NULL,
     dia_semana ENUM('lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo') NOT NULL,
     tipo_comida ENUM('desayuno', 'almuerzo', 'cena') NOT NULL,
     receta_id INT NOT NULL,
     FOREIGN KEY (user_id) REFERENCES users(id),
     FOREIGN KEY (receta_id) REFERENCES recetas(id)
 );