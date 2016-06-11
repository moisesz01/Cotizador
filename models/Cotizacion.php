<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cotizacion".
 *
 * @property integer $id
 * @property integer $cliente_id
 * @property integer $user_id
 * @property string $fecha
 *
 * @property Cliente $cliente
 * @property User $user
 * @property DetalleCotizacion[] $detalleCotizacions
 */
class Cotizacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cotizacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cliente_id', 'user_id', 'fecha'], 'required'],
            [['cliente_id', 'user_id'], 'integer'],
            [['descuento'], 'number'],
            [['fecha'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cliente_id' => 'Cliente',
            'user_id' => 'Usuario',
            'fecha' => 'Fecha',
            'descuento' => '% de Descuento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Cliente::className(), ['id' => 'cliente_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleCotizacions()
    {
        return $this->hasMany(DetalleCotizacion::className(), ['cotizacion_id' => 'id']);
    }

    public function getRucCliente($id){

        $cliente = Cliente::find()->where(['id'=>$id])->one();
        return $cliente->ruc;

    }
    public function getNombresCliente($id){

        $cliente = Cliente::find()->where(['id'=>$id])->one();
        return $cliente->nombres." ".$cliente->apellidos;

    }
     public function getVendedor($id){

        $vendedor = User::find()->where(['id'=>$id])->one();
        return $vendedor->nombre_apellido;
    }

}
