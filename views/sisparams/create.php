<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SisParametros */

$this->title = 'Create Sis Parametros';
$this->params['breadcrumbs'][] = ['label' => 'Sis Parametros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sis-parametros-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
