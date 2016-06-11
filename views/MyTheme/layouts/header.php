<?php
use yii\helpers\Html;
use app\models\User;
use app\models\BuzonDocumento;
use app\models\DocumentoFlujo;
use app\models\Documento;
use app\models\ProcesoFlujo;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <?php if (!Yii::$app->user->isGuest) : ?>
                <!-- Messages: style can be found in dropdown.less-->
                 <?php
                        $userID = Yii::$app->user->id;
                        
                ?>
                
            <?php endif; ?>
             
            
                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                        <?php if (!Yii::$app->user->isGuest) : ?>
                            <span class="hidden-xs">                        
                                <?= Yii::$app->user->identity->username;?>
                            </span>
                        <?php endif;?>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle"
                                 alt="User Image"/>

                            <p>
                                <?php if (!Yii::$app->user->isGuest) : ?>
                                <?= Yii::$app->user->identity->username;?>
                                <small> 
                                Miembro desde:    
                                <?php 
                                     setlocale(LC_ALL,"es_ES");
                                     $user=@Yii::$app->user->identity->username;
                                     $existe = User::find()->where(['username' => $user])->one();
                                     echo strftime("%d de %B del %Y",$existe->created_at);     
                                ?>
                                </small>
                            <?php endif;?>
                            </p>
                        </li>
                        
                        
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Perfil</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Cerrar Sesión',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>


                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <!-- <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li> -->
            </ul>
        </div>
    </nav>
</header>
