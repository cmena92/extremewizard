<?php
use yii\grid\ActionColumn;
use yii\grid\GridView;

?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
          //  ['class' => 'yii\grid\SerialColumn'],

         //   'id',
            'nombre:ntext',
            'apellido:ntext',
            'sapellido:ntext',
            'cedula:ntext',
            'rol',
            // 'tipo',
            // 'nacimiento',

            [   
                'class' => 'yii\grid\ActionColumn',
                'template'=>"{addColaborador}"
            ],
        ],
    ]); ?>