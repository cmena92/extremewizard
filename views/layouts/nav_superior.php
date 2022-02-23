<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;



use app\models\sistema\AccessHelpers;

$local = 0;
$clas_nav = 'navbar-inverse navbar-fixed-top';
$label = 'WIZARD';

	


            NavBar::begin([
                'brandLabel' => $label,
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => $clas_nav
                ],
            ]);
            $menuItems = [
                ['label' => Yii::t("app", 'Home'), 'url' => ['/site/index']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => Yii::t("app", 'Login'), 'url' => ['/site/login']];
            } else {
              
                $menuItems[] = [
                    'label' => Yii::t("app", 'Rigths'),
                    'visible' => AccessHelpers::getAcceso('user-index'),
                    'submenuOptions' => [],
                    'items' => [
                        ['label' => Yii::t("app", 'Users'), 'url' => ['/user/index'], 'visible' => AccessHelpers::getAcceso('user-index')],
                        ['label' => Yii::t("app", 'Rols'), 'url' => ['/rol/index'], 'visible' => AccessHelpers::getAcceso('rol-index')],
                        ['label' => Yii::t("app", 'Operations'), 'url' => ['/operacion/index'], 'visible' => AccessHelpers::getAcceso('operacion-index')],
                    ],
                ];
								
                $menuItems[] = [
                    'label' => Yii::t("app", 'Facturacion'),
                    'visible' => AccessHelpers::getAcceso('factura-index'),
                    'submenuOptions' => [],
                    'items' => [
                        ['label' => Yii::t("app", 'Ventas'), 'url' => ['/factura/index','sort'=>'-id'], 'visible' => AccessHelpers::getAcceso('factura-index')],
                        ['label' => Yii::t("app", 'Colaboradores'), 'url' => ['/colaborador/index','sort'=>'nombre'], 'visible' => AccessHelpers::getAcceso('factura-index')],
                        [
                            'label' => Yii::t("app", 'Nueva VENTA'), 
                            'url' => ['/factura/create'],
                            'visible' => AccessHelpers::getAcceso('factura-create')
                        ],
                        [
                            'label' => Yii::t("app", 'Confirmar Gastos'), 
                            'url' => ['/recibir-factura/index'],
                            'type'=>'post',
                            'visible' => AccessHelpers::getAcceso('recibir-factura-index')
                        ],
                    ],
                ];
             
                $menuItems[] = [
                    'label' => Yii::t("app", 'Logout') . '(' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
            ?>
