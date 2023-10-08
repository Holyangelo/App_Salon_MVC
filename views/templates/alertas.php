<?php 
if(isset($alertas)){
    foreach($alertas as $key => $mensajes):?>
        <?php foreach($mensajes as $mensaje): ?>
        <div class="<?php if($key === 'error'){echo 'danger';}else{echo 'check';}?>">
            <i class="<?php if($key === 'error'){echo 'fa fa-times-circle shine';}else{echo 'fa fa-check-circle shine';}?>"></i>&nbsp; &nbsp;
            <span><?php echo $mensaje; ?></span></div>  
        <?php
        endforeach; 
    endforeach;
    }?>