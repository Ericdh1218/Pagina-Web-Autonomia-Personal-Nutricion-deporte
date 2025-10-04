<div class="container mx-auto px-6 py-8">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-2">Mi Centro de Deporte</h1>
        <p class="text-lg text-gray-600">Tu espacio para entrenar con autonomía.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto mb-16">
        
        <button onclick="toggleSection('rutina-sugerida')" class="text-left bg-violet-600 text-white p-8 rounded-2xl shadow-lg hover:bg-violet-700 transition-transform transform hover:scale-105 focus:outline-none">
            <h2 class="text-2xl font-bold mb-2">🎯 Ver mi Rutina Sugerida</h2>
            <p class="opacity-90">Comienza con un plan diseñado para tu nivel actual.</p>
        </button>

        <a href="<?= $BASE ?>index.php?r=biblioteca" class="block text-left bg-gray-800 text-white p-8 rounded-2xl shadow-lg hover:bg-gray-900 transition-transform transform hover:scale-105">
            <h2 class="text-2xl font-bold mb-2">📚 Explorar Biblioteca de Ejercicios</h2>
            <p class="opacity-90">Busca y filtra entre docenas de ejercicios para aprender y construir.</p>
        </a>
    </div>

    <div id="rutina-sugerida" class="hidden">
        <?php if ($rutinaSugerida): ?>
            <div class="max-w-4xl mx-auto mb-12 bg-white p-6 sm:p-8 rounded-2xl shadow-lg border">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Tu Rutina Sugerida</h2>
                <p class="text-gray-600 mb-6">Basada en tu nivel <span class="font-semibold text-violet-600 capitalize"><?= e($nivelActual) ?></span>, te recomendamos esta rutina.</p>

                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-2xl font-bold text-violet-700 mb-4"><?= e($rutinaSugerida['nombre_rutina']) ?></h3>
                    <div class="space-y-4">
                        <?php foreach ($rutinaSugerida['ejercicios'] as $ejercicio): ?>
                            <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-lg">
                                <img src="<?= $BASE ?>assets/img/<?= e($ejercicio['media_url']) ?>" alt="<?= e($ejercicio['nombre']) ?>"
                                     class="w-16 h-16 object-cover rounded-md border">
                                <div>
                                    <p class="font-semibold text-lg"><?= e($ejercicio['nombre']) ?></p>
                                    <p class="text-gray-500"><?= e($ejercicio['series_reps']) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    function toggleSection(sectionId) {
        const section = document.getElementById(sectionId);
        if (section) {
            // Si la sección ya está visible, la oculta. Si está oculta, la muestra.
            section.classList.toggle('hidden');

            // Si la sección se acaba de mostrar, hace scroll hacia ella.
            if (!section.classList.contains('hidden')) {
                section.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }
    }
</script>
