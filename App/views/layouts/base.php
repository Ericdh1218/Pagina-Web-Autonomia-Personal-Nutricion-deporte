<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VitaBalance</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $BASE ?>assets/css/main.css">
</head>
<body class="bg-gray-50">

    <?php if(file_exists(__DIR__.'/../partials/header.php')) require __DIR__.'/../partials/header.php'; ?>

    <main>
        <?= $contenido ?? '' ?>
    </main>

    <?php if(file_exists(__DIR__.'/../partials/footer.php')) require __DIR__.'/../partials/footer.php'; ?>

    <!-- En App/views/layouts/base.php, antes de cargar main.js -->
<script>
    const userIsLoggedIn = <?= isset($_SESSION['user_id']) ? 'true' : 'false' ?>;
    const BASE = '<?= $BASE ?>'; // Añade esta línea
</script>

<script src="<?= $BASE ?>assets/js/main.js?v=1.2"></script> <!-- Aumenta la versión para evitar caché -->

</body>
</html>