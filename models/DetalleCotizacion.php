<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detalle_cotizacion".
 *
 * @property integer $id
 * @property integer $cotizacion_id
 * @property integer $paquete_id
 * @property integer $cantidad
 * @property double $precio
 *
 * @property Cotizacion $cotizacion
 * @property Paquete $paquete
 */
class DetalleCotizacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detalle_cotizacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['paquete_id', 'cantidad'], 'required'],
            [['cotizacion_id', 'paquete_id', 'cantidad'], 'integer'],
            [['precio'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cotizacion_id' => 'Cotizacion ID',
            'paquete_id' => 'Nombre del Paquete',
            'cantidad' => 'Cantidad',
            'precio' => 'Precio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCotizacion()
    {
        return $this->hasOne(Cotizacion::className(), ['id' => 'cotizacion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaquete()
    {
        return $this->hasOne(Paquete::className(), ['id' => 'paquete_id']);
    }
}
