<?php 
    
use common\widgets\Alert;
use common\components\Moneda;

 $imagenes =[
        'am'=>'mbr-1587x1080.jpg',
        'pm'=>'mbr-1-1920x1080.jpg',
        'noche'=> 'mbr-8-1620x1080.jpg',
 ]; 
       
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="/visitante/assets/images/logo4.png" type="image/x-icon">
  <meta name="description" content="">
  <title>Inicio</title>
  <link rel="stylesheet" href="/visitante/assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="/visitante/assets/tether/tether.min.css">
  <link rel="stylesheet" href="/visitante/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/visitante/assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="/visitante/assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="/visitante/assets/theme/css/style.css">
  <link rel="stylesheet" href="/visitante/assets/mobirise/css/mbr-additional.css" type="text/css">
</head>
<body>

<style>
.cid-qVsswPw4CU {
    background-image: url(/visitante/assets/images/<?= $imagenes[Moneda::hora()]; ?>) !important;
}
</style>
  
    <?= $content ?>

  <script src="/visitante/assets/web/assets/jquery/jquery.min.js"></script>
  <script src="/visitante/assets/popper/popper.min.js"></script>
  <script src="/visitante/assets/tether/tether.min.js"></script>
  <script src="/visitante/assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="/visitante/assets/smoothscroll/smooth-scroll.js"></script>
  <script src="/visitante/assets/parallax/jarallax.min.js"></script>
  <script src="/visitante/assets/theme/js/script.js"></script>
  
  
</body>
</html>