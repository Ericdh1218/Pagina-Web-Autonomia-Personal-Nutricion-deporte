<?php if (!empty($_SESSION['flash'])): ?>

    <?php foreach ($_SESSION['flash'] as $key => $message): ?>
    
        <?php
            // Determina el color basado en la clave del mensaje
            $colorClasses = 'bg-green-100 border-green-400 text-green-700'; // Default to success
            if ($key === 'error') {
                $colorClasses = 'bg-red-100 border-red-400 text-red-700';
            } elseif ($key === 'info') {
                $colorClasses = 'bg-blue-100 border-blue-400 text-blue-700';
            }
        ?>

        <div class="<?= $colorClasses ?> border px-4 py-3 rounded-md relative mb-4" role="alert">
            <span class="block sm:inline"><?= $message ?></span>
        </div>

    <?php endforeach; ?>

    <?php
        // Borra los mensajes de la sesión
        unset($_SESSION['flash']); 
    ?>
    
<?php endif; ?>