<div class="container mx-auto px-6 py-16">
    <div class="max-w-md mx-auto bg-white p-8 rounded-2xl shadow-xl border">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Establecer Nueva Contraseña</h1>
        <?php include __DIR__ . '/../partials/flash_messages.php'; ?>

        <form method="post" action="<?= $BASE ?>index.php?r=reset_password_post" class="space-y-6">
            <input type="hidden" name="token" value="<?= e($token) ?>">
            
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Nueva Contraseña</label>
                <input type="password" name="password" id="password" required class="mt-1 block w-full px-4 py-2 border rounded-md">
            </div>
            <div>
                <label for="password2" class="block text-sm font-medium text-gray-700">Confirmar Nueva Contraseña</label>
                <input type="password" name="password2" id="password2" required class="mt-1 block w-full px-4 py-2 border rounded-md">
            </div>
            <div>
                <button type="submit" class="w-full flex justify-center py-3 px-4 rounded-md shadow-sm font-medium text-white bg-violet-600">
                    Guardar Nueva Contraseña
                </button>
            </div>
        </form>
    </div>
</div>