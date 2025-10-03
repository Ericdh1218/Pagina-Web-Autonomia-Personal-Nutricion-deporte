<div class="container mx-auto px-6 py-12">
    <div class="max-w-4xl mx-auto">

        <a href="<?= $BASE ?>index.php?r=deporte" class="text-violet-600 hover:underline mb-6 inline-block">← Volver a la biblioteca</a>

        <div class="bg-white p-8 rounded-2xl shadow-xl">
            <span class="text-sm font-semibold uppercase text-violet-500"><?= e($ejercicio['categoria']) ?></span>
            <h1 class="text-4xl font-bold text-gray-800 mt-2 mb-6"><?= e($ejercicio['nombre']) ?></h1>

            <div class="mb-8 rounded-lg overflow-hidden border">
                <?php 
                    // --- ESTA ES LA LÍNEA CORREGIDA ---
                    // Asegúrate de que la ruta apunte a 'assets/img/'
                    $imagePath = $BASE . 'assets/img/' . e($ejercicio['media_url'] ?? 'placeholder.jpg');
                ?>
                <img src="<?= $imagePath ?>" alt="<?= e($ejercicio['nombre']) ?>" class="w-full">
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">Instrucciones</h2>
                <div class="prose max-w-none text-gray-600 text-lg">
                    <p><?= nl2br(e($ejercicio['descripcion'])) ?></p>
                </div>
            </div>
        </div>

    </div>
</div>