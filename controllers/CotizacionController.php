<?php

namespace app\controllers;

use app\models\Cotizacion;
use app\models\CotizacionSearch;
use app\models\DetalleCotizacion;
use app\models\Inventario;
use app\models\Model;
use app\models\Paquete;
use app\models\Producto;
use app\models\ProductoPaquete;
use Yii;
use yii\db\query;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CotizacionController implements the CRUD actions for Cotizacion model.
 */
class CotizacionController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Cotizacion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CotizacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cotizacion model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function getFecha(){

        $tz = 'America/Caracas';
        $timestamp = time();
        $dt = new \DateTime("now", new \DateTimeZone($tz)); 
        $dt->setTimestamp($timestamp);
        
        return $dt->format('Y-m-d');

    }

    /**
     * Creates a new Cotizacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cotizacion();
        $modelsDetalle = [new DetalleCotizacion];
        $mensajes = null;
        $query = new Query;
        $query->select([
            'id AS id',
            'CONCAT("Ruc: ",ruc,"/  Nombres: ",nombres,"/  Apellidos: ",apellidos) As cliente'
        ])
        ->from('cliente');
        $command = $query->createCommand();
        $clientes = $command->queryAll();

        if ($model->load(Yii::$app->request->post())) {

            $model->user_id = Yii::$app->user->id;
            $model->fecha = $this->getFecha();
            $modelsDetalle = Model::createMultiple(DetalleCotizacion::classname());

            Model::loadMultiple($modelsDetalle, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();

            $valid = Model::validateMultiple($modelsDetalle) && $valid;

            if ($valid) {
            
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsDetalle as $modelDetalle) {
                            $modelDetalle->cotizacion_id = $model->id;
                            $paquete = Paquete::find()->where(['id'=>$modelDetalle->paquete_id])->one(); 
                            $modelDetalle->precio = $modelDetalle->cantidad * $paquete->costo;

                            if (! ($flag = $modelDetalle->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                        $mensajes = $this->TotalizarProductos($model->id);
                        if(!empty($mensajes)){
                            
                            $flag=false;
                            Yii::$app->session->setFlash('error','No hay inventario para todo su pedido');
                            return $this->render('create', [
                                'model' => $model,
                                'clientes' => $clientes,
                                'mensajes' => $mensajes,
                                'modelsDetalle' => (empty($modelsDetalle)) ? [new DetalleCotizacion] : $modelsDetalle
                            ]);
                        }
                        


                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'mensajes'=>$mensajes,
                'clientes' => $clientes,
                'modelsDetalle' => (empty($modelsDetalle)) ? [new DetalleCotizacion] : $modelsDetalle
            ]);
        }
    }

    /**
     * Updates an existing Cotizacion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    public function TotalizarProductos($id){
        
        $arrayProductos = array();
        $arrayMensajes = array();
        $arrayInventarioUpdate = array();

        $detalle_cotizaciones = DetalleCotizacion::find()->where(['cotizacion_id'=>$id])->all();
        
        foreach ($detalle_cotizaciones as $detCotizacion) {
            
            $paquetes = Paquete::find()->where(['id'=>$detCotizacion->paquete_id])->all();

            foreach ($paquetes as $paquete) {
            
                $productosPaquetes = ProductoPaquete::find()->where(['paquete_id'=>$paquete->id])->all();

                foreach ($productosPaquetes as $proPaque) {

                    $producto = Producto::find()->where(['id'=>$proPaque->producto_id])->one();        
                    $numProductoNecesario = $detCotizacion->cantidad*$proPaque->cantidad_productos;
                    $arrayProductos[]= array('idProducto'=>$proPaque->producto_id,'cantidad'=>$detCotizacion->cantidad*$proPaque->cantidad_productos);

                }
                
            }
        }
        foreach ($arrayProductos as $producto) {

            $inventarioProductos = Inventario::find()->where(['producto_id'=>$producto['idProducto']])->all();
            foreach ($inventarioProductos as $inventarioProducto) {
                $diff = $inventarioProducto->cantidad - $producto['cantidad'];
                if($diff>-1){

                    $arrayInventarioUpdate[] = Array(
                        'idInventario'=>$inventarioProducto->id,
                        'idProducto'=>$producto['idProducto'],
                        'numProducto'=>$diff,
                    );

                }else{
                    $arrayMensajes[]= array(
                        'idProducto'    => $producto['idProducto'],
                        'existencia'    => $inventarioProducto->cantidad,
                        'requerimiento' => $producto['cantidad'],
                    );
                }
            }
        }
        if(empty($arrayMensajes)){

            foreach ($arrayInventarioUpdate as $inventario) {

                $model = Inventario::find()->where(['id'=>$inventario['idInventario']])->one();
                
                $model->cantidad = $inventario['numProducto'];
                $model->save();
            }

        }
        return $arrayMensajes;

    }


    /**
     * Deletes an existing Cotizacion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cotizacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cotizacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cotizacion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
