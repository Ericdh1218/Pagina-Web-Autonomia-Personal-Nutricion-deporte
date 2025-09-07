<?php
$config = require __DIR__ . '/../database/config.php';

$mysqli = new mysqli(
  $config['db_host'],
  $config['db_user'],
  $config['db_pass'],
  $config['db_name'],
  $config['db_port']
);

if ($mysqli->connect_errno) {
  die('Error MySQL: ' . $mysqli->connect_error);
}

$mysqli->set_charset('utf8mb4');
