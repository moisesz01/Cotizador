<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Paquete */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Paquetes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelPaquete->id, 'url' => ['view', 'id' => $modelPaquete->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="paquete-update">

    <h1><?= Html::encode('Actualizar Paquete: ' . ' ' . $modelPaquete->id) ?></h1>

    <?= $this->render('_form', [
        'modelPaquete' => $modelPaquete,
        'productos' => $productos,
        'modelsProducto' => (empty($modelsProducto)) ? [new ProductoPaquete] : $modelsProducto
    ]) ?>

</div>
