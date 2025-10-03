<div class="container mx-auto px-6 py-8">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold mb-4">📚 Recetario</h1>
            
            <form method="get" action="<?= $BASE ?>index.php" class="flex flex-col sm:flex-row gap-2">
                <input type="hidden" name="r" value="recetario">
                
                <input 
                    type="text" 
                    name="q" 
                    placeholder="Buscar por nombre..." 
                    class="border p-2 rounded w-full" 
                    value="<?= e($searchTerm ?? '') /* Mantiene el texto buscado */ ?>">

                <select name="categoria" class="border p-2 rounded w-full sm:w-auto">
                    <option value="">Todas las categorías</option>
                    <option value="pre entreno" <?= ($selectedCategory ?? '') == 'pre entreno' ? 'selected' : '' ?>>Pre Entreno</option>
                    <option value="post entreno" <?= ($selectedCategory ?? '') == 'post entreno' ? 'selected' : '' ?>>Post Entreno</option>
                    <option value="intra entreno" <?= ($selectedCategory ?? '') == 'intra entreno' ? 'selected' : '' ?>>Intra Entreno</option>
                    <option value="antes de dormir" <?= ($selectedCategory ?? '') == 'antes de dormir' ? 'selected' : '' ?>>Antes de Dormir</option>
                    <option value="comida de descanso" <?= ($selectedCategory ?? '') == 'comida de descanso' ? 'selected' : '' ?>>Comida de Descanso</option>
                </select>

                <button class="bg-violet-600 text-white px-6 py-2 rounded">Buscar</button>
            </form>
        </div>

        <div class="flex items-center justify-start md:justify-end gap-3 mt-4 md:mt-0">
            <a href="<?= $BASE ?>index.php?r=inicio"
                class="text-center bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg shadow-sm">
                Volver al inicio
            </a>
            <a href="<?= $BASE ?>index.php?r=nutricion"
                class="text-center bg-violet-600 hover:bg-violet-700 text-white font-semibold px-4 py-2 rounded-lg shadow">
                Ir a Nutrición
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (!empty($recetas)): ?>
            <?php foreach ($recetas as $receta): ?>
                <div class="bg-white shadow-lg rounded-lg p-4 flex flex-col transition-transform transform hover:-translate-y-1">
                    <?php if (!empty($receta['imagen'])): ?>
                        <a href="<?= $BASE ?>index.php?r=receta&id=<?= $receta['id'] ?>">
                            <img src="<?= $BASE ?>assets/img/<?= e($receta['imagen']) ?>" alt="<?= e($receta['titulo']) ?>"
                                class="rounded-t-lg mb-4 h-48 w-full object-cover">
                        </a>
                    <?php endif; ?>
                    
                    <span class="text-xs font-semibold uppercase tracking-wider text-violet-500 mb-1">
                        <?= e($receta['categoria']) ?>
                    </span>
                    <h2 class="text-lg font-bold text-gray-800 mb-2"><?= e($receta['titulo']) ?></h2>
                    
                    <p class="text-sm text-gray-600 flex-grow"><?= substr(e($receta['descripcion']), 0, 100) ?>...</p>
                    
                    <a href="<?= $BASE ?>index.php?r=receta&id=<?= $receta['id'] ?>"
                        class="text-violet-600 font-semibold mt-4 block self-start hover:text-violet-800">Ver más →</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="col-span-full text-center text-gray-600 mt-8">No se encontraron recetas con esos criterios.</p>
        <?php endif; ?>
    </div>
</div>