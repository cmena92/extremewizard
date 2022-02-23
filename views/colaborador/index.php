<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\sistema\AccessHelpers;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ColaboradorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Colaboradores');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="colaborador-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Crear Colaborador'), ['create'], ['class' => 'btn btn-success']) ?>
        <?php 
         if (AccessHelpers::getAcceso('crm-panel')) { ?>
            <?= Html::a(Yii::t('app', 'CRM'), ['/crm/panel'], ['class' => 'btn btn-info']) ?>
         <?php } ?>
    </p>

    <?php

        $acciones = [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
            ];
       if (AccessHelpers::getAcceso('colaborador-delete')) { 
       
         $acciones = [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
            ];
       }   
        if(isset($_GET['venta'])){
             $acciones = [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{consultar}',
                'buttons'=>[
                       'consultar'=>function($url,$model){ 
                            $btn = '<a href="/colaborador/index?venta='.$_GET['venta'].'&id='.$model->id.'&anterior='.$_GET['anterior'].'" > <span class="glyphicon glyphicon-ok"></span></a>';
                        return $btn;						
                    },
                ]
            ];
        }
		if(isset($_GET['credito'])){
             $acciones = [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{consultar}',
                'buttons'=>[
                       'consultar'=>function($url,$model){ 
                            $btn = '<a href="/colaborador/index?credito='.$_GET['credito'].'&id='.$model->id.'&anterior='.$_GET['anterior'].'" > <span class="glyphicon glyphicon-ok"></span></a>';
                        return $btn;						
                    },
                ]
            ];
        }

        
        echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
          //  ['class' => 'yii\grid\SerialColumn'],

         //   'id',
            'nombre:ntext',
            'apellido:ntext',
            'nombreCompleto:ntext',
            'cedula:ntext',
            'telefono',
            'correo',
           // 'rol',
            [
                'attribute'=>'tipo',
               // 'label'=>'Rol',
                'format'=>'raw',
                'value'=>function($model){
                    $tipo = [1=>'Cliente',2=>'Empleado',3=>'Inversionista',4=>'Proveedor'];
                    return $tipo[$model->tipo];
                },
                'filter'=>[1=>'Cliente',2=>'Empleado',3=>'Inversionista',4=>'Proveedor'],
            ],
            // 'tipo',
            // 'nacimiento',

            $acciones,
        ],
    ]); ?>

</div>
