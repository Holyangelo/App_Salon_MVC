<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesión con tus datos</p>
<!--Formulario-->
<form class="formulario" method="post" action="/" enctype="multipart/form-data">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Password" minlength="5" required>
    </div>
    <input type="submit" class="boton" name="login" id="login" value="Login">
</form>
<!--Acciones posteriores-->
<div class="acciones">
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? <span>Crear una</span></a>
    <a href="/olvide">Olvidé mi password</a>
</div>