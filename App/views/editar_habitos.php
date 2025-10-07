
<div class="container mx-auto px-6 py-16">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-xl border">
        <h1 class="text-3xl font-bold text-center mb-8">Actualizar Mis Hábitos</h1>

        <form method="post" action="<?= $BASE ?>index.php?r=cuestionario_post" class="space-y-6">
            
            <div>
                <label for="nivel_actividad" class="block text-sm font-medium text-gray-700">Nivel de actividad física:</label>
                <select name="nivel_actividad" id="nivel_actividad" required class="mt-1 block w-full ...">
                    <option value="sedentario" <?= ($usuario['nivel_actividad'] ?? '') === 'sedentario' ? 'selected' : '' ?>>Poco o ningún ejercicio</option>
                    <option value="ligero" <?= ($usuario['nivel_actividad'] ?? '') === 'ligero' ? 'selected' : '' ?>>Ejercicio ligero (1-2 días/semana)</option>
                    <option value="activo" <?= ($usuario['nivel_actividad'] ?? '') === 'activo' ? 'selected' : '' ?>>Ejercicio moderado (3-5 días/semana)</option>
                    <option value="muy_activo" <?= ($usuario['nivel_actividad'] ?? '') === 'muy_activo' ? 'selected' : '' ?>>Ejercicio intenso (6-7 días/semana)</option>
                </select>
            </div>

            <div>
                <label for="objetivo_principal" class="block text-sm font-medium text-gray-700">Objetivo principal:</label>
                <input type="text" name="objetivo_principal" value="<?= e($usuario['objetivo_principal'] ?? '') ?>" class="mt-1 block w-full ...">
            </div>
            
            <div>
                <label for="nivel_alimentacion" class="block text-sm font-medium text-gray-700">Relación con la comida:</label>
                <select name="nivel_alimentacion" id="nivel_alimentacion" required class="mt-1 block w-full ...">
                    <option value="novato" <?= ($usuario['nivel_alimentacion'] ?? '') === 'novato' ? 'selected' : '' ?>>Aún no le presto mucha atención.</option>
                    <option value="aprendiendo" <?= ($usuario['nivel_alimentacion'] ?? '') === 'aprendiendo' ? 'selected' : '' ?>>Estoy aprendiendo a tomar mejores decisiones.</option>
                    <option value="consciente" <?= ($usuario['nivel_alimentacion'] ?? '') === 'consciente' ? 'selected' : '' ?>>Suelo tomar decisiones conscientes.</option>
                    <option value="autonomo" <?= ($usuario['nivel_alimentacion'] ?? '') === 'autonomo' ? 'selected' : '' ?>>Me siento con total autonomía.</option>
                </select>
            </div>

            <div>
                <label for="horas_sueno" class="block text-sm font-medium text-gray-700">Horas de sueño promedio:</label>
                <input type="number" name="horas_sueno" value="<?= e($usuario['horas_sueno'] ?? '') ?>" class="mt-1 block w-full ...">
            </div>

            <div>
                <label for="consumo_agua" class="block text-sm font-medium text-gray-700">Vasos de agua al día:</label>
                <input type="number" name="consumo_agua" value="<?= e($usuario['consumo_agua'] ?? '') ?>" class="mt-1 block w-full ...">
            </div>

            <div>
                <button type="submit" class="w-full ... bg-violet-600 ...">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>