<h1 class="nombre-pagina">Recuperar</h1>
<p class="descripcion-pagina">Ingresa tu nuevo password</p>
<?php require_once __DIR__.'/../templates/alertas.php'?>
<?php if($error){ return null;} ?>
<!--Formulario-->
<form class="formulario" method="post" enctype="multipart/form-data">
    <div class="campo">
        <label for="password">Nuevo Password</label>
        <input type="password" name="password" id="password" placeholder="New Password" minlength="8" required>
    </div>
    <input type="submit" class="boton" name="recuperar-password" id="recuperar-password" value="Guardar Nuevo Password">
</form>
<!--Acciones posteriores-->
<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? <span>Inicia Sesión</span></a>
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? <span>Crear una</span></a>
</div>