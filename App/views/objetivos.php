

<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">🎯 Objetivos</h1>
        <a href="<?= $BASE ?>index.php?r=inicio" class="bg-violet-600 hover:bg-violet-700 text-white px-4 py-2 rounded-lg shadow">
            ⬅ Volver
        </a>
    </div>

    <div class="space-y-6">
        <?php if (!empty($objetivos)): ?>
            <?php foreach ($objetivos as $objetivo): ?>
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800"><?= htmlspecialchars($objetivo['titulo']) ?></h2>
                    <p class="text-gray-600 mt-2"><?= htmlspecialchars($objetivo['descripcion']) ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-gray-600">Aún no se han añadido objetivos.</p>
        <?php endif; ?>
    </div>
</div>