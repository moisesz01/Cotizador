<?php

namespace app\models;
use app\models\TipoProducto;
use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property integer $tipo_producto_id
 * @property integer $marca_id
 * @property string $costo
 *
 * @property Inventario[] $inventarios
 * @property Marca $marca
 * @property TipoProducto $tipoProducto
 * @property ProductoPaquete[] $productoPaquetes
 */
class Producto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'tipo_producto_id', 'marca_id'], 'required'],
            [['tipo_producto_id', 'marca_id'], 'integer'],
            [['nombre', 'descripcion', 'costo'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'tipo_producto_id' => 'Tipo Producto ID',
            'marca_id' => 'Marca ID',
            'costo' => 'Costo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventarios()
    {
        return $this->hasMany(Inventario::className(), ['producto_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarca()
    {
        return $this->hasOne(Marca::className(), ['id' => 'marca_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoProducto()
    {
        return $this->hasOne(TipoProducto::className(), ['id' => 'tipo_producto_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductoPaquetes()
    {
        return $this->hasMany(ProductoPaquete::className(), ['producto_id' => 'id']);
    }
    public function getFullName(){
        //$ti=$this->tipo_producto_id;
       // $tipo = TipoProducto::find()->where($ti=>)
        $fullname = $this->nombre." ".$this->descripcion;
        
        return $fullname;
    }
}
