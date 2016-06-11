<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\TipoProducto;
use app\models\Marca;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-form">

    <?php $form = ActiveForm::begin(); ?>

     <?=$form->field($model, "tipo_producto_id")->dropDownList(
        ArrayHelper::map(TipoProducto::find()->all(),'id','descripcion'),
        ['prompt'=>'Seleccione Tipo de Producto...']); 
    ?> 
    <?=$form->field($model, "marca_id")->dropDownList(
        ArrayHelper::map(Marca::find()->all(),'id','nombre'),
        ['prompt'=>'Seleccione Marca del Producto...']); 
    ?> 

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'costo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
