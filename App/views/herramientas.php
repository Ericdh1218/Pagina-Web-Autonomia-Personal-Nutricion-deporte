

<div class="container mx-auto px-6 py-12">
    <div class="mb-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-2">Herramientas de Autonomía</h1>
        <p class="text-lg text-gray-600">Calculadoras y utilidades para potenciar tus decisiones.</p>
    </div>

    <div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-xl border">
        <h2 class="text-3xl font-bold text-violet-700 mb-6">Calculadora de Calorías y Macronutrientes</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label for="calc-age" class="block font-medium text-gray-700">Edad</label>
                <input type="number" id="calc-age" placeholder="Ej: 25" class="mt-1 w-full border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <div>
                <label for="calc-gender" class="block font-medium text-gray-700">Sexo</label>
                <select id="calc-gender" class="mt-1 w-full border-gray-300 rounded-md shadow-sm p-2">
                    <option value="male">Masculino</option>
                    <option value="female">Femenino</option>
                </select>
            </div>
            <div>
                <label for="calc-weight" class="block font-medium text-gray-700">Peso (kg)</label>
                <input type="number" id="calc-weight" placeholder="Ej: 70" class="mt-1 w-full border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <div>
                <label for="calc-height" class="block font-medium text-gray-700">Altura (cm)</label>
                <input type="number" id="calc-height" placeholder="Ej: 175" class="mt-1 w-full border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <div>
                <label for="calc-activity" class="block font-medium text-gray-700">Nivel de Actividad</label>
                <select id="calc-activity" class="mt-1 w-full border-gray-300 rounded-md shadow-sm p-2">
                    <option value="1.2">Sedentario (poco o ningún ejercicio)</option>
                    <option value="1.375">Actividad Ligera (1-2 días/semana)</option>
                    <option value="1.55">Actividad Moderada (3-5 días/semana)</option>
                    <option value="1.725">Actividad Intensa (6-7 días/semana)</option>
                    <option value="1.9">Actividad Muy Intensa (trabajo físico/entrenamiento diario)</option>
                </select>
            </div>
            <div>
                <label for="calc-goal" class="block font-medium text-gray-700">Tu Objetivo</label>
                <select id="calc-goal" class="mt-1 w-full border-gray-300 rounded-md shadow-sm p-2">
                    <option value="lose">Perder peso</option>
                    <option value="maintain" selected>Mantener peso</option>
                    <option value="gain">Ganar peso</option>
                </select>
            </div>
        </div>

        <button onclick="calculateMacros()" class="w-full bg-violet-600 text-white font-semibold py-3 rounded-lg hover:bg-violet-700 transition">
            Calcular mis necesidades
        </button>

        <div id="macro-results" class="hidden mt-8 border-t pt-8">
            <h3 class="text-2xl font-bold text-center text-gray-800 mb-4">Tus Resultados Estimados</h3>
            <div class="bg-violet-50 p-6 rounded-xl border border-violet-200">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                    <div>
                        <p class="text-sm text-gray-500">Calorías / día</p>
                        <p id="result-calories" class="text-2xl font-bold text-violet-600"></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Proteínas</p>
                        <p id="result-protein" class="text-2xl font-bold text-gray-800"></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Carbohidratos</p>
                        <p id="result-carbs" class="text-2xl font-bold text-gray-800"></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Grasas</p>
                        <p id="result-fats" class="text-2xl font-bold text-gray-800"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-xl border mt-12">
    <h2 class="text-3xl font-bold text-violet-700 mb-6">Cronómetro de Intervalos (HIIT/Tabata)</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 p-6 bg-gray-50 rounded-lg border">
        <div>
            <label for="work-time" class="block font-medium text-gray-700">Tiempo de Trabajo (seg)</label>
            <input type="number" id="work-time" value="20" class="mt-1 w-full border-gray-300 rounded-md shadow-sm p-2">
        </div>
        <div>
            <label for="rest-time" class="block font-medium text-gray-700">Tiempo de Descanso (seg)</label>
            <input type="number" id="rest-time" value="10" class="mt-1 w-full border-gray-300 rounded-md shadow-sm p-2">
        </div>
        <div>
            <label for="rounds" class="block font-medium text-gray-700">Número de Rondas</label>
            <input type="number" id="rounds" value="8" class="mt-1 w-full border-gray-300 rounded-md shadow-sm p-2">
        </div>
    </div>

    <div class="text-center bg-gray-800 text-white p-8 rounded-lg">
        <p id="timer-status" class="text-2xl font-semibold uppercase tracking-widest text-violet-400 mb-2">Presiona Iniciar</p>
        <p id="timer-display" class="text-8xl font-bold tracking-tighter">00:00</p>
        <p id="timer-rounds" class="text-xl mt-2 text-gray-400">Ronda 0 / 0</p>
    </div>

    <div class="grid grid-cols-3 gap-4 mt-8">
        <button id="start-btn" onclick="startHiitTimer()" class="bg-green-500 text-white font-semibold py-3 rounded-lg hover:bg-green-600 transition">Iniciar</button>
        <button id="pause-btn" onclick="pauseHiitTimer()" class="bg-yellow-500 text-white font-semibold py-3 rounded-lg hover:bg-yellow-600 transition" disabled>Pausar</button>
        <button id="reset-btn" onclick="resetHiitTimer()" class="bg-red-500 text-white font-semibold py-3 rounded-lg hover:bg-red-600 transition" disabled>Reiniciar</button>
    </div>
