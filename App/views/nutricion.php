<div class="container mx-auto px-6 py-8">

    <!-- Saludo personalizado -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">
            Hola, <?= e($_SESSION['user_name'] ?? 'invitado') ?> 👋
        </h1>
        <p class="text-gray-600 mt-2">
            Tu camino hacia una alimentación consciente empieza aquí. Registra tus comidas y lleva tu progreso.
        </p>
    </div>

    <!-- Formulario único para añadir comida -->
    <section class="bg-white rounded-xl shadow p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">➕ Añadir comida</h2>

        <?php if ($m = flash('ok')): ?>
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4"><?= e($m) ?></div>
        <?php endif; ?>
        <?php if ($m = flash('error')): ?>
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4"><?= e($m) ?></div>
        <?php endif; ?>

        <form method="post" action="<?= $BASE ?>index.php?r=comida_agregar"
            class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <input type="date" name="dia" class="border rounded px-3 py-2" required>
            <input type="text" name="comida" placeholder="Ej: Ensalada" class="border rounded px-3 py-2" required>
            <button class="bg-violet-600 text-white px-4 py-2 rounded hover:bg-violet-700">Guardar</button>
        </form>
    </section>

    <!-- Lista de comidas guardadas -->
    <section class="bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">📋 Comidas guardadas</h2>

        <?php if (!empty($comidas)): ?>
            <ul class="divide-y divide-gray-200">
                <?php foreach ($comidas as $c): ?>
                    <?php
                    // Usar date() en lugar de strftime() (para evitar deprecation)
                    $nombreDia = [
                        'Monday' => 'Lunes',
                        'Tuesday' => 'Martes',
                        'Wednesday' => 'Miércoles',
                        'Thursday' => 'Jueves',
                        'Friday' => 'Viernes',
                        'Saturday' => 'Sábado',
                        'Sunday' => 'Domingo'
                    ];
                    $diaIngles = date('l', strtotime($c['dia']));
                    $diaEspanol = $nombreDia[$diaIngles] ?? $diaIngles;
                    ?>
                    <li class="flex justify-between items-center py-2">
                        <span><?= $diaEspanol ?> (<?= $c['dia'] ?>): <?= e($c['comida']) ?></span>
                        <form method="post" action="<?= $BASE ?>index.php?r=comida_eliminar" class="inline">
                            <input type="hidden" name="id" value="<?= $c['id'] ?>">
                            <button class="text-red-600 hover:underline">Eliminar</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="text-gray-500">Aún no has guardado comidas.</p>
        <?php endif; ?>
    </section>

    <!-- Biblioteca -->
    <section>
        <h2 class="text-xl font-semibold text-gray-800 mb-4">📚 Biblioteca de conocimiento</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="bg-gradient-to-r from-purple-400 to-indigo-500 ... cursor-pointer"
                onclick="window.location='<?= $BASE ?>index.php?r=recetario'">
                <h3 class="font-bold text-lg mb-2">Recetario inteligente</h3>
                <p class="text-sm opacity-90">Filtra por tiempo, ingredientes o tipo de dieta.</p>
            </div>


            <a href="<?= $BASE ?>index.php?r=guias"
                class="bg-gradient-to-r from-green-400 to-emerald-500 text-white rounded-xl shadow p-6 hover:shadow-lg block">
                <h3 class="font-bold text-lg mb-2">Guías de nutrición</h3>
                <p class="text-sm opacity-90">Aprende a leer etiquetas y a entender los macros.</p>
            </a>

        </div>
    </section>


</div>

<!-- Columna derecha -->
<div class="space-y-8">

    <!-- Progreso -->
    <section class="bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">📊 Mi progreso consciente</h2>
        <p class="text-gray-600 mb-2">¿Cómo te sientes hoy?</p>
        <div class="flex justify-around text-2xl mb-4">
            <span class="cursor-pointer">😴</span>
            <span class="cursor-pointer">😐</span>
            <span class="cursor-pointer">⚡</span>
            <span class="cursor-pointer">🤩</span>
        </div>
        <p class="text-gray-600 mb-2">Registro de hábitos</p>
        <ul class="space-y-2 text-sm">
            <li><input type="checkbox" checked> Bebí 2 litros de agua</li>
            <li><input type="checkbox" checked> Comí 3+ porciones de vegetales</li>
            <li><input type="checkbox"> Evité ultraprocesados</li>
        </ul>
    </section>

    <!-- Herramientas rápidas -->
    <section class="bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">⚡ Herramientas rápidas</h2>
        <a href="#" class="block bg-violet-100 hover:bg-violet-200 rounded-lg p-3 mb-2 font-semibold text-violet-700">
            📏 Calculadora de calorías
        </a>
        <a href="#" class="block bg-violet-100 hover:bg-violet-200 rounded-lg p-3 font-semibold text-violet-700">
            🍽️ Constructor de plato
        </a>
    </section>

</div>
</div>
</div>