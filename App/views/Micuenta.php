<section id="mi-cuenta" class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">Mi Cuenta</h1>

        <div class="max-w-3xl mx-auto">
            <?php include __DIR__ . '/partials/flash_messages.php'; ?>
        </div>

        <div class="max-w-3xl mx-auto bg-white p-8 rounded-2xl shadow-xl border">

            <div>
                <h2 class="text-2xl font-semibold mb-6 text-violet-700">Información del Usuario</h2>
                <div class="space-y-4 text-lg">
                    <div class="flex flex-col sm:flex-row">
                        <span class="font-semibold w-24">Nombre:</span>
                        <span class="text-gray-700"><?= e($usuario['nombre'] ?? 'No disponible') ?></span>
                    </div>
                    <div class="flex flex-col sm:flex-row">
                        <span class="font-semibold w-24">Email:</span>
                        <span class="text-gray-700"><?= e($usuario['correo'] ?? 'No disponible') ?></span>
                    </div>
                </div>
            </div>

            <hr class="my-8 border-gray-200">

            <div>
                <h2 class="text-2xl font-semibold mb-6 text-violet-700">Mis Métricas</h2>
                <div class="bg-violet-50 p-6 rounded-xl border border-violet-200">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">⚖️ Peso Registrado</p>
                            <p class="text-3xl font-bold text-gray-800"><?= e($usuario['peso'] ?? '--') ?> <span class="text-lg font-medium">kg</span></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">📏 Altura Registrada</p>
                            <p class="text-3xl font-bold text-gray-800"><?= e($usuario['altura'] ?? '--') ?> <span class="text-lg font-medium">cm</span></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">📊 Último IMC Calculado</p>
                            <p class="text-3xl font-bold text-violet-600"><?= e($usuario['imc'] ?? '--') ?></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr class="my-8 border-gray-200">

            <div>
                <h2 class="text-2xl font-semibold mb-6 text-violet-700">Seguridad</h2>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="<?= $BASE ?>index.php?r=cambiar_password"
                       class="w-full text-center bg-violet-600 hover:bg-violet-700 text-white font-semibold px-4 py-3 rounded-lg shadow-sm transition-transform transform hover:scale-105">
                        Cambiar Contraseña
                    </a>
                    <a href="index.php?r=eliminar_cuenta"
                       class="w-full text-center bg-red-100 hover:bg-red-200 text-red-700 font-semibold px-4 py-3 rounded-lg transition-transform transform hover:scale-105">
                        Eliminar Mi Cuenta
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>