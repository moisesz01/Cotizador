<?php

namespace app\models;

use Yii;
use yii\base\Model;
use kartik\password\StrengthValidator;
use yii\validators\UniqueValidator;

/**
 * LoginForm is the model behind the login form.
 */
class RegisterForm extends Model
{
    public $username;
    public $nombre_apellido;
    public $email;
    public $password;
    public $password_repeat;
    public $rol;

    


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required', 'message' => 'Este campo no puede ser vacío.'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'El usuario ya se encuentra registrado.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['nombre_apellido', 'filter', 'filter' => 'trim'],
            ['nombre_apellido', 'required', 'message' => 'Este campo no puede ser vacío.'],
            ['nombre_apellido', 'string', 'min' => 2, 'max' => 90],

            ['password', 'required', 'message' => 'Este campo no puede ser vacío.'],
            [['password'], StrengthValidator::className(), 'preset'=>'normal', 'userAttribute'=>'username'],

            ['password_repeat', 'compare', 'compareAttribute' => 'password','message'=>'Las contraseñas deben ser identicas'],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required', 'message' => 'Este campo no puede ser vacío.'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'El correo electrónico ya se encuentra registrado.'],
            
            ['rol', 'required', 'message' => 'Este campo no puede ser vacío.'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'username' => 'Usuario',
            'password' =>'Contraseña',
            'password_repeat'=>'Repetir Contraseña',
            'email' => 'Correo Electrónico',
            'nombre_apellido' => 'Nombres'
        ];
    }

  
  
}