</div>
 <div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-xl border mt-12">
    <h2 class="text-3xl font-bold text-violet-700 mb-6">Calculadora de 1RM (Repetición Máxima)</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div>
            <label for="1rm-weight" class="block font-medium text-gray-700">Peso Levantado (kg)</label>
            <input type="number" id="1rm-weight" placeholder="Ej: 80" class="mt-1 w-full border-gray-300 rounded-md shadow-sm p-2">
        </div>
        <div>
            <label for="1rm-reps" class="block font-medium text-gray-700">Repeticiones Realizadas</label>
            <input type="number" id="1rm-reps" placeholder="Ej: 5" class="mt-1 w-full border-gray-300 rounded-md shadow-sm p-2">
        </div>
    </div>

    <button onclick="calculate1RM()" class="w-full bg-violet-600 text-white font-semibold py-3 rounded-lg hover:bg-violet-700 transition">
        Calcular mi 1RM
    </button>

    <div id="1rm-results" class="hidden mt-8 border-t pt-8">
        <div class="text-center">
            <p class="text-lg text-gray-600">Tu 1RM estimado es:</p>
            <p id="1rm-value" class="text-6xl font-bold text-violet-600 my-2"></p>
            <p class="text-sm text-gray-500">(Basado en la fórmula de Brzycki)</p>
        </div>
        
        <div class="mt-8">
            <h4 class="text-xl font-semibold text-center text-gray-700 mb-4">Zonas de Entrenamiento (Pesos sugeridos)</h4>
            <div id="1rm-percentages" class="space-y-2">
                </div>
        </div>
    </div>
</div>

<div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-xl border mt-12">
    <h2 class="text-3xl font-bold text-violet-700 mb-6">Buscador de Sustitutos de Ejercicios</h2>
    
    <div class="mb-6">
        <label for="exercise-search" class="block font-medium text-gray-700">Busca un ejercicio para encontrar alternativas:</label>
        <div class="flex items-center mt-1">
            <input type="text" id="exercise-search" placeholder="Ej: Press de banca" onkeyup="findSubstitutes()" class="w-full border-gray-300 rounded-md shadow-sm p-3 text-lg">
        </div>
    </div>

    <div id="substitute-results" class="hidden border-t pt-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Alternativas sugeridas:</h3>
        <div id="substitutes-list" class="space-y-4">
            </div>
    </div>
</div>

