<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <?php if (!Yii::$app->user->isGuest) : ?>
                <p><?= Yii::$app->user->identity->username;?></p>
                <?php endif; ?>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Menu Condominio', 'options' => ['class' => 'header']],
                    [
                        'label' => 'Usuarios',
                        'icon' => 'fa fa-dot-circle-o',
                        'url' => '#',
                        'visible' => (Yii::$app->user->can('Permisos de Administrador')),
                        'items' => [
                            ['label' => 'Administrar Permisologia', 'icon' => 'fa fa-key', 'url' => ['/admin']],
                            ['label' => 'Crear Usuario', 'icon' => 'fa fa-user-plus', 'url' => ['/user/register']],
                           
                        ],
                    ],
                    [
                        'label' => 'Clientes',
                        'icon' => 'fa fa-dot-circle-o',
                        'url' => '#',
                        'visible' => (Yii::$app->user->can('Permisos de Administrador')),
                        'items' => [
                            ['label' => 'Administrar Clientes', 'icon' => 'fa fa-key', 'url' => ['/cliente/index']],
                            ['label' => 'Crear Clientes', 'icon' => 'fa fa-user-plus', 'url' => ['/cliente/create']],
                           
                        ],
                    ],
                    [
                        'label' => 'Impuesto',
                        'icon' => 'fa fa-dot-circle-o',
                        'url' => '#',
                        'visible' => (Yii::$app->user->can('Permisos de Administrador')),
                        'items' => [
                            ['label' => 'Administrar Impuesto', 'icon' => 'fa fa-key', 'url' => ['/impuesto/index']],
                            ['label' => 'Crear Impuesto', 'icon' => 'fa fa-user-plus', 'url' => ['/impuesto/create']],
                           
                        ],
                    ],
                    [
                        'label' => 'Marcas',
                        'icon' => 'fa fa-dot-circle-o',
                        'url' => '#',
                        'visible' => (Yii::$app->user->can('Permisos de Administrador')),
                        'items' => [
                            ['label' => 'Administrar Marcas', 'icon' => 'fa fa-key', 'url' => ['/marca/index']],
                            ['label' => 'Crear Marca', 'icon' => 'fa fa-user-plus', 'url' => ['/marca/create']],
                           
                        ],
                    ],
                    [
                        'label' => 'Tipo de Producto',
                        'icon' => 'fa fa-dot-circle-o',
                        'url' => '#',
                        'visible' => (Yii::$app->user->can('Permisos de Administrador')),
                        'items' => [
                            ['label' => 'Adm. Tipo de Producto', 'icon' => 'fa fa-key', 'url' => ['/tipo-producto/index']],
                            ['label' => 'Crear Tipo de Producto', 'icon' => 'fa fa-user-plus', 'url' => ['/tipo-producto/create']],
                           
                        ],
                    ],
                    [
                        'label' => 'Producto',
                        'icon' => 'fa fa-dot-circle-o',
                        'url' => '#',
                        'visible' => (Yii::$app->user->can('Permisos de Operador')),
                        'items' => [
                            ['label' => 'Administrar Producto', 'icon' => 'fa fa-key', 'url' => ['/producto/index']],
                            ['label' => 'Crear Producto', 'icon' => 'fa fa-user-plus', 'url' => ['/producto/create']],
                           
                        ],
                    ],
                    [
                        'label' => 'Inventario',
                        'icon' => 'fa fa-dot-circle-o',
                        'url' => '#',
                        'visible' => (Yii::$app->user->can('Permisos de Operador')),
                        'items' => [
                            ['label' => 'Administrar inventario', 'icon' => 'fa fa-key', 'url' => ['/inventario/index']],
                            ['label' => 'Crear inventario', 'icon' => 'fa fa-user-plus', 'url' => ['/inventario/create']],
                           
                        ],
                    ],
                    [
                        'label' => 'Paquete',
                        'icon' => 'fa fa-dot-circle-o',
                        'url' => '#',
                        'visible' => (Yii::$app->user->can('Permisos de Operador')),
                        'items' => [
                            ['label' => 'Administrar paquete', 'icon' => 'fa fa-key', 'url' => ['/paquete/index']],
                            ['label' => 'Crear paquete', 'icon' => 'fa fa-user-plus', 'url' => ['/paquete/create']],
                           
                        ],
                    ],
                    [
                        'label' => 'Cotizador',
                        'icon' => 'fa fa-dot-circle-o',
                        'url' => '#',
                        'visible' => (Yii::$app->user->can('Permisos de Operador')),
                        'items' => [
                            ['label' => 'Administrar Cotizaciones', 'icon' => 'fa fa-key', 'url' => ['/cotizacion/index']],
                            ['label' => 'Crear Cotización', 'icon' => 'fa fa-user-plus', 'url' => ['/cotizacion/create']],
                           
                        ],
                    ],
                    
                    
                ],
            ]
        ) ?>

    </section>

</aside>
