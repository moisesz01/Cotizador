<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Producto;

/* @var $this yii\web\View */
/* @var $model app\models\Inventario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inventario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, "producto_id")->dropDownList(
	        ArrayHelper::map($productos,'id','producto'),
	        ['prompt'=>'Seleccione Producto...']); 
	 ?> 

    <?= $form->field($model, 'cantidad')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
