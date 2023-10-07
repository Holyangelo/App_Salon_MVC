<h1 class="nombre-pagina">Olvide Password</h1>
<p class="descripcion-pagina">Ingresa tu email para recuperar tu password</p>
<!--Formulario-->
<form class="formulario" method="post" action="/crear-cuenta" enctype="multipart/form-data">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
    </div>
    <input type="submit" class="boton" name="recuperar-password" id="recuperar-password" value="Recuperar">
</form>
<!--Acciones posteriores-->
<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? <span>Inicia Sesión</span></a>
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? <span>Crear una</span></a>
</div>