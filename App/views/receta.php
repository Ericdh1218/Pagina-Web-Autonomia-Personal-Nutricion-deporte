<div class="container mx-auto px-6 py-8">
  <?php if ($receta): ?>

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
      
      <h1 class="text-3xl md:text-4xl font-bold text-gray-800"><?= e($receta['titulo']) ?></h1>

      <a href="<?= $BASE ?>index.php?r=recetario" 
         class="flex items-center justify-center gap-2 w-full sm:w-auto bg-violet-600 hover:bg-violet-700 text-white font-semibold px-4 py-2 rounded-lg shadow transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
          </svg>
          Volver al Recetario
      </a>
    </div>

    <?php if (!empty($receta['imagen'])): ?>
      <div class="flex justify-center my-8">
        <img src="<?= $BASE ?>assets/img/<?= e($receta['imagen']) ?>" 
             alt="<?= e($receta['titulo']) ?>" 
             class="max-w-lg w-full rounded-xl shadow-lg border border-gray-200">
      </div>
    <?php endif; ?>

    <div class="max-w-3xl mx-auto">
        <h2 class="text-2xl font-semibold mb-3 text-violet-700 flex items-center gap-2">📖 Descripción</h2>
        <p class="text-gray-700 mb-8 leading-relaxed"><?= nl2br(e($receta['descripcion'])) ?></p>

        <h2 class="text-2xl font-semibold mb-3 text-violet-700 flex items-center gap-2">🍴 Ingredientes</h2>
        <div class="bg-gray-50 p-6 rounded-lg shadow-inner mb-8 border">
          <div class="text-gray-700 whitespace-pre-line prose"><?= e($receta['ingredientes']) ?></div>
        </div>

        <h2 class="text-2xl font-semibold mb-3 text-violet-700 flex items-center gap-2">📋 Instrucciones</h2>
        <div class="bg-gray-50 p-6 rounded-lg shadow-inner border">
          <div class="text-gray-700 leading-relaxed whitespace-pre-line prose"><?= e($receta['instrucciones']) ?></div>
        </div>
    </div>

  <?php else: ?>
    <div class="text-center py-10">
      <h1 class="text-2xl font-bold text-gray-700">Receta no encontrada</h1>
      <p class="text-gray-500 mt-2">Lo sentimos, la receta que buscas no existe o fue eliminada.</p>
      <a href="<?= $BASE ?>index.php?r=recetario" class="mt-6 inline-block bg-violet-600 text-white px-6 py-2 rounded-lg shadow">
        Volver al Recetario
      </a>
    </div>
  <?php endif; ?>
</div>