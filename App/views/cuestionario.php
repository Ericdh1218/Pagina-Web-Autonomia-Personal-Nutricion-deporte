
<div class="container mx-auto px-6 py-16">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-xl border">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-2">¡Bienvenido/a! Un último paso</h1>
        <p class="text-center text-gray-600 mb-8">Ayúdanos a personalizar tu experiencia en VitaBalance.</p>

        <form method="post" action="<?= $BASE ?>index.php?r=cuestionario_post" class="space-y-6">
            
            <div>
                <label for="nivel_actividad" class="block text-sm font-medium text-gray-700">1. ¿Cuál es tu nivel de actividad física semanal?</label>
                <select name="nivel_actividad" id="nivel_actividad" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
                    <option value="sedentario">Poco o ningún ejercicio</option>
                    <option value="ligero">Ejercicio ligero (1-2 días/semana)</option>
                    <option value="activo">Ejercicio moderado (3-5 días/semana)</option>
                    <option value="muy_activo">Ejercicio intenso (6-7 días/semana)</option>
                </select>
            </div>

            <div>
                <label for="objetivo_principal" class="block text-sm font-medium text-gray-700">2. ¿Cuál es tu objetivo principal?</label>
                <input type="text" name="objetivo_principal" id="objetivo_principal" placeholder="Ej: Perder 5 kg, correr 10k, etc." required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
            </div>
            
            <div>
                <label for="nivel_alimentacion" class="block text-sm font-medium text-gray-700">3. Desde una perspectiva de autonomía, ¿cómo describirías tu relación con la comida?</label>
                <select name="nivel_alimentacion" id="nivel_alimentacion" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
                    <option value="novato">Aún no le presto mucha atención.</option>
                    <option value="aprendiendo">Estoy aprendiendo a tomar mejores decisiones.</option>
                    <option value="consciente">Suelo tomar decisiones conscientes sobre lo que como.</option>
                    <option value="autonomo">Me siento con total autonomía en mi nutrición.</option>
                </select>
            </div>

            <div>
                <label for="horas_sueno" class="block text-sm font-medium text-gray-700">4. ¿Cuántas horas duermes en promedio por noche?</label>
                <input type="number" name="horas_sueno" id="horas_sueno" min="1" max="16" placeholder="Ej: 8" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="consumo_agua" class="block text-sm font-medium text-gray-700">5. ¿Cuántos vasos de agua (250ml) bebes al día?</label>
                <input type="number" name="consumo_agua" id="consumo_agua" min="0" max="30" placeholder="Ej: 8" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm font-medium text-white bg-violet-600 hover:bg-violet-700">
                    Guardar y finalizar
                </button>
            </div>
        </form>
    </div>
</div>
