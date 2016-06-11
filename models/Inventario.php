<?php

namespace app\models;

use Yii;
use yii\db\query;

/**
 * This is the model class for table "inventario".
 *
 * @property integer $id
 * @property integer $cantidad
 * @property integer $producto_id
 *
 * @property Producto $producto
 */
class Inventario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inventario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cantidad', 'producto_id'], 'required'],
            [['cantidad', 'producto_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cantidad' => 'Cantidad',
            'producto_id' => 'Producto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Producto::className(), ['id' => 'producto_id']);
    }
    public function getDetalle($id){
        
        $query = new Query;
        $query->select([
            'producto.id AS id',
            'CONCAT(tipo_producto.descripcion," ",marca.nombre," ", producto.nombre,", ",producto.descripcion) As detalle'
        ])
        ->from('producto')
        ->join('JOIN','tipo_producto','tipo_producto.id=producto.tipo_producto_id')
        ->join('JOIN','marca','marca.id=producto.marca_id')
        ->where('producto.id=:idproducto',[':idproducto'=>$id]);
        $command = $query->createCommand();
        $producto = $command->queryOne();
        return $producto['detalle'];

    }
}
