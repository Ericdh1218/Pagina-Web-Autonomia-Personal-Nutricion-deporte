<div class="container mx-auto px-6 py-16 max-w-lg">
    <div class="bg-white p-8 rounded-2xl shadow-xl border">

        <h1 class="text-3xl font-bold mb-6 text-center">Iniciar Sesión</h1>

        <?php include __DIR__ . '/../partials/flash_messages.php'; ?>

        <div class="mb-6 p-4 rounded-lg bg-violet-50 border border-violet-200 text-violet-800 text-sm">
            <p>🌟 Al ingresar podrás guardar tu progreso, crear rutinas y planes de nutrición personalizados.</p>
        </div>

        <form method="post" action="<?= $BASE ?>index.php?r=login_post" class="space-y-4">
            <div>
                <label for="correo" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                <input id="correo" class="w-full border p-2 rounded-md mt-1" type="email" name="correo" placeholder="tu@correo.com" required>
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input id="password" class="w-full border p-2 rounded-md mt-1" type="password" name="password" placeholder="••••••••" required>
            </div>
            
            <button class="w-full bg-violet-600 text-white font-semibold px-4 py-3 rounded-md hover:bg-violet-700 transition-colors">
                Entrar
            </button>
        </form>

        <div class="text-sm text-center mt-6">
            <a href="<?= $BASE ?>index.php?r=forgot_password" class="font-medium text-violet-600 hover:text-violet-500">
                ¿Olvidaste tu contraseña?
            </a>
        </div>

        <p class="mt-6 text-center text-gray-600">
            ¿No tienes cuenta?
            <a class="text-violet-600 font-semibold hover:underline" href="<?= $BASE ?>index.php?r=registro">Regístrate</a>
        </p>
    </div>
</div>
