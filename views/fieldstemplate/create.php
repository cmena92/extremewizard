<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FieldsTemplate */

$this->title = Yii::t('app', 'Create Fields Template');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fields Templates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fields-template-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
