<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\LocProvincia;
use app\models\LocCanton;
use app\models\LocDistrito;
use app\models\LocBarrio;


$tab = (isset($_SESSION['tab'])) ? $_SESSION['tab'] : 1;

?>


    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->errorSummary($model); ?>
    
<ul class="nav nav-tabs">
        <li class="<?= ($tab==1)?'active':'' ?>">
            <a onclick="setTab(1)" href="#panel-1" data-toggle="tab"   aria-expanded="false">Empresa</a>
        </li>                
        <li class="<?= ($tab==2)?'active':'' ?>">
            <a onclick="setTab(2)" href="#panel-2" data-toggle="tab"   aria-expanded="false">Hacienda</a>
        </li>
        <li class="<?= ($tab==3)?'active':'' ?>">
            <a onclick="setTab(3)" href="#panel-3" data-toggle="tab"   aria-expanded="false">Sistema</a>
        </li>
       <li class="<?= ($tab==4)?'active':'' ?>">
            <a onclick="setTab(4)" href="#panel-4" data-toggle="tab"   aria-expanded="false">Parametros</a>
        </li>
     
        
    </ul>
    
    <div class="tab-content">
        <div class="tab-pane <?= ($tab==1)?'active':'' ?>" id="panel-1">
             
            <div class="col-sm-4">
               <h2>Empresa</h2>
                    <?= $form->field($model, 'NombreComercial')->textInput() ?>

                    <?= $form->field($model, 'Persona')->dropDownList(
                        [
                            1=>'Fisica',
                            2=>'Jurídica',
                            3=>'DIMEX',
                            4=>'NITE',
                        ],           
                        ['prompt'=>'Seleccione por favor']    
                    ); ?>
                        
                    <?= $form->field($model, 'Cedula')->textInput() ?>
                    
                    <?= $form->field($model, 'Slogan')->textInput() ?>
                    
                    <?php // $form->field($model, 'Logo')->textInput() ?>
            </div>
            <div class="col-sm-4">
               <h2>Dirección</h2>

                <?= $form->field($model, 'Provincia')->dropDownList(
                        LocProvincia::getProvincias(),           
                        [
                            'prompt'=>'Seleccione por favor',
                            'onchange'=>'buscar_ubicacion("cantones")'
                        ]    
                ); ?>
 
               
 
                <?php // $form->field($model, 'Canton')->textInput() ?>
                
                <?php echo $form->field($model, 'Canton')->dropDownList(
                        LocCanton::getCantones($model->Provincia),           
                        [
                            'prompt'=>'Seleccione por favor',
                            'onchange'=>'buscar_ubicacion("distritos")'
                        ]    
                ); ?>
               
               <?php $form->field($model, 'Distrito')->dropDownList(
                        LocDistrito::getDistritos($model->Canton,$model->Provincia),           
                        [
                            'prompt'=>'Seleccione por favor',
                            'onchange'=>'buscar_ubicacion("barrios")'
                        ]    
                ); ?>
 
                <a target="_blank" href="https://tribunet.hacienda.go.cr/docs/esquemas/2016/v4.2/Codificacionubicacion_V4.2.pdf">Ver codificación para cantones, distritos y barrios</a>
 
                    <?= $form->field($model, 'Distrito')->textInput() ?>
                    <?= $form->field($model, 'Barrio')->textInput() ?>
                    
                <?php $form->field($model, 'Barrio')->dropDownList(
                        LocBarrio::getBarrios($model->Distrito,$model->Canton,$model->Provincia),           
                        [
                            'prompt'=>'Seleccione por favor',
                        ]    
                ); ?>
                                
                <?= $form->field($model, 'OtrasSenas')->textInput() ?>
            </div>
                       <div class="col-sm-4">
                    <h2>Contácto</h2>
                    <?= $form->field($model, 'Telefono')->textInput() ?>

                    <?= $form->field($model, 'Correo')->textInput() ?>
                      
                    <?= $form->field($model, 'Fax')->textInput() ?>

    </div>
        </div>
        
        <div class="tab-pane <?= ($tab==2)?'active':'' ?>" id="panel-2">
        
            <div class="col-sm-12">
               <h2>Dirección General de Tributación</h2>  
              
             </div>
            
            <div class="row">
                <div class="col-sm-6">
                     <?= $form->field($model, 'Ambiente')->dropDownList(
                    [
                    \app\models\SisConfiguraciones::PRUEBAS => 'Pruebas',
                    \app\models\SisConfiguraciones::PRODUCCION => 'Produccion',
                    ],           
                    [
                        'prompt'=>'Seleccione por favor',
                        'onchange'=>'cambiarAmbiente(this)'
                    ]    
                ); ?>                  
                 </div> 
             </div> 
                       
            <div class="row">
            <div id="div_produccion" class="col-sm-6  <?= ($model->Ambiente)?'':'hidden' ?> <?= $model->estadoProd ?>">
                
               <h2>Produccion</h2>
                              
                <?= $form->field($model, 'ProdUsuarioDGT')->textInput() ?>

                <?= $form->field($model, 'ProdClaveDGT')->textInput() ?>

                <table class="table table-results">
                   <tbody>
                       
                        <tr>
                            <td class="<?= $model->estadoProd ?>">Estado acceso al API</td>
                            <td ><span class="<?= $model->estadoProd ?>"><?= ($model->estadoProd=='danger')?'Inválido':'Listo' ?></span></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-right">
                                <b><?php echo $model->mensajeApi; ?></b>
                            </td>
                        </tr>
                    </tbody>                       
                </table>
                
                <?= $form->field($model, 'ProdArchivoP12')->textInput() ?>
               
                <?= $form->field($model, 'ProdPinArchivoP12')->textInput() ?>
                
                 <table class="table table-results">
                   <tbody>
                        <tr>
                            <td class="<?= $model->mensajeFirma ?>">Estado firma digital </td>
                            <td ><span class="<?= $model->mensajeFirma ?>"><?= ($model->mensajeFirma=='danger')?'Inválida':'Válida' ?></span></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-right">
                                <b><?php echo ($model->mensajeFirma=='danger')?
                                'No se pueden firmar documentos con este pin y certificado.':
                                'Firma válida.' ?></b>
                            </td>
                        </tr>
                    </tbody>                       
                </table>
            </div>
               
            <div id="div_pruebas" class="col-sm-6 <?= ($model->Ambiente)?'hidden':'' ?> <?= $model->estadoProd ?>">
                
               <h2>Pruebas</h2>
                   
                <?= $form->field($model, 'StgUsuarioDGT')->textInput() ?>

                <?= $form->field($model, 'StgClaveDGT')->textInput() ?>
                
               <table class="table table-results">
                   <tbody>
                        <tr>
                            <td class="<?= $model->estadoStg ?>">Estado acceso al API</td>
                            <td ><span class="<?= $model->estadoStg ?>"><?= ($model->estadoStg=='danger')?'Inválido':'Listo' ?></span></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-right">
                                <b><?php echo $model->mensajeApi; ?></b>
                            </td>
                        </tr>
                    </tbody>                       
                </table>
                
                
                
                <?= $form->field($model, 'StgArchivoP12')->textInput() ?>
               
                <?= $form->field($model, 'StgPinArchivoP12')->textInput() ?>
                               
                   
               <table class="table table-results">
                   <tbody>
                        <tr>
                            <td class="<?= $model->mensajeFirma ?>">Estado firma digital </td>
                            <td ><span class="<?= $model->mensajeFirma ?>"><?= ($model->mensajeFirma=='danger')?'Inválida':'Válida' ?></span></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-right">
                                <b><?php echo ($model->mensajeFirma=='danger')?
                                'No se pueden firmar documentos con este pin y certificado.':
                                'Firma válida.' ?></b>
                            </td>
                        </tr>
                    </tbody>                       
                </table>
                
            </div>
            
            
          </div>
        </div> 
        
        <div class="tab-pane <?= ($tab==3)?'active':'' ?>" id="panel-3">
            <div class="col-sm-4">       
               <h2>Sistema</h2> 

                <?= $form->field($model, 'ClientePorDefecto')->textInput() ?>
                
              
                
                <?= $form->field($model, 'Moneda')->textInput() ?>
                
                <?= $form->field($model, 'Sucursal')->textInput() ?>
                
                <?= $form->field($model, 'Terminal')->textInput() ?>
                   
                
                <?php $form->field($model, 'Inventario')->dropDownList(
                        [
                            1=>'Mostrar',
                            0=>'Ocultar',
                        ],           
                        [
                            'prompt'=>'Seleccione por favor',
                            'onchange'=>'activarInventario(this)'
                        ]    
                    ); ?>
                  <span id="conf_inventario" class="<?= (!$model->Inventario)?'hidden':'' ?>">  
                <?= $form->field($model, 'GrupoDeActivos')->textInput() ?>

                <?= $form->field($model, 'NombreDeLotes')->textInput() ?>
                </span>
            </div>
            
                  <div  class="col-sm-6">
                  <h2>Factura PDF</h2>
                <?php echo $form->field($model, 'MostrarSloganEnFactura')->dropDownList(
                        [
                            1=>'Mostrar',
                            0=>'Ocultar',
                        ],           
                        ['prompt'=>'Seleccione por favor']    
                    ); ?>
                    
                  <?php echo $form->field($model, 'PlantillaPdf')->dropDownList(
                        [
                            'documento_pdf.php'=>'Lite Black',
                            'documento_pdf_bt.php'=>'bootstrap',
                            'documento_pdf_talonario.php'=>'Talonario',
                            'documento_pdf_liteOn.php'=>'LiteOn',
                        ],           
                        ['prompt'=>'Seleccione por favor']    
                    ); ?>
                  </div> 
                  
        </div>  

        <div class="tab-pane <?= ($tab==4)?'active':'' ?>" id="panel-4">
            <a href="/sisparams/index" class="btn btn-primary">Parametros</a>
        </div>

    </div>


        <div class="col-sm-12">      

            <div class="form-group"><br><br>
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
<div>
    <?php ActiveForm::end(); ?>
    
<?php $this->registerJsFile('/js/localizaciones.js'); ?>  
<?php $this->registerJsFile('/js/sistema_configuraciones.js'); ?>  
    
    <style>
        span.danger {
            background-color: #d9534f;
            color: white;
            padding: 5px;
        }
        span.success {
            background-color: #5cb85c;
            color: white;
            padding: 5px;
        }         
    </style>