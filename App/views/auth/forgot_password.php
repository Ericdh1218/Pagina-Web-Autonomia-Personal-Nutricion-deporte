<div class="container mx-auto px-6 py-16">
    <div class="max-w-md mx-auto bg-white p-8 rounded-2xl shadow-xl border">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Recuperar Contraseña</h1>
        <p class="text-center text-gray-600 mb-8">Introduce tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.</p>

        <?php include __DIR__ . '/../partials/flash_messages.php'; ?>

        <form method="post" action="<?= $BASE ?>index.php?r=forgot_password_post" class="space-y-6">
            <div>
                <label for="correo" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                <input type="email" name="correo" id="correo" required
                       class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <button type="submit"
                        class="w-full flex justify-center py-3 px-4 rounded-md shadow-sm font-medium text-white bg-violet-600 hover:bg-violet-700">
                    Enviar Enlace de Recuperación
                </button>
            </div>
        </form>
    </div>
</div>
