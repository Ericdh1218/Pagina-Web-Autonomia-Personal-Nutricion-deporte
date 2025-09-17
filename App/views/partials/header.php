<header class="gradient-bg text-white shadow-lg">
  <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
    <!-- Logo / Home -->
    <a href="<?= $BASE ?>index.php?r=inicio" class="flex items-center space-x-2">
      <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
        <span class="text-2xl">🌟</span>
      </div>
      <h1 class="text-2xl font-bold">VitaBalance</h1>
    </a>

    <!-- Menú navegación -->
    <div class="hidden md:flex space-x-6">
      <a href="<?= $BASE ?>index.php?r=inicio" class="hover:text-blue-200">Inicio</a>

      <?php if (!empty($_SESSION['user_id'])): ?>
        <!-- Usuario logueado: links normales -->
        <a href="<?= $BASE ?>index.php?r=nutricion" class="hover:text-blue-200">Nutrición</a>
        <a href="<?= $BASE ?>index.php?r=deporte" class="hover:text-blue-200">Deporte</a>
        <a href="<?= $BASE ?>index.php?r=herramientas" class="hover:text-blue-200">Herramientas</a>
        <a href="<?= $BASE ?>index.php?r=Micuenta" class="hover:text-blue-200">Micuenta</a>
        
      <?php else: ?>
        <!-- Usuario NO logueado: links redirigen a login con next -->
        <a href="<?= $BASE ?>index.php?r=login&next=<?= urlencode($BASE . 'index.php?r=nutricion') ?>" class="hover:text-blue-200">Nutrición</a>
        <a href="<?= $BASE ?>index.php?r=login&next=<?= urlencode($BASE . 'index.php?r=deporte') ?>" class="hover:text-blue-200">Deporte</a>
        <a href="<?= $BASE ?>index.php?r=login&next=<?= urlencode($BASE . 'index.php?r=herramientas') ?>" class="hover:text-blue-200">Herramientas</a>
      <?php endif; ?>
    </div>

    <!-- Auth -->
    <div class="space-x-4">
      <?php if (!empty($_SESSION['user_id'])): ?>
        <span>Hola, <?= e($_SESSION['user_name']) ?></span>
        <a class="underline" href="<?= $BASE ?>index.php?r=logout">Salir</a>
      <?php else: ?>
        <a class="underline" href="<?= $BASE ?>index.php?r=login">Entrar</a>
        <a class="underline" href="<?= $BASE ?>index.php?r=registro">Registro</a>
      <?php endif; ?>
    </div>
  </nav>
</header>
