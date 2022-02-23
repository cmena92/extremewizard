<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>

        <?php $this->head() ?>
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    </head>
    <body>
        <?php $this->beginBody() ?>
        <div class="wrap">
            <?php echo $this->render('nav_superior'); ?>
            <div class="container">
                <script> var detalles_existentes;</script>
	
			<div class="row">
			<div  class="col-xs-12 col-sm-12 col-md-12">	
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>

                <?= Alert::widget() ?>
				
            </div>
                <?= $content ?>

            </div>
        </div>

        <?php echo $this->render('jumbotron'); ?>

        <footer class="footer">
            <p class="pull-right"><?php echo Yii::powered() ?></p>
        </footer>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
<script>
	
    var img_esperando = '<p style="text-align: center;"><?php echo Html::img('/img/esperando.gif', ['alt' => "esperando"]) ?></p>';
    var img_esperando_simple = '<?php echo Html::img('/img/esperando.gif', ['alt' => "esperando"]) ?>';
</script>
<script src="../../../js/ready.js" type="text/javascript"></script>