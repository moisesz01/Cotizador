<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Inventario */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Inventarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="inventario-update">

    <h1><?= Html::encode('Actualizar Inventario: ' . ' ' . $model->id) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'productos' => $productos,
    ]) ?>

</div>
