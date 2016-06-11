<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Recuperar Contraseña';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-request-password-reset">
    <p>Por favor introduzca su correo electrónico afiliado. Le será enviado un link para reiniciar su contraseña .</p>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                <?= $form->field($model, 'email') ?>
                <div class="form-group">
                    <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
