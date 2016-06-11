<?php

namespace app\controllers;

use Yii;
use app\models\RegisterForm;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\db\Query;

/**
 * ActividadController implements the CRUD actions for actividad model.
 */
class UserController extends Controller
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
     * Lists all actividad models.
     * @return mixed
     */
    
    public function actionRegister()
    {
        $model = new RegisterForm();
        $query = new Query;
        $query->select([
            'ai.name AS rol',
        ])
        ->from('auth_item AS ai')
        ->where('ai.type=:idRol',[':idRol'=>1]);
        $command = $query->createCommand();
        $roles = $command->queryAll();
        if (Yii::$app->request->isAjax && $model->load($_POST)){
            Yii::$app->response->format = 'json';
            return \yii\widgets\ActiveForm::validate($model);
        }else if ($model->load(Yii::$app->request->post())) { 
            $modelUser = new User();
            $modelUser->username = $model->username;
            $modelUser->setPassword($model->password);
            $modelUser->generateAuthKey();
            $modelUser->email = $model->email;
            $modelUser->nombre_apellido = $model->nombre_apellido;
            
            $modelUser->insert();
            $auth=Yii::$app->authManager;
            $rol=$auth->getRole($model->rol);
            $auth->assign($rol, $modelUser->id);
            Yii::$app->session->setFlash('success','Usuario Creado con Éxito');
            return $this->goHome();   

        }         

        return $this->render('register',[
            'model'=>$model,
            'roles'=>$roles,
        ]);
    }

}