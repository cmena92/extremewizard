<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SisParametros */

$this->title = 'Update Sis Parametros: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sis Parametros', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sis-parametros-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
