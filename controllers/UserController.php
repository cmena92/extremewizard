<?php

namespace app\controllers;

use Yii;
use app\models\user;
use app\models\search\UserSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


use app\models\SignupForm;
/**
 * UserController implements the CRUD actions for user model.
 */
class UserController extends BaseController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all user models.
     * @return mixed
     */
    public function actionContrasena($id)
    {
        $model=$this->findModel($id);  
        if(isset($_POST))
            if(isset($_POST['SignupForm']['password'])){
                $user=$model;				
                $user->setPassword($_POST['SignupForm']['password']);
                $user->generateAuthKey(); 
                if ($user->save()) {
                    return $this->redirect(['view','id'=>$user->id]);                     
                }else{
                   
                    print_r($user->errors);
                    die;
                }                   
            }
                
        return $this->render('contrasena', [
            'model' => $model,
        ]);
    }
    
    /**
     * Lists all user models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single user model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new user model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {   
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            $model->rol=$_POST['SignupForm']['rol'];
            if ($user = $model->signup()) {               
                    return $this->redirect(['view','id'=>$user->id]);
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);    
    }

    /**
     * Updates an existing user model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->rol_id=$_POST['User']['rol_id'];
            $model->username=$_POST['User']['username'];
            $model->email=$_POST['User']['email'];
            $model->status=$_POST['User']['status'];
            $model->rol_id=$_POST['User']['rol_id'];
            $model->configs=$_POST['User']['configs'];
            $model->save();
            if($model->save())
				return $this->redirect(['view', 'id' => $model->id]);
			else{
				var_dump($model->errors);
				die;
			}
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);           
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing user model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the user model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return user the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = user::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
