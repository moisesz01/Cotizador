<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Hola <?= Html::encode($user->username) ?>,</p>

    <p>Dale click al siguiente link para actualizar tu contraseña:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>

    <p>-----Sigedoc-----</p>
    <p>No responda a este correo.</p>
</div>
