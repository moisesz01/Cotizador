<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "paquete".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property double $costo
 *
 * @property DetalleCotizacion[] $detalleCotizacions
 * @property ProductoPaquete[] $productoPaquetes
 */
class Paquete extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'paquete';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion'], 'required'],
            [['costo'], 'number'],
            [['nombre'], 'string', 'max' => 45],
            [['descripcion'], 'string', 'max' => 140]
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
            'costo' => 'Costo del Paquete',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleCotizacions()
    {
        return $this->hasMany(DetalleCotizacion::className(), ['paquete_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductoPaquetes()
    {
        return $this->hasMany(ProductoPaquete::className(), ['paquete_id' => 'id']);
    }
}
