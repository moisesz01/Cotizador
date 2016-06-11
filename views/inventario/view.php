<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Inventario */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Inventarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id;
?>
<div class="inventario-view">

    <h1><?= Html::encode('Inventario: '.$model->id) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro que desea eliminar este item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label'=>'Producto',
                'value'=>$model::getDetalle($model->id),
            ],
            'cantidad',
        ],
    ]) ?>

    <?= Html::a(' <span class="glyphicon glyphicon-circle-arrow-left"> </span>  Volver', ['inventario/index'] , ['class'=>'btn btn-success', 'style'=>'margin-top:20px;']) ?>

</div>
