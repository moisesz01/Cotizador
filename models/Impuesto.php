<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "impuesto".
 *
 * @property integer $id
 * @property double $valor
 */
class Impuesto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'impuesto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['valor'], 'required'],
            [['valor'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'valor' => 'Valor',
        ];
    }
}
