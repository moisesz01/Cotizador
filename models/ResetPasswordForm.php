<?php
namespace app\models;

use app\models\User;
use yii\base\InvalidParamException;
use yii\base\Model;
use Yii;
use kartik\password\StrengthValidator;
/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;
    public $tokenValid;

    /**
     * @var \common\models\User
     */
    private $_user;


    /**
     * Creates a form model given a token.
     *
     * @param  string                          $token
     * @param  array                           $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            //Yii::$app->getSession()->setFlash('error', 'El token de reinicio de contraseña no puede estar en blanco.');
            
            throw new InvalidParamException('El token de reinicio de contraseña no puede estar en blanco.');
        }
        $this->_user = User::findByPasswordResetToken($token);
        if (!$this->_user) {
            $this->tokenValid=false;
        }else
            $this->tokenValid=true;
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required'],
        ];
    }
     public function attributeLabels()
    {
        return [
            'password' => Yii::t('app', 'Contraseña'),
        ];
    }

    /**
     * Resets password.
     *
     * @return boolean if password was reset.
     */
    public function resetPassword()
    {
       // if ($this->tokenValid) {
            $user = $this->_user;
            $user->setPassword($this->password);
            $user->removePasswordResetToken();
            return $user->save();
        //}
        
    }
}
