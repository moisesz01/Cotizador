<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\password\PasswordInput;
$this->title = 'Actualizar Contraseña';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password">
    <p>Por favor introduzca la nueva contraseña:</p>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?> 
                <?= $form->field($model, 'password')->widget(PasswordInput::classname(), [
                'options'=> ['placeholder' => 'Nueva contraseña de la cuenta'],
                'pluginOptions' => [
                    'showMeter' => true,
                    'toggleMask' => false,
                    'verdictTitles' => [0 => 'Sin Asignar',1 => 'Muy Debil',2 => 'Debil',3 => 'Aceptable',4 => 'Buena',5 => 'Excelente'],
                ]
            ]); ?>
                <div class="form-group">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
