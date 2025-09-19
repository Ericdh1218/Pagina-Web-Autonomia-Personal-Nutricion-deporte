<header class="gradient-bg text-white shadow-lg sticky top-0 z-50">
  <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
    
    <a href="<?= $BASE ?>index.php?r=inicio" class="flex items-center space-x-2 z-10">
      <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
        <span class="text-2xl">🌟</span>
      </div>
      <h1 class="text-2xl font-bold">VitaBalance</h1>
    </a>

    <button id="menu-toggle" class="md:hidden focus:outline-none text-3xl z-10">
      ☰
    </button>

    <div id="menu" class="
        hidden          
        absolute        md:relative
        top-0 left-0    md:top-auto md:left-auto
        w-full          md:w-auto
        h-screen        md:h-auto
        bg-slate-800    md:bg-transparent
        p-8 pt-24       md:p-0
        flex flex-col   md:flex-row
        items-center
        gap-6
        md:gap-8
        md:flex
      ">
      
      <a href="<?= $BASE ?>index.php?r=inicio" class="hover:text-blue-200">Inicio</a>
      <?php if (!empty($_SESSION['user_id'])): ?>
        <a href="<?= $BASE ?>index.php?r=nutricion" class="hover:text-blue-200">Nutrición</a>
        <a href="<?= $BASE ?>index.php?r=deporte" class="hover:text-blue-200">Deporte</a>
        <a href="<?= $BASE ?>index.php?r=herramientas" class="hover:text-blue-200">Herramientas</a>
        <a href="<?= $BASE ?>index.php?r=Micuenta" class="hover:text-blue-200">Mi cuenta</a>
      <?php else: ?>
        <a href="<?= $BASE ?>index.php?r=login&next=<?= urlencode($BASE . 'index.php?r=nutricion') ?>" class="hover:text-blue-200">Nutrición</a>
        <a href="<?= $BASE ?>index.php?r=login&next=<?= urlencode($BASE . 'index.php?r=deporte') ?>" class="hover:text-blue-200">Deporte</a>
        <a href="<?= $BASE ?>index.php?r=login&next=<?= urlencode($BASE . 'index.php?r=herramientas') ?>" class="hover:text-blue-200">Herramientas</a>
      <?php endif; ?>

      <div class="hidden md:block border-l border-white/50 h-6"></div>

      <div class="flex flex-col md:flex-row items-center gap-4">
        <?php if (!empty($_SESSION['user_id'])): ?>
          <span class="whitespace-nowrap">Hola, <?= e($_SESSION['user_name']) ?></span>
          <a class="underline" href="<?= $BASE ?>index.php?r=logout">Salir</a>
        <?php else: ?>
          <a class="underline" href="<?= $BASE ?>index.php?r=login">Entrar</a>
          <a class="underline" href="<?= $BASE ?>index.php?r=registro">Registro</a>
        <?php endif; ?>
      </div>
    </div>
  </nav>
</header>