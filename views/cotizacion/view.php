<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\DetalleCotizacion;
use app\models\Paquete;
use app\models\Impuesto;
use app\models\ProductoPaquete;
use app\models\Producto;
use app\models\TipoProducto;
use app\models\Marca;


/* @var $this yii\web\View */
/* @var $model app\models\Cotizacion */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Cotizacions', 'url' => ['index']];
$this->params['breadcrumbs'][] =$model->id;
?>
<div class="cotizacion-view">

    <h1><?= Html::encode('Cotización Número: '.$model->id) ?></h1>

    <p>
        <?php /*echo Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) */?>
        <?php /*echo Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro que desea eliminar este item?',
                'method' => 'post',
            ],
        ])*/ ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            [
                'label' => 'Cotización Número',
                'value' => $model->id,
            ],

            [
                'label' => 'Ruc del Cliente',
                'value' => $model::getRucCliente($model->cliente_id),
            ],

            [
                'label' => 'Cliente',
                'value' => $model::getNombresCliente($model->cliente_id),
            ],

            [
                'label' => 'Vendedor(a)',
                'value' => $model::getVendedor($model->user_id),
            ],
            
            'fecha',
        ],
    ]) ?>

    <div class="detalles_cotizacion">
    <h2>Detalle de Cotización</h2>
    <?php 

        $detalle_cotizaciones = DetalleCotizacion::find()->where(['cotizacion_id'=>$model->id])->all();
        $subtotalPaquete=0;
        $subtotalCompleto=0;
        foreach ($detalle_cotizaciones as $detCotizacion) {
            

            $paquetes = Paquete::find()->where(['id'=>$detCotizacion->paquete_id])->all();

            foreach ($paquetes as $paquete): ?> 
                <fieldset>
                <legend>ID Paquete: <?=$paquete->id; ?> </legend>
                <strong>Paquete: </strong> <?= $paquete->nombre?><br>
                <strong>Cantidad de Paquetes: </strong><?=$detCotizacion->cantidad?> paquete(s)<br><br>
                <?php $productosPaquetes = ProductoPaquete::find()->where(['paquete_id'=>$paquete->id])->all(); ?>
               <table class="table table-striped table-bordered" style="text-align:center;">
                <tr>
                  <td><strong>Cantidad de productos</strong></td>
                  <td><strong>Tipo de Producto</strong></td>
                  <td><strong>Marca del producto</strong></td>
                  <td><strong>Producto</strong></td>
                  <td><strong>Descripción</strong></td>
                  <td><strong>Costo</strong></td>
                </tr>
                <?php foreach ($productosPaquetes as $proPaque): ?>
                    <?php $producto = Producto::find()->where(['id'=>$proPaque->producto_id])->one();?>
                    <?php $tipoproducto = TipoProducto::find()->where(['id'=>$producto->tipo_producto_id])->one(); ?>
                    <?php $marcaproducto = Marca::find()->where(['id'=>$producto->marca_id])->one(); ?>
                    <tr>
                        <td>
                        <?php
                            $nproductos = $proPaque->cantidad_productos*$detCotizacion->cantidad;
                            echo $nproductos;
                        ?> 
                        </td>
                        <td><?= $tipoproducto->descripcion; ?></td>
                        <td><?= $marcaproducto->nombre; ?></td>
                        <td><?= $producto->nombre; ?></td>
                        <td><?= $producto->descripcion; ?></td>
                        <td>
                        <?php 
                            $costo = $nproductos*$producto->costo;  
                            echo $costo;
                        ?>
                        </td>
                      
                    </tr>
                    <?php $subtotalPaquete = $subtotalPaquete + $costo; ?>
                <?php endforeach; ?>
                <?php
                    $subtotalCompleto = $subtotalCompleto + $subtotalPaquete;

                ?>

                </table>
                    <div>
                        <div style="display:none;float:left;">.</div>
                        <div style="float:right; padding-right:15px;">
                            <p><strong>Subtotal de Paquete:</strong> <?=$subtotalPaquete."<br><br>";?></p>    
                        </div>    

                    </div>
                    

                </fieldset>
            <?php endforeach; ?>
            
        <?php
        }

    ?>    
    <div style="margin-top:30px;padding-bottom: 140px;">
        <div style="display:none;float:left;">.</div>
        <div style="float:right; padding-right:15px;text-align: right;">
            <p><strong>Subtotal:</strong> <?=$subtotalCompleto;"<br><br>";?></p>
            <?php 
                $impuesto = Impuesto::find()->where(['id'=>1])->one();
                $impuesto = $subtotalCompleto * (($impuesto->valor)/100);
            ?>    
            <p><strong>Impuesto:</strong> <?=$impuesto;"<br><br>";?></p>
            <?php 
                $descuento = $subtotalCompleto * (($model->descuento)/100);

            ?>
            <p><strong>Descuento:</strong> <?=$descuento;"<br><br>";?></p>    
            <p><strong>Total:</strong> <?=$subtotalCompleto+$impuesto-$descuento;"<br><br>";?></p>    
        </div>    

    </div>      
    </div>

</div>
