<?php
use app\models\sistema\AccessHelpers;
$tam_image = '80px';
?>


<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h1>
                <small>Sistema y Configuración</small>
            </h1>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">


       
        <?php if (AccessHelpers::getAcceso('rol-index')) { ?>                          
            <div style="text-align: center;" class="col-md-3">
                <p><img src="/img/servicios/1.png" height="80px" ></p>             
                <h2><a class="btn btn-default" href="/rol/index">Seguridad</a></h2>
            </div>
        <?php } ?>

        <?php if (AccessHelpers::getAcceso('user-index')) { ?>
            <div style="text-align: center;" class="col-md-3">
                <p><img src="/img/servicios/usuarios.png" height="80px" alt="Usuarios"></p>             
                <h2><a class="btn btn-default" href="/user/index">Usuarios</a></h2>
            </div>
        <?php } ?>
        <?php if (AccessHelpers::getAcceso('gii-index')) { ?>
            <div style="text-align: center;" class="col-md-3">
                <p><img src="/img/servicios/5.png" height="80px" alt="Gii"></p>             
                <h2><a class="btn btn-default" href="/gii">Gii</a></h2>
            </div>
        <?php } ?>

    </div>
</div>				







