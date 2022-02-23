<?php

use yii\helpers\Html;
use app\models\sistema\AccessHelpers;


$tam_image = '80px';
$this->title = 'JARVIS';
?>
<div class="site-index"> 
    <div class="body-content">
        <?php if (Yii::$app->user->identity) {
            ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header">
                            <h1>
                                <small>Escritorio</small>
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
						   <div style="text-align: center;" class="col-xs-6 col-sm-4 col-md-4" id="acc_factura">
						   <a href="/sync/index?sort=-id">
						
								<p><?php echo Html::img('/img/servicios/sync.png', ['height' => '' . $tam_image]) ?></p>             
								<h2><a class="btn btn-default" href="/sync/index">Sincronizar Productos</a></h2>
							</a>
						</div>
							
						   <div style="text-align: center;" class="col-xs-6 col-sm-4 col-md-4" id="acc_factura">
								<a class="" href="/sync/store?sort=-id">
								<p><?php echo Html::img('/img/servicios/woo.png', ['height' => '' . $tam_image]) ?></p>             
								<h2><a class="btn btn-default" href="/products/index">Productos en tienda</a></h2>
								</a>
							</div>
							<!--
						   <div style="text-align: center;" class="col-xs-6 col-sm-4 col-md-4" id="acc_factura">
								<a  href="/sync/templates?sort=-id">
								<p><?php echo Html::img('/img/servicios/fields2.png', ['height' => '' . $tam_image]) ?></p>             
								<h2><a class="btn btn-default" href="/fieldstemplate/index">Plantillas de campos</a></h2>
								</a>
							</div>
							-->
						   <div style="text-align: center;" class="col-xs-6 col-sm-4 col-md-4" id="acc_factura">
								<a href="/branch/index?sort=-id">
								<p><?php echo Html::img('/img/servicios/branch.png', ['height' => '' . $tam_image]) ?></p>             
								<h2><a class="btn btn-default" href="/branch/index?sort=-id">Sucursales y Bodegas</a></h2>
								</a>
							</div>
						   <div style="text-align: center;" class="col-xs-6 col-sm-4 col-md-4" id="acc_factura">
								<a  href="/log/index?sort=-id">
								<p><?php echo Html::img('/img/servicios/logs.png', ['height' => '' . $tam_image]) ?></p>             
								<h2><a class="btn btn-default" href="/log/index?sort=-id">Log De Cambios</a></h2>
								</a>
							</div>
                        </div>
                    </div> 
                    </div>                    
                </div>

                <?php
                if (Yii::$app->user->identity->rol_id === 2 || Yii::$app->user->identity->rol_id === 3) { ?>
                
                
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
            <div style="text-align: center;" class="col-xs-6 col-sm-4 col-md-4">
                <p><img src="/img/servicios/1.png" height="80px" ></p>             
                <h2><a class="btn btn-default" href="/rol/index">Seguridad</a></h2>
            </div>
        <?php } ?>

        <?php if (AccessHelpers::getAcceso('user-index')) { ?>
            <div style="text-align: center;" class="col-xs-6 col-sm-4 col-md-4">
                <p><img src="/img/servicios/usuarios.png" height="80px" alt="Usuarios"></p>             
                <h2><a class="btn btn-default" href="/user/index">Usuarios</a></h2>
            </div>
        <?php } ?>
        <?php if (AccessHelpers::getAcceso('gii-index')) { ?>
            <div style="text-align: center;" class="col-xs-6 col-sm-4 col-md-4">
                <p><img src="/img/servicios/5.png" height="80px" alt="Gii"></p>             
                <h2><a class="btn btn-default" href="/gii">Gii</a></h2>
            </div>
        <?php } ?>

    </div>
</div>				

                
                <?php
                }
                ?>


            </div>


            <?php
        } else {
            echo $this->render('visitante');
        }
        ?>
    </div>
</div>

<?php $this->registerJsFile('/js/index.js'); ?>  