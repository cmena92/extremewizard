<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Rol */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Rols'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rol-view">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app','Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app','Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app','Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombre',
        ],
    ]) ?>
    
    <h3><?= Yii::t('app','Allowed operations') ?></h3>
 
    <ol>
        <?php foreach ($model->operacionesPermitidasList as $operacionPermitida) { ?>
        <li><?= $operacionPermitida['nombre']?> </li>
         <?php }?>
    </ol>

</div>
</div>
</div>
</div>
