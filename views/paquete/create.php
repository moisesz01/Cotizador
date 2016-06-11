<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Paquete */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Paquetes', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Crear Paquete';
?>
<div class="paquete-create">

    <h1><?= Html::encode('Crear Paquete') ?></h1>

    <?= $this->render('_form', [
        'modelPaquete' => $modelPaquete,
        'modelsProducto' =>$modelsProducto,
        'productos'=> $productos,
    ]) ?>

</div>
