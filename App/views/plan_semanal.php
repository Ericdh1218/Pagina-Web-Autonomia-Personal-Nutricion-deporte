<div class="grid grid-cols-7 gap-4">
    <?php 
    // Suponiendo que $planSemanal es un array organizado por días desde tu controlador
    $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
    foreach ($dias as $dia): 
    ?>
        <div class="bg-gray-50 p-3 rounded-lg">
            <h4 class="font-bold text-center mb-2"><?= $dia ?></h4>
            <div class="space-y-2 text-sm">
                
                <div>
                    <strong>🌅 Desayuno:</strong>
                    <?php if (isset($planSemanal[$dia]['Desayuno'])): ?>
                        <a href="index.php?r=receta&id=<?= $planSemanal[$dia]['Desayuno']['id'] ?>" 
                           class="text-violet-600 hover:underline">
                            <?= htmlspecialchars($planSemanal[$dia]['Desayuno']['titulo']) ?>
                        </a>
                    <?php else: ?>
                        <span>No asignado</span>
                    <?php endif; ?>
                </div>

                <div>
                    <strong>🌞 Almuerzo:</strong>
                    </div>

                <div>
                    <strong>🌙 Cena:</strong>
                    </div>

            </div>
        </div>
    <?php endforeach; ?>
</div>