<div class="container mx-auto px-6 py-8">
  <h1 class="text-3xl font-bold mb-6">📚 Recetario</h1>

  <!-- Buscador -->
  <form method="get" action="<?= $BASE ?>index.php">
    <input type="hidden" name="r" value="recetario">
    <input type="text" name="q" placeholder="Buscar receta..." class="border p-2 rounded w-1/2">
    <button class="bg-violet-600 text-white px-4 py-2 rounded">Buscar</button>
  </form>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
    <?php if (!empty($recetas)): ?>
      <?php foreach ($recetas as $receta): ?>
        <div class="bg-white shadow rounded p-4">
          <h2 class="text-lg font-bold"><?= e($receta['titulo']) ?></h2>
          <?php if (!empty($receta['imagen'])): ?>
            <img src="<?= $BASE ?>assets/img/<?= e($receta['imagen']) ?>" 
     alt="<?= e($receta['titulo']) ?>" 
     class="rounded mb-2">

          <?php endif; ?>
          <p class="text-sm text-gray-600"><?= substr($receta['descripcion'], 0, 100) ?>...</p>
          <a href="<?= $BASE ?>index.php?r=receta&id=<?= $receta['id'] ?>" 
             class="text-violet-600 font-semibold mt-2 block">Ver más</a>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="col-span-3 text-gray-600">No se encontraron recetas.</p>
    <?php endif; ?>
  </div>
</div>
