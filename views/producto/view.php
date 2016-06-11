<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id;
?>
<div class="producto-view">

    <h1><?= Html::encode('Detalle del producto: ') ?></h1>

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
            'nombre',
            'descripcion',
            'tipoProducto.descripcion',
            'marca.nombre',
            'costo',
        ],
    ]) ?>

    <?= Html::a(' <span class="glyphicon glyphicon-circle-arrow-left"> </span>  Volver', ['producto/index'] , ['class'=>'btn btn-success', 'style'=>'margin-top:20px;']) ?>

</div>
