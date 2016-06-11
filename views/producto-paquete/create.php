<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProductoPaquete */

$this->title = 'Create Producto Paquete';
$this->params['breadcrumbs'][] = ['label' => 'Producto Paquetes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-paquete-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
