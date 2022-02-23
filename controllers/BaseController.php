<?php 
namespace app\controllers; 
use Yii; 
use yii\web\Controller; 
use app\models\sistema\AccessHelpers;
use app\models\Configuraciones;
use app\models\SisConfiguraciones;
use app\models\permisos\Operacion;
use app\models\permisos\RolOperacion;
 
class BaseController extends Controller { 
 
    public $config;
 
    public function beforeAction($action) {
       $operacion = str_replace("/", "-", Yii::$app->controller->route);  
       $permitirSiempre = ['site-ayuda','site-dashboard', 'site-index', 'site-error', 'site-about', 'site-login', 'site-logout'];
    

       if (Yii::$app->user->identity){      
           if (\Yii::$app->user->isGuest) {
                $this->layout = 'visitante';
                if($operacion != 'site-index' && $operacion != 'site-login')
                    $this->redirect('/site/index');
            }
           
		   /*
            if (!parent::beforeAction($action)) { 
                 return false; 
            }*/ 
            
           
            if (in_array($operacion, $permitirSiempre)) {
                return true;
            }

		
            if (!AccessHelpers::getAcceso($operacion)) {				
				if(Yii::$app->user->identity->rol_id == 1){
					$model = new Operacion();
					$model->nombre = $operacion;
					if(Operacion::crearOperacion($model))
						Yii::$app->session->setFlash('success', 'La operación '.$model->nombre.' fue creada correctamente.');
			
					return true;
				}
					
                echo $this->render('/site/nopermitido',
                        ['operacion'=>$operacion]);
                return false;
            }
            
            return true;
       }else{
           if (in_array($operacion, $permitirSiempre)) {
                return true;
           }
           return $this->redirect(['/site/login']);
       }
    }
}

