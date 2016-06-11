<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Paquete */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Paquetes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id;
?>
<div class="paquete-view">

    <h1><?= Html::encode('Detalle del Paquete:'. $model->id) ?></h1>

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
            'costo',
        ],
    ]) ?>
    <div class="producto_paquete">
        <h2 style="text-align:center;padding-bottom: 20px;">Productos del Paquete</h2>

    <table class="table table-striped table-bordered" style="text-align:center;">
        <tr>
          <td><strong>Detalle del Producto</strong></td>
          <td><strong>Cantidad del producto</strong></td>
          
          
          
        </tr>
         <?php foreach ($productos as $value):?>
            <tr>
                <td><?=$value['producto']?></td>
              
                <td>
                    <?= $value['cantidad']?>  
                </td>
              
            </tr>
        <?php endforeach;?>
    </table>
    </div>
    

    <?= Html::a(' <span class="glyphicon glyphicon-circle-arrow-left"> </span>  Volver', ['paquete/index'] , ['class'=>'btn btn-success', 'style'=>'margin-top:20px;']) ?>
</div>
