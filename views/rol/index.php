<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\RolSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Rols');
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['user/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rol-index">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app','Create').' '.Yii::t('app','Rol'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app','Create').' '.Yii::t('app','Operations'), ['/operacion/create'], ['class' => 'btn btn-success']) ?>
    </p>

        <div class="row">
            <div class="col-lg-6">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
          //  ['class' => 'yii\grid\SerialColumn'],

         //   'id',
            'nombre',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
</div>
</div>
</div>
</div>
</div>
