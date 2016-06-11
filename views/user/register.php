<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\password\PasswordInput;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use kartik\select2\Select2;
use app\models\Flujo;

$this->title = '';
$this->params['breadcrumbs'][] = 'Registro de Usuarios';
$roles = ArrayHelper::map($roles, 'rol', 'rol');

?>
	<div class="cuerpo">
		<div class="container" style="margin-top:20px;">
			
		

			<h1>Registro de Usuarios</h1>
			<h5>Por favor rellene los siguientes campos:</h5>
			<?php $form = ActiveForm::begin(["method" => "post",'enableClientValidation' => true]); ?>
				
					<div class="col-sm-10">
						<?= $form->field($model, 'username', [
							'enableAjaxValidation' => true,
							'inputOptions' => ['placeholder' => 'Nombre de usuario'],
					        'inputTemplate' => '<div class="input-group"><span class="input-group-addon"> <span class="glyphicon glyphicon-user"></span></span>{input}</div>',
					    ]); ?>
					</div>
					<div class="col-sm-10">
						<?= $form->field($model, 'nombre_apellido', [
							'enableAjaxValidation' => true,
							'inputOptions' => ['placeholder' => 'Ingrese su nombre y apelido'],
					        'inputTemplate' => '<div class="input-group"><span class="input-group-addon"> <span class="glyphicon glyphicon-user"></span></span>{input}</div>',
					    ]); ?>
					</div>
					
					<div class="col-sm-10">
						<?= $form->field($model, 'email', [
							'enableAjaxValidation' => true,
							'inputOptions' => ['placeholder' => 'Dirección de correo electrónico'],
					        'inputTemplate' => '<div class="input-group"><span class="input-group-addon"> <span class="glyphicon glyphicon-envelope"></span></span>{input}</div>',
					    ]); ?>
					</div>	

					<div class="col-sm-10">
					<?= $form->field($model, 'password')->widget(PasswordInput::classname(), [
						'options'=> ['placeholder' => 'Contraseña de la cuenta'],

					    'pluginOptions' => [
					        'showMeter' => true,
					        'toggleMask' => false,
					        'verdictTitles' => [
					            0 => 'Sin Asignar',
					            1 => 'Muy Debil',
					            2 => 'Debil',
					            3 => 'Aceptable', 
					            4 => 'Buena',
					            5 => 'Excelente'
					        ],
					        'inputTemplate' => '<div class="input-group"><span class="input-group-addon"> <span class="glyphicon glyphicon-envelope"></span></span>{input}</div>',
					    ]
					])->label('Contraseña'); ?>
					</div>
					<div class="col-sm-10">
					<?= $form->field($model, 'password_repeat')->widget(PasswordInput::classname(), [
						'options'=> ['placeholder' => 'Contraseña de la cuenta'],

					    'pluginOptions' => [
					        'showMeter' => true,
					        'toggleMask' => false,
					        'verdictTitles' => [
					            0 => 'Sin Asignar',
					            1 => 'Muy Debil',
					            2 => 'Debil',
					            3 => 'Aceptable', 
					            4 => 'Buena',
					            5 => 'Excelente'
					        ],
					        'inputTemplate' => '<div class="input-group"><span class="input-group-addon"> <span class="glyphicon glyphicon-envelope"></span></span>{input}</div>',
					    ]
					])->label('Repetir Contraseña'); ?>
					</div>
					<div class="col-sm-10">
						<?= $form->field($model, 'rol')->widget(Select2::classname(), [
			                'data' => $roles,
			                'language' => 'es',
			                'options' => ['placeholder' => 'Seleccione Rol',
			                	'inputTemplate' => '<div class="input-group"><span class="input-group-addon"> <span class="glyphicon glyphicon-envelope"></span></span>{input}</div>',

			                ],

			                'pluginOptions' => [
			                    'allowClear' => true,

			                ],
			            ]);?> 
					</div>
					<div class="col-sm-10">
						<div class="form-group">
							<?= Html::submitButton("Crear Usuario", ['class' => 'btn btn-success', 'style'=>'border:none;']) ?>
						</div>
					</div>
				
			
			
			<?php $form->end() ?>
	
		</div>
	</div>

