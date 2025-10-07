<div class="container mx-auto px-6 py-12">
    <div class="max-w-5xl mx-auto">

        <a href="<?= $BASE ?>index.php?r=biblioteca" class="text-violet-600 hover:underline mb-6 inline-block">← Volver a la biblioteca</a>

        <div class="bg-white p-8 rounded-2xl shadow-xl">
            <h1 class="text-4xl font-bold text-gray-800 mb-4"><?= e($ejercicio['nombre']) ?></h1>
            <div class="flex flex-wrap gap-2 mb-8">
                <span class="bg-violet-100 text-violet-700 text-xs font-semibold px-3 py-1 rounded-full">💪 <?= e($ejercicio['grupo_muscular']) ?></span>
                <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">👟 <?= e($ejercicio['tipo_entrenamiento']) ?></span>
                <span class="bg-gray-100 text-gray-700 text-xs font-semibold px-3 py-1 rounded-full">🏋️‍♀️ <?= e($ejercicio['equipamiento']) ?></span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                
                <div class="rounded-lg overflow-hidden border">
                    <?php $imagePath = $BASE . 'assets/img/' . e($ejercicio['media_url'] ?? 'placeholder.jpg'); ?>
                    <img src="<?= $imagePath ?>" alt="<?= e($ejercicio['nombre']) ?>" class="w-full">
                </div>

                <div class="space-y-8">
                    
                    <?php if (!empty($ejercicio['video_url'])): ?>
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Técnica en Video</h2>
                        <div class="aspect-w-9 aspect-h-16 rounded-lg overflow-hidden">
                            <?php
                                // Lógica para extraer el ID de cualquier URL de YouTube
                                $url = $ejercicio['video_url'];
                                preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/|youtube\.com/shorts/)([^"&?/ ]{11})%i', $url, $match);
                                $youtube_id = $match[1] ?? null;
                            ?>
                            <?php if ($youtube_id): ?>
                                <iframe src="https://www.youtube.com/embed/<?= e($youtube_id) ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Instrucciones</h2>
                        <div class="prose max-w-none text-gray-600 text-lg">
                            <p><?= nl2br(e($ejercicio['descripcion'])) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>