<div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-xl border mt-12">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-violet-700">Diario de Hábitos</h2>
        <input type="date" id="habits-date" value="<?= date('Y-m-d') ?>" class="border-gray-300 rounded-md shadow-sm p-2">
    </div>
    
    <div id="habits-list" class="space-y-4">
        <label class="flex items-center justify-between p-4 bg-gray-50 rounded-lg cursor-pointer hover:bg-gray-100">
            <div class="flex items-center">
                <input type="checkbox" data-habito="agua" class="h-6 w-6 rounded text-violet-600" <?= !empty($habitosHoy['agua_cumplido']) ? 'checked' : '' ?>>
                <span class="ml-4 text-lg font-medium">Bebí suficiente agua</span>
            </div>
            <span class="text-sm text-gray-500">Meta: <?= e($usuario['consumo_agua'] ?? '8') ?> vasos</span>
        </label>

        <label class="flex items-center justify-between p-4 bg-gray-50 rounded-lg cursor-pointer hover:bg-gray-100">
            <div class="flex items-center">
                <input type="checkbox" data-habito="sueno" class="h-6 w-6 rounded text-violet-600" <?= !empty($habitosHoy['sueno_cumplido']) ? 'checked' : '' ?>>
                <span class="ml-4 text-lg font-medium">Dormí bien</span>
            </div>
            <span class="text-sm text-gray-500">Meta: <?= e($usuario['horas_sueno'] ?? '7-8') ?> horas</span>
        </label>

        <label class="flex items-center justify-between p-4 bg-gray-50 rounded-lg cursor-pointer hover:bg-gray-100">
            <div class="flex items-center">
                <input type="checkbox" data-habito="entrenamiento" class="h-6 w-6 rounded text-violet-600" <?= !empty($habitosHoy['entrenamiento_cumplido']) ? 'checked' : '' ?>>
                <span class="ml-4 text-lg font-medium">Entrené hoy</span>
            </div>
            <span class="text-sm text-gray-500">Meta: Nivel <?= e($usuario['nivel_actividad'] ?? 'activo') ?></span>
        </label>

        <label class="flex items-center justify-between p-4 bg-gray-50 rounded-lg cursor-pointer hover:bg-gray-100">
            <div class="flex items-center">
                <input type="checkbox" data-habito="alimentacion" class="h-6 w-6 rounded text-violet-600" <?= !empty($habitosHoy['alimentacion_cumplida']) ? 'checked' : '' ?>>
                <span class="ml-4 text-lg font-medium">Comí de forma consciente</span>
            </div>
            <span class="text-sm text-gray-500">Meta: Nivel <?= e($usuario['nivel_alimentacion'] ?? 'consciente') ?></span>
        </label>
    </div>
    <div id="habits-feedback" class="text-right text-sm text-gray-400 mt-4 h-4"></div>
</div>

<div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-xl border mt-12">
    <h2 class="text-3xl font-bold text-violet-700 mb-6">Registro de Medidas Corporales</h2>
    <div id="measurement-feedback" class="mb-4"></div>
    
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 items-end p-4 bg-gray-50 rounded-lg border mb-8">
        <div>
            <label for="medida-fecha" class="text-sm font-medium text-gray-700">Fecha</label>
            <input type="date" id="medida-fecha" value="<?= date('Y-m-d') ?>" class="w-full border-gray-300 rounded-md p-2 mt-1">
        </div>
        <div>
            <label for="medida-peso" class="text-sm font-medium text-gray-700">Peso (kg)</label>
            <input type="number" id="medida-peso" placeholder="70.5" class="w-full border-gray-300 rounded-md p-2 mt-1">
        </div>
        <div>
            <label for="medida-cintura" class="text-sm font-medium text-gray-700">Cintura (cm)</label>
            <input type="number" id="medida-cintura" placeholder="80" class="w-full border-gray-300 rounded-md p-2 mt-1">
        </div>
        <div>
            <label for="medida-cadera" class="text-sm font-medium text-gray-700">Cadera (cm)</label>
            <input type="number" id="medida-cadera" placeholder="95" class="w-full border-gray-300 rounded-md p-2 mt-1">
        </div>
        <button onclick="saveMeasurements()" class="w-full bg-violet-600 text-white font-semibold py-2 rounded-lg hover:bg-violet-700 transition h-11">
            Guardar
        </button>
    </div>

    <div>
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Mi Historial</h3>
        <div id="measurements-history" class="space-y-2">
            <?php if (empty($historialMedidas)): ?>
                <p id="no-history-msg" class="text-gray-500">Aún no has guardado ninguna medida.</p>
            <?php else: ?>
                <?php foreach ($historialMedidas as $registro): ?>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 p-3 bg-gray-50 rounded-lg">
                        <p><span class="font-semibold">Fecha:</span> <?= e(date('d/m/Y', strtotime($registro['fecha']))) ?></p>
                        <p><span class="font-semibold">Peso:</span> <?= e($registro['peso']) ?> kg</p>
                        <p><span class="font-semibold">Cintura:</span> <?= e($registro['cintura']) ?> cm</p>
                        <p><span class="font-semibold">Cadera:</span> <?= e($registro['cadera']) ?> cm</p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    // Convierte el array de ejercicios de PHP a un objeto de JavaScript
    const todosLosEjercicios = <?= json_encode($ejercicios) ?>;
</script>