<h1 class="nombre-pagina">Confirmar cuenta</h1>
<?php require_once __DIR__.'/../templates/alertas.php'?>

<?php if(isset($usuarioExiste)): ?>
<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? <span>Inicia sesión</span></a>
</div>
<?php endif; ?>