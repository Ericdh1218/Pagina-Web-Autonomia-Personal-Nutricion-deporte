

<div class="container mx-auto px-6 py-16">
    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg border">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Cambiar Contraseña</h1>

        <?php include __DIR__ . '/../partials/flash_messages.php'; // Para mostrar mensajes de error/éxito ?>

        <form method="post" action="<?= $BASE ?>index.php?r=cambiar_password_post" class="space-y-6">
            <div>
                <label for="password_actual" class="block text-sm font-medium text-gray-700">Contraseña Actual</label>
                <input type="password" name="password_actual" id="password_actual" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-violet-500 focus:border-violet-500">
            </div>

            <div>
                <label for="nuevo_password" class="block text-sm font-medium text-gray-700">Nueva Contraseña</label>
                <input type="password" name="nuevo_password" id="nuevo_password" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-violet-500 focus:border-violet-500">
            </div>

            <div>
                <label for="nuevo_password2" class="block text-sm font-medium text-gray-700">Confirmar Nueva Contraseña</label>
                <input type="password" name="nuevo_password2" id="nuevo_password2" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-violet-500 focus:border-violet-500">
            </div>

            <div>
                <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-violet-600 hover:bg-violet-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-violet-500">
                    Actualizar Contraseña
                </button>
            </div>
        </form>
    </div>
</div>

