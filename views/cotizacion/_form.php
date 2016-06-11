<?php
use app\models\Paquete;
use app\models\Producto;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="customer-form">
	<?php
    	if(isset($mensajes)){
    		foreach ($mensajes as $mensaje) {
    			$producto = Producto::find()->where(['id'=>$mensaje['idProducto']])->one();
    			$msg ="Del Producto: ".$producto->nombre." se solicita:".$mensaje['requerimiento']." y se cuenta con: ".$mensaje['existencia'];
 				//$msg ="Del Producto: ".$mensaje['idProducto']." se solicita:".$mensaje['requerimiento']." y se cuenta con: ".$mensaje['existencia'];   			
    			echo Alert::widget([
				'options' => [
				    'class' => 'alert-warning',
				],
				'body' => $msg,
			]);
    		}
    		
    		
    	}

    ?>
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <div class="row">
    	<div class="col-sm-12">
    		<?=$form->field($model, "cliente_id")->dropDownList(
	        ArrayHelper::map($clientes,'id','cliente'),
	        ['prompt'=>'Seleccione Tipo de Producto...']); 
	    ?> 	
    	</div>
         
    </div>
        <div class="row">
    	<div class="col-sm-12">
    		<?= $form->field($model, 'descuento')->textInput(['value'=>0]) ?>	
    	</div>
         
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class=""></i> Paquetes a Cotizar</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsDetalle[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'paquete_id',
                    'cantidad',
                    
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsDetalle as $i => $modelDetalle): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Paquete</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelDetalle->isNewRecord) {
                                echo Html::activeHiddenInput($modelDetalle, "[{$i}]id");
                            }
                        ?>
                      
                        <div class="row">
                            <div class="col-sm-6">
                                <?=$form->field($modelDetalle, "[{$i}]paquete_id")->dropDownList(
							        ArrayHelper::map(Paquete::find()->all(),'id','nombre'),
							        ['prompt'=>'Seleccione Paquete...']); 
							    ?> 
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelDetalle, "[{$i}]cantidad")->textInput(['maxlength' => true]) ?>
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
        <?= Html::submitButton($modelDetalle->isNewRecord ? 'Crear' : 'Actualizar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    

</div>