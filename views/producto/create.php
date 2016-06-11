<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Producto */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Crear Producto';
?>
<div class="producto-create">

    <h1><?= Html::encode('Crear Producto') ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
