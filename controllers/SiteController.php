<?php

namespace app\controllers;

use Yii;
use app\models\LoginForm;
use app\models\SisConfiguraciones;
use app\models\Cuenta;

/**
 * Site controller
 */
class SiteController extends BaseController {

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public static function actualizarTipoCambio() {
        try {
            $fecha = date('d/m/Y');
            $url = "https://api.hacienda.go.cr/indicadores/tc/dolar";
          
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
				  CURLOPT_SSLVERSION => 6,
                CURLOPT_HTTPHEADER => array(
                    "Cache-Control: no-cache",
                    "Content-Type: application/x-www-form-urlencoded",
                ),
            ));

            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
			$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $response = curl_exec($curl);
            $response = json_decode($response); 
            curl_close($curl);
           // var_dump($code);die;
		    if(isset($response->compra->valor))
            SisConfiguraciones::setTipoCambio($response->compra->valor, $response->compra->fecha);
            
        } catch (Exception $e) {
            return false;
        }
    }
    
    public function actionIndex() {
        if (Yii::$app->user->identity) {
            $this->layout = 'main';
            return $this->render('index',['config'=>$this->config]);
        }else {
            return $this->redirect('login');

            /*
              $this->layout = 'visitante';
              return $this->render('visitante');
             */
        }
    }

    public function actionAyuda() {
        return $this->render('ayuda');
    }

    public function actionPerfil() {
        echo 'Perfil';
        die;
    }

    public function actionLogin() {
        $this->layout = 'main';
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
