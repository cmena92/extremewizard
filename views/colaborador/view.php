<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


use app\models\sistema\AccessHelpers; 
use app\models\SisConfiguraciones; 

$this->title = $model->getNombreCompleto();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Colaboradores'), 'url' => ['index','sort'=>'nombre']];
$this->params['breadcrumbs'][] = $this->title;

function moneda($pMonto){        
	return  '₡ '.number_format($pMonto, 0, ',', ' ');
}
?>
<div class="colaborador-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php 
        /*
	 if(AccessHelpers::getAcceso('colaborador-delete')){ 
       echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]); 
	 } */ ?>
    </p>
	<div class="row">
	  <div class="col-lg-6">
		  <h2>Detalles</h2>
			<?= DetailView::widget([
				'model' => $model,
				'attributes' => [
					'tipoIdentificacionletras',
					'nombre:ntext',
					'apellido:ntext',
					'sapellido:ntext',
					'cedula:ntext',
                    'telefono:ntext',
                    'correo:ntext',
					'rol',
					'cod_provedor',
					'nacimiento',
				],
			]) ?>
		</div>
				
	</div>
    <?php if($model->idFacturas){ ?>
    <div class="row">
	  <div class="col-lg-6">
		  <h2>Ventas</h2>
          
            <table id="w0" class="table table-striped table-bordered detail-view"><tbody><tr><th>Tipo</th><td>Juridica</td></tr>
            <?php
            $total = 0;
            $fact;
            foreach($model->idFacturas as $factura){ ?>
                <tr>
                    <th>
                        <a href="/factura/imprimir?id=<?= $factura->id ?>">
                            <span class="glyphicon glyphicon-eye-open"></span>
                        </a> 
                        <?= $factura->id.' '.$factura->fecha ?>
                    </th>
                    <td><?= $factura->moneda($factura->dgt_total) ?></td>
                    <?php 
                    $total += $factura->dgt_total;
                    $fact = $factura;
                    ?>
                    
                </tr>
            <?php
            }
            ?>
            <tr><td>Total</td>
            <td><?= $fact->moneda($total) ?></td>
            </table>
            
		</div>
				
	</div>
    <?php } ?>
</div>
