
<div class="container mx-auto px-6 py-12">
    <div class="mb-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-2 flex items-center gap-3">
            <span class="bg-violet-100 text-violet-600 p-2 rounded-lg">📚</span>
            Biblioteca de Ejercicios
        </h1>
        <p class="text-lg text-gray-600">Filtra y explora todos los movimientos disponibles para construir tu rutina.</p>
        <form method="get" action="<?= $BASE ?>index.php" class="max-w-xl mx-auto my-8 flex items-center">
    <input type="hidden" name="r" value="biblioteca">
    <input type="text" name="q" placeholder="Buscar ejercicio por nombre..." 
           class="w-full px-4 py-3 border border-gray-300 rounded-l-lg focus:ring-violet-500 focus:border-violet-500 text-lg" 
           value="<?= e($searchTerm ?? '') ?>">
    <button type="submit" class="bg-violet-600 text-white px-6 py-3 rounded-r-lg hover:bg-violet-700">
        Buscar
    </button>
</form>

<a href="<?= $BASE ?>index.php?r=deporte" class="text-violet-600 hover:underline mt-4 inline-block">← Volver al Centro de Deporte</a>
    </div>

    

    <div class="space-y-6 bg-white p-6 rounded-2xl shadow-lg border border-gray-100 mb-10">
        <div>
            <h3 class="font-semibold mb-3 text-gray-700">Grupo Muscular</h3>
            <div class="flex flex-wrap items-center gap-3 filter-group" data-filter-group="grupo_muscular">
                <button class="filter-btn active" data-filter="all">Todos</button>
                <?php
                $ejercicios = $ejercicios ?? [];
                $grupos = array_unique(array_column($ejercicios, 'grupo_muscular'));
                $grupos = array_filter($grupos);
                foreach ($grupos as $grupo): ?>
                    <button class="filter-btn" data-filter="<?= e($grupo) ?>"><?= e($grupo) ?></button>
                <?php endforeach; ?>
            </div>
        </div>

        <div>
            <h3 class="font-semibold mb-3 text-gray-700">Tipo de Entrenamiento</h3>
            <div class="flex flex-wrap items-center gap-3 filter-group" data-filter-group="tipo_entrenamiento">
                <button class="filter-btn active" data-filter="all">Todos</button>
                <?php
                $tipos = array_unique(array_column($ejercicios, 'tipo_entrenamiento'));
                $tipos = array_filter($tipos);
                foreach ($tipos as $tipo): ?>
                    <button class="filter-btn" data-filter="<?= e($tipo) ?>"><?= e($tipo) ?></button>
                <?php endforeach; ?>
            </div>
        </div>

        <div>
            <h3 class="font-semibold mb-3 text-gray-700">Equipamiento</h3>
            <div class="flex flex-wrap items-center gap-3 filter-group" data-filter-group="equipamiento">
                <button class="filter-btn active" data-filter="all">Todos</button>
                <?php
                $equipamientos = array_unique(array_column($ejercicios, 'equipamiento'));
                $equipamientos = array_filter($equipamientos);
                foreach ($equipamientos as $equipamiento): ?>
                    <button class="filter-btn" data-filter="<?= e($equipamiento) ?>"><?= e($equipamiento) ?></button>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div id="exercise-library" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php foreach ($ejercicios as $ejercicio): ?>
            <div class="exercise-card bg-white rounded-lg shadow-md overflow-hidden transition-transform transform hover:-translate-y-2"
                 data-grupo_muscular="<?= e($ejercicio['grupo_muscular']) ?>"
                 data-tipo_entrenamiento="<?= e($ejercicio['tipo_entrenamiento']) ?>"
                 data-equipamiento="<?= e($ejercicio['equipamiento']) ?>">
                <a href="<?= $BASE ?>index.php?r=ejercicio&id=<?= $ejercicio['id'] ?>">
                    <?php $imagePath = $BASE . 'assets/img/' . e($ejercicio['media_url'] ?? 'placeholder.jpg'); ?>
                    <img src="<?= $imagePath ?>" alt="<?= e($ejercicio['nombre']) ?>" class="w-full h-40 object-contain bg-gray-50">
                </a>
                <div class="p-4">
                    <span class="text-xs font-semibold uppercase text-violet-500"><?= e($ejercicio['grupo_muscular']) ?></span>
                    <h3 class="text-lg font-bold text-gray-800 mt-1"><?= e($ejercicio['nombre']) ?></h3>
                </div>
            </div>
        <?php endforeach; ?>
        <div id="no-results" class="hidden col-span-full text-center text-gray-500 py-16">
            <p class="text-xl">No se encontraron ejercicios que coincidan con tu búsqueda.</p>
        </div>
    </div>
</div>

    <style>
        .filter-btn {
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            transition: all 0.2s;
            background-color: #f3f4f6;
            color: #4b5563;
        }

        .filter-btn.active {
            background-color: #7c3aed;
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterGroups = document.querySelectorAll('.filter-group');
        const exerciseCards = document.querySelectorAll('.exercise-card');
        const noResultsMessage = document.getElementById('no-results');
        let activeFilters = {};

        // Función para aplicar los filtros
        function applyFilters() {
            let visibleCount = 0;
            exerciseCards.forEach(card => {
                let isVisible = true;
                for (const groupName in activeFilters) {
                    const selectedFilter = activeFilters[groupName];
                    const cardCategory = card.getAttribute(`data-${groupName}`);

                    if (selectedFilter !== 'all' && cardCategory !== selectedFilter) {
                        isVisible = false;
                        break;
                    }
                }
                card.style.display = isVisible ? 'block' : 'none';
                if (isVisible) visibleCount++;
            });

            // Mostrar u ocultar el mensaje de "no resultados"
            noResultsMessage.style.display = visibleCount === 0 ? 'block' : 'hidden';
        }

        // Inicializar los filtros
        filterGroups.forEach(group => {
            const groupName = group.getAttribute('data-filter-group');
            activeFilters[groupName] = 'all'; // Todos los filtros empiezan en 'all'

            group.querySelectorAll('.filter-btn').forEach(button => {
                button.addEventListener('click', function () {
                    group.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    activeFilters[groupName] = this.getAttribute('data-filter');
                    applyFilters();
                });
            });
        });

        // Aplicar los filtros al cargar la página para que se vean los ejercicios
        applyFilters();
    });

</script>