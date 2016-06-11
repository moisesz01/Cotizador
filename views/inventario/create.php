<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Inventario */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Inventarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Crear Inventario';
?>
<div class="inventario-create">

    <h1><?= Html::encode('Crear Inventario') ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'productos' => $productos,
    ]) ?>

</div>
