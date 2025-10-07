<div class="container mx-auto px-6 py-8">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-2">Mi Centro de Deporte</h1>
        <p class="text-lg text-gray-600">Tu espacio para entrenar con autonomía.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto mb-16">
    
    <button onclick="toggleSection('rutina-sugerida')" class="text-left bg-violet-600 text-white p-8 rounded-2xl shadow-lg hover:bg-violet-700 transition-transform transform hover:scale-105">
        <h2 class="text-2xl font-bold mb-2">🎯 Ver mi Rutina Sugerida</h2>
        <p class="opacity-90">Un plan diseñado para tu nivel actual.</p>
    </button>
    <button onclick="toggleSection('mis-rutinas')" class="text-left bg-blue-600 text-white p-8 rounded-2xl shadow-lg hover:bg-blue-700 transition-transform transform hover:scale-105">
        <h2 class="text-2xl font-bold mb-2">📋 Mis Rutinas Guardadas</h2>
        <p class="opacity-90">Accede a los entrenamientos que tú creaste.</p>
    </button>

    <a href="<?= $BASE ?>index.php?r=crear_rutina" class="block text-left bg-green-600 text-white p-8 rounded-2xl shadow-lg hover:bg-green-700 transition-transform transform hover:scale-105">
        <h2 class="text-2xl font-bold mb-2">✍️ Crear mi Propia Rutina</h2>
        <p class="opacity-90">Conviértete en tu propio entrenador.</p>
    </a>
    <a href="<?= $BASE ?>index.php?r=biblioteca" class="block text-left bg-gray-800 text-white p-8 rounded-2xl shadow-lg hover:bg-gray-900 transition-transform transform hover:scale-105">
        <h2 class="text-2xl font-bold mb-2">📚 Explorar Biblioteca</h2>
        <p class="opacity-90">Busca y aprende nuevos ejercicios.</p>
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
                                     class="w-16 h-16 object-contain rounded-md border">
                                     
                                <div>
                                    <p class="font-semibold text-lg"><?= e($ejercicio['nombre']) ?></p>
                                    <p class="text-gray-500"><?= e($ejercicio['series_reps']) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="mt-8 text-center bg-violet-50 p-4 rounded-lg">
            <p class="text-gray-700">¿Sientes que esta rutina es muy fácil o muy difícil?</p>
            <p class="text-sm text-gray-500 mb-3">Actualiza tu nivel para recibir nuevas sugerencias.</p>
            <form method="post" action="<?= $BASE ?>index.php?r=actualizar_nivel" class="inline-flex items-center gap-2">
                <select name="nuevo_nivel" class="border border-gray-300 rounded-md px-3 py-1">
                    <option value="sedentario" <?= $nivelActual === 'sedentario' ? 'selected' : '' ?>>Principiante</option>
                    <option value="ligero" <?= $nivelActual === 'ligero' ? 'selected' : '' ?>>Principiante+</option>
                    <option value="activo" <?= $nivelActual === 'activo' ? 'selected' : '' ?>>Intermedio</option>
                    <option value="muy_activo" <?= $nivelActual === 'muy_activo' ? 'selected' : '' ?>>Avanzado</option>
                </select>
                <button type="submit" class="bg-violet-600 text-white px-4 py-1 rounded-md hover:bg-violet-700">Guardar</button>
            </form>
        </div>

            </div>
        <?php endif; ?>
    </div>
    <div class="max-w-4xl mx-auto mb-12">
    <div class="text-center border-t pt-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">O explora otras rutinas...</h2>
        <p class="text-lg text-gray-600">Aquí tienes todas las rutinas prediseñadas disponibles para ti.</p>
    </div>

    <div class="space-y-8 mt-8">
        <?php foreach ($todasLasRutinas as $rutina): ?>
            <div class="bg-white p-6 rounded-2xl shadow-lg border">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-2xl font-bold text-violet-700"><?= e($rutina['nombre_rutina']) ?></h3>
                        <p class="text-gray-500 capitalize mt-1">Nivel: <?= e($rutina['nivel']) ?></p>
                    </div>
                    </div>
                <p class="text-gray-600 mt-4 mb-6"><?= e($rutina['descripcion']) ?></p>
                
                <div class="space-y-3 border-t pt-4">
                    <?php foreach ($rutina['ejercicios'] as $ejercicio): ?>
                        <div class="flex items-center gap-4 text-sm">
                            <p class="font-semibold text-gray-700 w-2/3"><?= e($ejercicio['nombre']) ?></p>
                            <p class="text-gray-500 w-1/3"><?= e($ejercicio['series_reps']) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div id="mis-rutinas" class="hidden">
    <div class="max-w-4xl mx-auto mb-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Mis Rutinas Personalizadas</h2>
        
        <?php if (empty($misRutinas)): ?>
            <div class="text-center bg-white p-8 rounded-lg border">
                <p class="text-gray-600">Aún no has creado ninguna rutina.</p>
                <a href="<?= $BASE ?>index.php?r=crear_rutina" class="mt-4 inline-block bg-green-600 text-white font-semibold px-6 py-2 rounded-lg">¡Crea tu primera rutina!</a>
            </div>
        <?php else: ?>
            <div class="space-y-8">
                <?php foreach ($misRutinas as $rutina): ?>
                    <div class="bg-white p-6 rounded-2xl shadow-lg border">
                        <h3 class="text-2xl font-bold text-blue-700 mb-4"><?= e($rutina['nombre_rutina']) ?></h3>
                        <div class="space-y-4 border-t pt-4">
                            <?php foreach ($rutina['ejercicios'] as $ejercicio): ?>
                                <div class="flex items-center gap-4 p-2">
                                    <img src="<?= $BASE ?>assets/img/<?= e($ejercicio['media_url']) ?>" alt="<?= e($ejercicio['nombre']) ?>" class="w-12 h-12 object-cover rounded-md border">
                                    <p class="font-semibold text-lg"><?= e($ejercicio['nombre']) ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
</div>

<script>
    function toggleSection(sectionId) {
        // Lista de todas las secciones que se pueden ocultar/mostrar
        const allSections = ['rutina-sugerida', 'mis-rutinas'];
        const targetSection = document.getElementById(sectionId);

        if (!targetSection) return; // Si no se encuentra la sección, no hacer nada

        // Ocultar todas las secciones excepto la que fue seleccionada
        allSections.forEach(id => {
            const section = document.getElementById(id);
            if (section && id !== sectionId) {
                section.classList.add('hidden');
            }
        });
        
        // Alternar la visibilidad de la sección seleccionada
        targetSection.classList.toggle('hidden');

        // Si la sección se acaba de mostrar, hacer scroll hacia ella
        if (!targetSection.classList.contains('hidden')) {
            targetSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }
</script>
