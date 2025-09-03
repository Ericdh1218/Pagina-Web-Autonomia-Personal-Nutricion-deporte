<header class="gradient-bg text-white shadow-lg">
  <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
    <!-- Logo / Home -->
    <a href="index.php" class="flex items-center space-x-2">
      <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
        <span class="text-2xl">🌟</span>
      </div>
      <h1 class="text-2xl font-bold">VitaBalance</h1>
    </a>

    <!-- Menú navegación -->
    <div class="hidden md:flex space-x-6">
      <a href="#inicio" class="hover:text-blue-200 transition-colors">Inicio</a>
      <a href="#nutricion" class="hover:text-blue-200 transition-colors">Nutrición</a>
      <a href="#deporte" class="hover:text-blue-200 transition-colors">Deporte</a>
      <a href="#herramientas" class="hover:text-blue-200 transition-colors">Herramientas</a>
    </div>

    <!-- Auth: login/logout -->
    <div class="space-x-4">
      <?php if (!empty($_SESSION['user_id'])): ?>
        <span>Hola, <?= e($_SESSION['user_name']) ?></span>
        <a class="underline" href="/index.php?r=logout">Salir</a>
      <?php else: ?>
        <a class="underline" href="/index.php?r=login">Entrar</a>
        <a class="underline" href="/index.php?r=registro">Registro</a>
      <?php endif; ?>
    </div>
  </nav>
</header>
