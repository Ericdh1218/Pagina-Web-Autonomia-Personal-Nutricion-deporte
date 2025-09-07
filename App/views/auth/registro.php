<h1 class="text-2xl font-bold mb-4">Crear cuenta</h1>

<?php if ($m = flash('error')): ?>
  <div class="bg-red-100 text-red-800 p-3 rounded mb-4"><?= e($m) ?></div>
<?php endif; if ($m = flash('ok')): ?>
  <div class="bg-green-100 text-green-800 p-3 rounded mb-4"><?= e($m) ?></div>
<?php endif; ?>

<form method="post" action="<?= $BASE ?>index.php?r=registro_post" class="max-w-md space-y-3">
  <input class="w-full border p-2 rounded" type="text" name="nombre" placeholder="Nombre completo" value="<?= old('nombre') ?>" required>
  <input class="w-full border p-2 rounded" type="email" name="correo" placeholder="Correo electrónico" value="<?= old('correo') ?>" required>
  <input class="w-full border p-2 rounded" type="password" name="password" placeholder="Contraseña (mín. 6)" required>
  <input class="w-full border p-2 rounded" type="password" name="password2" placeholder="Repite la contraseña" required>
  <button class="bg-blue-600 text-white px-4 py-2 rounded">Registrarme</button>
</form>

<p class="mt-3">¿Ya tienes cuenta? <a class="text-blue-600" href="<?= $BASE ?>index.php?r=login">Inicia sesión</a></p>
