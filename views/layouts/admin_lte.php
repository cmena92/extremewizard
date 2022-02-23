<?php


use yii\helpers\Html;
use app\assets\AdminLteAsset;
$asset      = AdminLteAsset::register($this);
$baseUrl    = $asset->baseUrl;

use app\models\Configuraciones;
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
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php 
	$this->beginBody();
?>

<script>
	var img_esperando = '<p style="text-align: center;"><?= Html::img(Configuraciones::findOne(16)->valor, ['alt' => "Esperando"]) ?></p>';
</script>

<div class="wrapper">
    <?php  
    echo $this->render('header.php', ['baserUrl' => $baseUrl, 'title'=>Yii::$app->name]);
          
    if (!\Yii::$app->user->isGuest) {
            echo $this->render('leftside.php', ['baserUrl' => $baseUrl]);
        }       
    echo $this->render('content.php', ['content' => $content]);
    echo $this->render('footer.php', ['baserUrl' => $baseUrl]);
    ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<script src="../../../js/ready.js" type="text/javascript"></script>


