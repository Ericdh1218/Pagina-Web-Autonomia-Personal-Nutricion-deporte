<?php
$config = require __DIR__ . '/config.php'; // crea config.php copiando este example y poniendo tu pass real
$mysqli = new mysqli(
  $config['db_host'],
  $config['db_user'],
  $config['db_pass'],
  $config['db_name'],
  $config['db_port']
);
if ($mysqli->connect_error) { die('Error de conexión: ' . $mysqli->connect_error); }
$mysqli->set_charset('utf8mb4');
