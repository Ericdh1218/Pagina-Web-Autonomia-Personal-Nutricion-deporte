<h1 class="text-2xl font-bold mb-4">Iniciar sesión</h1>

<?php if ($m = flash('error')): ?>
  <div class="bg-red-100 text-red-800 p-3 rounded mb-4"><?= e($m) ?></div>
<?php endif; ?>

<form method="post" action="/index.php?r=login_post" class="max-w-md space-y-3">
  <input class="w-full border p-2 rounded" type="email" name="correo" placeholder="Correo electrónico" required>
  <input class="w-full border p-2 rounded" type="password" name="password" placeholder="Contraseña" required>
  <button class="bg-blue-600 text-white px-4 py-2 rounded">Entrar</button>
</form>
<p class="mt-3">¿No tienes cuenta? <a class="text-blue-600" href="/index.php?r=registro">Regístrate</a></p>
