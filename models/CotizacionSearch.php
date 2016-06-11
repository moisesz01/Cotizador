<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cotizacion;

/**
 * CotizacionSearch represents the model behind the search form about `app\models\Cotizacion`.
 */
class CotizacionSearch extends Cotizacion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cliente_id', 'user_id'], 'integer'],
            [['fecha'], 'safe'],
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
        $query = Cotizacion::find();

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
            'cliente_id' => $this->cliente_id,
            'user_id' => $this->user_id,
            'fecha' => $this->fecha,
        ]);

        return $dataProvider;
    }
}
