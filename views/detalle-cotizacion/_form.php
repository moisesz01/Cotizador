<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DetalleCotizacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detalle-cotizacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cotizacion_id')->textInput() ?>

    <?= $form->field($model, 'paquete_id')->textInput() ?>

    <?= $form->field($model, 'cantidad')->textInput() ?>

    <?= $form->field($model, 'precio')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
