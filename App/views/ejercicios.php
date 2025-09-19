

<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">💪 Biblioteca de Ejercicios</h1>
        <a href="<?= $BASE ?>index.php?r=inicio" class="bg-violet-600 hover:bg-violet-700 text-white px-4 py-2 rounded-lg shadow">
            ⬅ Volver
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (!empty($ejercicios)): ?>
            <?php foreach ($ejercicios as $ejercicio): ?>
                <div class="bg-white shadow rounded-lg p-6">
                    <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded-full mb-3">
                        <?= htmlspecialchars($ejercicio['categoria']) ?>
                    </span>
                    <h2 class="text-xl font-bold text-gray-800"><?= htmlspecialchars($ejercicio['nombre']) ?></h2>
                    <p class="text-gray-600 mt-2"><?= htmlspecialchars($ejercicio['descripcion']) ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="col-span-full text-gray-600">Aún no se han añadido ejercicios.</p>
        <?php endif; ?>
    </div>
</div>