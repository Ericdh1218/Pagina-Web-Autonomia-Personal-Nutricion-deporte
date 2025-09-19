<div class="container mx-auto px-6 py-8">

  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center mb-8">
    
    <div>
      <h1 class="text-3xl font-bold">📚 Recetario</h1>
      <form method="get" action="<?= $BASE ?>index.php" class="flex gap-2 mt-4">
        <input type="hidden" name="r" value="recetario">
        <input type="text" name="q" placeholder="Buscar receta..." class="border p-2 rounded w-full">
        <button class="bg-violet-600 text-white px-6 py-2 rounded">Buscar</button>
      </form>
    </div>

    <div class="flex items-center justify-start md:justify-end gap-3">
      <a href="<?= $BASE ?>index.php?r=inicio"
         class="text-center bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg shadow-sm">
         Volver al inicio
      </a>

      <a href="<?= $BASE ?>index.php?r=nutricion"
         class="text-center bg-violet-600 hover:bg-violet-700 text-white font-semibold px-4 py-2 rounded-lg shadow">
         Ir a Nutrición
      </a>
    </div>
  </div>

  </div>


  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
    <?php if (!empty($recetas)): ?>
      <?php foreach ($recetas as $receta): ?>
        <div class="bg-white shadow rounded p-4">
          <h2 class="text-lg font-bold"><?= e($receta['titulo']) ?></h2>
          <?php if (!empty($receta['imagen'])): ?>
            <a href="<?= $BASE ?>index.php?r=receta&id=<?= $receta['id'] ?>">
              <img src="<?= $BASE ?>assets/img/<?= e($receta['imagen']) ?>" alt="<?= e($receta['titulo']) ?>"
                class="rounded mb-2">
            </a>
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