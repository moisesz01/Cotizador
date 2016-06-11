<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cotizacion */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Cotizacions', 'url' => ['index']];
$this->params['breadcrumbs'][] ='Crear Cotización';
?>
<div class="cotizacion-create">

    <h1><?= Html::encode('Crear Cotización') ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'mensajes' => $mensajes,
        'clientes' => $clientes,
        'modelsDetalle' => (empty($modelsDetalle)) ? [new DetalleCotizacion] : $modelsDetalle
    ]) ?>

</div>
