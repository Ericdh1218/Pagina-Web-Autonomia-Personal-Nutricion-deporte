<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>VitaBalance</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- OJO: paths absolutos desde /Public como raíz -->
  <link rel="stylesheet" href="/ProyectoAutonomiaPersonal/Public/assets/css/main.css">
  <link rel="stylesheet" href="<?= $BASE ?>assets/css/main.css">
<script src="<?= $BASE ?>assets/js/main.js?v=1.1"></script>

</head>
<body class="bg-gray-50">
  <?php if(file_exists(__DIR__.'/../partials/header.php')) require __DIR__.'/../partials/header.php'; ?>

  <main class="container mx-auto px-6 py-8">
    <?= $contenido ?? '' ?>
  </main>

  <?php if(file_exists(__DIR__.'/../partials/footer.php')) require __DIR__.'/../partials/footer.php'; ?>
  <script src="/ProyectoAutonomiaPersonal/Public/assets/js/main.js?v=1.1"></script>
</body>
</html>
