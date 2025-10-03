<?php if (!empty($_SESSION['flash'])): ?>

    <?php foreach ($_SESSION['flash'] as $key => $message): ?>
    
        <?php
            // Determina el color basado en la clave del mensaje ('ok', 'error', etc.)
            $colorClasses = $key === 'ok' 
                ? 'bg-green-100 border-green-400 text-green-700' 
                : 'bg-red-100 border-red-400 text-red-700';
        ?>

        <div class="<?= $colorClasses ?> border px-4 py-3 rounded-md relative mb-4" role="alert">
            <span class="block sm:inline"><?= e($message) ?></span>
        </div>

    <?php endforeach; ?>

    <?php
        // Borra TODOS los mensajes flash de la sesión para que no se muestren de nuevo
        unset($_SESSION['flash']); 
    ?>
    
<?php endif; ?>