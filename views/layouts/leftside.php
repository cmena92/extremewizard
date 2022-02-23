<?php

use adminlte\widgets\Menu;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel 
        <div class="user-panel">
            <div class="pull-left image">
			<?php //echo Html::img('@web/img/user2-160x160.PNG', ['class' => 'img-circle', 'alt' => 'User Image']) ?>
            </div>
            <div class="pull-left info">
                <p>Crisman</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Conectado</a>
            </div>
        </div>-->
        <!-- search form
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form> -->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <?=
        Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => 'MENU', 'options' => ['class' => 'header']],
                        ['label' => 'Inicio', 'icon' => 'fa fa-dashboard', 
                            'url' => ['/'], 
							'active' => $this->context->route == 'site/index'
                        ],
                        [
                            'label' => 'Facturación',
                            'icon' => 'fa fa-print',
                            'url' => '#',
                            'items' => [
                                [
                                    'label' => 'Ventas',
                                    'url' => '/factura/index',
									'active' => $this->context->route == 'factura/index'
                                ],
                                [
                                    'label' => 'Nueva Venta',
                                    'url' => '/factura/create',
									'active' => $this->context->route == 'factura/create'
                                ],
                                [
                                    'label' => 'Notas de Crédito',
                                    'url' => '/notacredito/index',
									'active' => $this->context->route == 'notacredito/index'
                                ],
                                [
                                    'label' => 'Recibir Facturas',
                                    'url' => '/recibir-factura/index',
									'active' => $this->context->route == 'recibir-factura/index'
                                ],                                
                            ]
                        ],		
						
						[
                            'label' => 'Clientes',
                            'icon' => 'fa fa-users',
                            'url' => '#',
                            'items' => [
                                [
                                    'label' => 'Lista',
                                    'url' => '/colaborador/index',
									'active' => $this->context->route == 'colaborador/index'
                                ],
                                [
                                    'label' => 'Nuevo Cliente',
                                    'url' => '/colaborador/create',
									'active' => $this->context->route == 'colaborador/create'
                                ],                               
                            ]
                        ],
                        [
							'label' => 'Salir', 
							'icon' => 'fa fa-exit', 
							'url' => ['/site/logout'],
							'linkOptions' => ['data-method' => 'post']
						],
                    ],
                ]
        )
        ?>
        
    </section>
    <!-- /.sidebar -->
</aside>
