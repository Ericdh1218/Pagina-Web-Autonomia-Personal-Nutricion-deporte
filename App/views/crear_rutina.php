<div class="container mx-auto px-6 py-12">
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Crear Nueva Rutina</h1>
            <p class="text-lg text-gray-600">Dale un nombre a tu rutina y selecciona los ejercicios que quieres incluir.</p>
            <a href="<?= $BASE ?>index.php?r=deporte" class="text-violet-600 hover:underline mt-4 inline-block">← Volver al Centro de Deporte</a>
        </div>

        <form method="post" action="<?= $BASE ?>index.php?r=crear_rutina_post" class="bg-white p-8 rounded-2xl shadow-xl border space-y-8">
            <div>
                <label for="nombre_rutina" class="block text-xl font-semibold text-gray-700">Nombre de la Rutina</label>
                <input type="text" name="nombre_rutina" id="nombre_rutina" required placeholder="Ej: Mi Rutina de Lunes"
                       class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm text-lg">
            </div>

            <div>
                <label class="block text-xl font-semibold text-gray-700 mb-4">Selecciona los Ejercicios</label>
                <div class="space-y-6">
                    <?php
                        // Agrupar ejercicios por grupo muscular
                        $ejerciciosAgrupados = [];
                        foreach ($ejercicios as $ejercicio) {
                            $ejerciciosAgrupados[$ejercicio['grupo_muscular']][] = $ejercicio;
                        }
                    ?>

                    <?php foreach ($ejerciciosAgrupados as $grupo => $listaEjercicios): ?>
                        <div>
                            <h4 class="text-lg font-bold text-violet-700 border-b pb-2 mb-3"><?= e($grupo) ?></h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                <?php foreach ($listaEjercicios as $ejercicio): ?>
                                    <label class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 cursor-pointer">
                                        <input type="checkbox" name="ejercicios[]" value="<?= $ejercicio['id'] ?>" class="h-5 w-5 rounded text-violet-600">
                                        <span><?= e($ejercicio['nombre']) ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="pt-6 border-t">
                <button type="submit" class="w-full flex justify-center py-3 px-4 rounded-md shadow-sm font-medium text-white bg-violet-600 hover:bg-violet-700 text-lg">
                    Guardar Rutina
                </button>
            </div>
        </form>
    </div>
</div>