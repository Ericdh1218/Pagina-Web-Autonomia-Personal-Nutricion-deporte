<div class="container mx-auto px-6 py-8">
  <h1 class="text-3xl font-bold mb-6 text-center">📅 Plan de Comidas Semanal</h1>

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-7 gap-6">
    <?php 
    $dias = ['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'];
    foreach ($dias as $dia): ?>
      <div class="bg-green-50 rounded-lg p-6 shadow-md hover:shadow-lg transition">
        <h5 class="font-bold text-xl text-green-700 text-center mb-4"><?= $dia ?></h5>
        <ul class="space-y-2 text-gray-700 text-sm">
          <?php foreach (['Desayuno','Almuerzo','Cena'] as $tipo): ?>
            <li>
              <?php if (isset($planSemanal[$dia][$tipo])): ?>
                <strong>
                  <?= $tipo ?>:
                </strong>
                <a href="<?= $BASE ?>index.php?r=receta&id=<?= $planSemanal[$dia][$tipo]['id'] ?>" 
                   class="text-violet-600 hover:underline">
                   <?= htmlspecialchars($planSemanal[$dia][$tipo]['titulo']) ?>
                </a>
              <?php else: ?>
                <strong><?= $tipo ?>:</strong> <span class="text-gray-400">No asignado</span>
              <?php endif; ?>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endforeach; ?>
  </div>
</div>
