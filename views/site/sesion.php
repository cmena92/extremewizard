<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Sesion '.$cuenta->NombreCuenta;
$this->params['breadcrumbs'][] = $this->title;
date_default_timezone_set('America/Costa_Rica');
$token = $cuenta->token;
?>
<div class="sis-configuraciones-view">



    <div class="col-xs-6 col-sm-6 col-md-6">
        <table id="w0" class="table table-striped table-bordered detail-view">
            <tbody>
                <tr>
                    <th>Ahora</th>
                    <td><?= date('Y-m-d h:i:s a', strtotime('now')) ?></td>
                    <td><?= strtotime('now'); ?></td>
                </tr>
                <tr>
                    <td colspan='3'></td>
                </tr>
                 <tr>
                    <th>APP</th>
                    <td><?= (strtotime('now') < $cuenta->appActiva)?'Activa':'Inactiva' ?></td>
                    <td></td>
                </tr>
                <tr>
                    <th>Vence</th>
                    <td><?= date('Y-m-d h:i:s a', $cuenta->appActiva) ?></td>
                    <td><?= $cuenta->appActiva ?></td>
                </tr>
                
                <tr>
                    <td colspan='3'></td>
                </tr>
                <tr>
                    <th>Sesion DGT</th>
                    <td><?= (isset($token->refresh_session_limit)) ? ((strtotime('now') < $token->refresh_session_limit) ? 'Activa' : 'Inactiva') : 'N/A' ?></td>
                    <td></td>
                </tr>
                <tr>
                    <th>Vence</th>
                    <td><?= (isset($token->refresh_session_limit)) ? date('Y-m-d h:i:s a', $token->refresh_session_limit) : 'N/A'; ?></td>
                    <td><?= $token->refresh_session_limit; ?></td>
                </tr>
                <tr>
                    <td colspan='3'></td>
                </tr>
                <tr>
                    <th>Token DGT</th>
                    <td><?= ($token->refresh_token_limit > strtotime('now')) ? 'Activo' : 'Inactivo' ?></td>
                    <td></td>
                </tr>
                <tr>
                    <th>Token DGT</th>
                    <td><?= ($token->refresh_token_limit != 0) ? date('Y-m-d h:i:s a', $token->refresh_token_limit) : 0; ?></td>
                    <td><?= $token->refresh_token_limit; ?></td>
                </tr>
            </tbody>
        </table>
        <ul>
            <li>
                <a href="/sistema/refrescar-sesion-dgt?id=<?= $cuenta->idCuenta ?>">REFRESCAR SESION DGT</a>
            </li>
            <li>
                <a href="/sistema/enviar-facturas">ENVIAR FACTURAS</a>
            </li>
            
        </ul>
        <hr>
          <ul>
            <li>
                <a href="/sistema/cerrar-sesion-dgt?id=<?= $cuenta->idCuenta ?>">Cerrar session</a>
            </li>            					
            <li>
                <a href="/factura/generarxmls">Xmls</a>
            </li>					
            <li>
                <a href="/factura/generar-pdf">PDFs</a>
            </li>					
            <li>
                <a href="/dgt/enviar?tipo=01">Enviar</a>
            </li>					
            <li>
                <a href="/dgt/estado?tipo=01">Estados</a>
            </li>
        </ul>

    </div>

    <div class="col-xs-6 col-sm-6 col-md-6">


        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-md-6 col-lg-6">	
                <?= $form->field($cuenta, 'jobEscanear')->checkbox(array('label' => 'Escanear')); ?>

                <?= $form->field($cuenta, 'jobXml')->checkbox(array('label' => 'Xml')); ?>

                <?= $form->field($cuenta, 'jobPdf')->checkbox(array('label' => 'Pdf')); ?>

                <?= $form->field($cuenta, 'jobEnviar')->checkbox(array('label' => 'Enviar')); ?>

                <?= $form->field($cuenta, 'jobEstado')->checkbox(array('label' => 'PdfEstado')); ?>

                <?= $form->field($cuenta, 'jobDgt')->checkbox(array('label' => 'Dgt Sesion')); ?>

                <?= $form->errorSummary($cuenta); ?>

                <div class="form-group">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
                </div>

            </div>

        </div>


        <?php ActiveForm::end(); ?>	
    </div>

</div>
