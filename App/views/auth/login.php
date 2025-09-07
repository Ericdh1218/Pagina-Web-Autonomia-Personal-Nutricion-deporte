<h1 class="text-2xl font-bold mb-4">Iniciar sesión</h1>

<!-- Mensaje informativo permanente -->
<div class="mb-6 p-4 rounded-lg bg-blue-100 border border-blue-300 text-blue-800">
  🌟 <strong>¿Por qué iniciar sesión?</strong><br>
  Al ingresar con tu cuenta podrás:
  <ul class="list-disc pl-6 mt-2">
    <li>Guardar tu historial de progreso en nutrición y deporte.</li>
    <li>Llevar un control de tus rutinas y actividades.</li>
    <li>Acceder a planes personalizados y herramientas exclusivas.</li>
  </ul>
</div>

<?php if ($m = flash('error')): ?>
  <div class="mb-6 p-3 rounded-lg bg-red-100 text-red-800 border border-red-300">
    <?= e($m) ?>
  </div>
<?php endif; ?>

<form method="post" action="<?= $BASE ?>index.php?r=login_post" class="max-w-md space-y-3">
  <input class="w-full border p-2 rounded" type="email" name="correo" placeholder="Correo electrónico" required>
  <input class="w-full border p-2 rounded" type="password" name="password" placeholder="Contraseña" required>
  <button class="bg-blue-600 text-white px-4 py-2 rounded">Entrar</button>
</form>

<p class="mt-3">
  ¿No tienes cuenta?
  <a class="text-blue-600 font-semibold" href="<?= $BASE ?>index.php?r=registro">Regístrate</a>
</p>
