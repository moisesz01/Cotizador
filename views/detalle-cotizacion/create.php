<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DetalleCotizacion */

$this->title = 'Create Detalle Cotizacion';
$this->params['breadcrumbs'][] = ['label' => 'Detalle Cotizacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detalle-cotizacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
