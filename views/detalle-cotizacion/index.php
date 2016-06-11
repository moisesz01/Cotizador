<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DetalleCotizacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detalle Cotizacions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detalle-cotizacion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Detalle Cotizacion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'cotizacion_id',
            'paquete_id',
            'cantidad',
            'precio',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
