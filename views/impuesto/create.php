<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Impuesto */

$this->title = 'Create Impuesto';
$this->params['breadcrumbs'][] = ['label' => 'Impuestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="impuesto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
