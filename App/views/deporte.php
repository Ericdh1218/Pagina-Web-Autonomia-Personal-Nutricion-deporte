<div class="container mx-auto px-6 py-8">
    <div class="mb-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-2">Centro de Deporte</h1>
        <p class="text-lg text-gray-600">Explora, aprende y construye tu rutina. Tú tienes el control.</p>
    </div>

    <div class="mb-8 flex flex-wrap gap-2">
        <button class="filter-btn bg-violet-600 text-white px-4 py-2 rounded-full" data-filter="all">Todos</button>
        
        <?php 
            $ejercicios = $ejercicios ?? []; // Forma corta de asegurar que $ejercicios es un array
            $categorias = array_unique(array_column($ejercicios, 'categoria'));
            foreach ($categorias as $categoria): 
        ?>
            <button class="filter-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-full" data-filter="<?= e($categoria) ?>"><?= e($categoria) ?></button>
        <?php endforeach; ?>
    </div>

    <div id="exercise-library" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        
        <?php if (empty($ejercicios)): ?>
            <p class="col-span-full text-center text-gray-500">No hay ejercicios disponibles en este momento.</p>
        <?php else: ?>
            <?php foreach ($ejercicios as $ejercicio): ?>
                <div class="exercise-card bg-white rounded-lg shadow-md overflow-hidden transition-transform transform hover:-translate-y-2" data-category="<?= e($ejercicio['categoria']) ?>">
                    
                    <?php 
                        // Construimos la ruta directamente a tu carpeta de imágenes
                        $imagePath = $BASE . 'assets/img/' . e($ejercicio['media_url'] ?? 'placeholder.jpg'); 
                    ?>
                    <img src="<?= $imagePath ?>" alt="<?= e($ejercicio['nombre']) ?>" class="w-full h-40 object-cover">
                    
                    <div class="p-4">
                        <span class="text-xs font-semibold uppercase text-violet-500"><?= e($ejercicio['categoria']) ?></span>
                        <h3 class="text-lg font-bold text-gray-800 mt-1"><?= e($ejercicio['nombre']) ?></h3>
                        <p class="text-sm text-gray-600 mt-2 h-16"><?= e(substr($ejercicio['descripcion'], 0, 80)) ?>...</p>
                        <a href="<?= $BASE ?>index.php?r=ejercicio&id=<?= $ejercicio['id'] ?>" class="text-violet-600 font-semibold mt-4 block">Aprender más →</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ... (Tu script de filtros no necesita ningún cambio)
        const filterButtons = document.querySelectorAll('.filter-btn');
        const exerciseCards = document.querySelectorAll('.exercise-card');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                filterButtons.forEach(btn => {
                    btn.classList.remove('bg-violet-600', 'text-white');
                    btn.classList.add('bg-gray-200', 'text-gray-700');
                });
                this.classList.add('bg-violet-600', 'text-white');
                this.classList.remove('bg-gray-200', 'text-gray-700');
                
                const filter = this.getAttribute('data-filter');

                exerciseCards.forEach(card => {
                    if (filter === 'all' || card.getAttribute('data-category') === filter) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });

        const allButton = document.querySelector('.filter-btn[data-filter="all"]');
        if (allButton) {
            allButton.click();
        }
    });
</script>