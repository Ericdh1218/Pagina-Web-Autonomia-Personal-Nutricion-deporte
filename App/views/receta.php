<div class="container mx-auto px-6 py-8">
  <?php if ($receta): ?>
    <h1 class="text-3xl font-bold mb-6 text-gray-800"><?= e($receta['titulo']) ?></h1>

    <?php if (!empty($receta['imagen'])): ?>
      <div class="flex justify-center mb-6">
        <img src="<?= $BASE ?>assets/img/<?= e($receta['imagen']) ?>" 
             alt="<?= e($receta['titulo']) ?>" 
             class="max-w-lg w-full rounded-xl shadow-lg border border-gray-200">
      </div>
    <?php endif; ?>

    <h2 class="text-xl font-semibold mb-3 text-violet-700">📖 Descripción</h2>
    <p class="text-gray-600 mb-6 leading-relaxed"><?= nl2br(e($receta['descripcion'])) ?></p>

    <h2 class="text-xl font-semibold mb-3 text-violet-700">🍴 Ingredientes</h2>
    <div class="bg-gray-50 p-4 rounded-lg shadow-sm mb-6">
      <p class="text-gray-700 whitespace-pre-line"><?= nl2br(e($receta['ingredientes'])) ?></p>
    </div>

    <h2 class="text-xl font-semibold mb-3 text-violet-700">📋 Instrucciones</h2>
    <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
      <p class="text-gray-700 leading-relaxed whitespace-pre-line"><?= nl2br(e($receta['instrucciones'])) ?></p>
    </div>

  <?php else: ?>
    <p class="text-gray-600">Receta no encontrada.</p>
  <?php endif; ?>
</div>
