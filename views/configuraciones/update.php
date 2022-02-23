<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\configuraciones */

$this->title = Yii::t('app', 'Actualizar {modelClass} ', [
    'modelClass' => 'Configuraciones',
]) . ' ';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Configuraciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->dato, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="configuraciones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
