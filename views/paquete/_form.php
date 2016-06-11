<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use app\models\Producto;
use yii\helpers\ArrayHelper;
?>

<div class="paquete-form">

    <?php $form = ActiveForm::begin(['id' => 'formulario']); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($modelPaquete, 'nombre')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($modelPaquete, 'descripcion')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-folder-close"></i> Productos</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsProducto[0],
                'formId' => 'formulario',
                'formFields' => [
                    'producto_id',
                    'cantidad_productos',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsProducto as $i => $modelProducto): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Producto</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelProducto->isNewRecord) {
                                echo Html::activeHiddenInput($modelProducto, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-8">
                             <?=$form->field($modelProducto, "[{$i}]producto_id")->dropDownList(
							        ArrayHelper::map($productos,'id','producto'),
							        ['prompt'=>'Seleccione Producto...']); 
							 ?> 
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelProducto, "[{$i}]cantidad_productos")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div><!-- .row -->
                        
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($modelProducto->isNewRecord ? 'Crear' : 'Actualizar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>












