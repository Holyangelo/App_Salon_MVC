<?php 
if(isset($alertas)){
    foreach($alertas as $key => $mensajes):?>
        <?php foreach($mensajes as $mensaje): ?>
        <div class="check">
            <i class="fa fa-check-circle shine"></i>&nbsp; &nbsp;
            <span><?php echo $mensaje; ?></span></div>  
        <?php
        endforeach; 
    endforeach;
    }?>

<h1 class="nombre-pagina">Confirma tu cuenta</h1>

<p class="descripcion-pagina">Hemos enviado las instrucciones a tu correo para confirmar tu cuenta</p>