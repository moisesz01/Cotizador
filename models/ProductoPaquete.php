<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "producto_paquete".
 *
 * @property integer $id
 * @property integer $producto_id
 * @property integer $paquete_id
 * @property integer $cantidad_productos
 *
 * @property Paquete $paquete
 * @property Producto $producto
 */
class ProductoPaquete extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'producto_paquete';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cantidad_productos'], 'required'],
            [['producto_id', 'paquete_id', 'cantidad_productos'], 'integer'],
            [['producto_id', 'paquete_id'], 'unique', 'targetAttribute' => ['producto_id', 'paquete_id'], 'message' => 'The combination of Producto ID and Paquete ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'producto_id' => 'Producto',
            'paquete_id' => 'Paquete ID',
            'cantidad_productos' => 'Cantidad de Productos',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaquete()
    {
        return $this->hasOne(Paquete::className(), ['id' => 'paquete_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Producto::className(), ['id' => 'producto_id']);
    }
}
