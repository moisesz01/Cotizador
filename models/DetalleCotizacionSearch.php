<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DetalleCotizacion;

/**
 * DetalleCotizacionSearch represents the model behind the search form about `app\models\DetalleCotizacion`.
 */
class DetalleCotizacionSearch extends DetalleCotizacion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cotizacion_id', 'paquete_id', 'cantidad'], 'integer'],
            [['precio'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = DetalleCotizacion::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'cotizacion_id' => $this->cotizacion_id,
            'paquete_id' => $this->paquete_id,
            'cantidad' => $this->cantidad,
            'precio' => $this->precio,
        ]);

        return $dataProvider;
    }
}
