<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CotizacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
$this->params['breadcrumbs'][] = 'Cotizaciones';
?>
<div class="cotizacion-index">

    <h1><?= Html::encode('Cotizaciones') ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Cotizacion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'cliente.nombres',
            'user.username',
            'fecha',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} '],
        ],
    ]); ?>

</div>
