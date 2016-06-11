<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\User;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['login']);
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionPasswordReset(){
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {                
                Yii::$app->getSession()->setFlash('success', 'Chequea tu Correo Electrónico y sigue las instrucciones.');
                return $this->render('forgetRequestPassword', [
                    'model' => $model,
                ]);
            } else {
                Yii::$app->getSession()->setFlash('error', 'Disculpe, no estamos habilitados para reiniciar contraseña con el correo suministrado.');
            }
        }

        return $this->render('forgetRequestPassword', [
            'model' => $model,
        ]);

    }
    public function actionReset($token)
    {
        try {
            $model = new ResetPasswordForm($token);
            $valid=$model['tokenValid'];
            if(isset($valid)){
                Yii::$app->getSession()->setFlash('error', 'Token de Reinicio de contraseña errado.'); 
                return $this->render('_tokenfailed');
            }
            else{
                if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
                    Yii::$app->getSession()->setFlash('success', 'Contraseña guardada con éxito.');
                }    
            }
            
        } catch (InvalidParamException $e) {
            Yii::$app->getSession()->setFlash('error', 'Token de Reinicio de contraseña errado, por favor vuelva a recuperar su contraseña .');
        }
        return $this->render('reset', [
            'model' => $model,
        ]);
    }
}
