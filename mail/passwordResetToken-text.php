<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/passwordreset', 'token' => $user->password_reset_token]);
?>
Hola <?= $user->username ?>,

Para Actualizar su contraseña dale click al siguiente link:

<?= $resetLink ?>
