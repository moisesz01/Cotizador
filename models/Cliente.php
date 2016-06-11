<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cliente".
 *
 * @property integer $id
 * @property string $nombres
 * @property string $apellidos
 * @property string $ruc
 * @property string $direccion
 *
 * @property Cotizacion[] $cotizacions
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombres', 'apellidos', 'ruc', 'direccion'], 'required'],
            [['nombres', 'apellidos', 'ruc'], 'string', 'max' => 45],
            [['direccion'], 'string', 'max' => 140]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'ruc' => 'Ruc',
            'direccion' => 'Direccion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCotizacions()
    {
        return $this->hasMany(Cotizacion::className(), ['cliente_id' => 'id']);
    }
    public function getFullName(){
        return $this->nombres.' '.$this->apellidos;
    }
}
