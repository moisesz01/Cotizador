<?php

namespace app\controllers;

use Yii;
use app\models\Paquete;
use app\models\Model;
use app\models\Producto;
use app\models\ProductoPaquete;
use app\models\PaqueteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;

/**
 * PaqueteController implements the CRUD actions for Paquete model.
 */
class PaqueteController extends Controller
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
     * Lists all Paquete models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaqueteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Paquete model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $query = new Query;
        $query->select([
            'producto.id AS id',
            'CONCAT(tipo_producto.descripcion," ",marca.nombre," ", producto.nombre,", ",producto.descripcion) As producto',
            'producto_paquete.cantidad_productos AS cantidad'
        ])
        ->from('producto')
        ->join('JOIN','tipo_producto','tipo_producto.id=producto.tipo_producto_id')
        ->join('JOIN','marca','marca.id=producto.marca_id')
        ->join('JOIN','producto_paquete','producto_paquete.producto_id=producto.id')
        ->join('JOIN','paquete','paquete.id=producto_paquete.paquete_id')
        ->where('paquete.id=:id',[':id'=>$id]);
        $command = $query->createCommand();
        $productos = $command->queryAll();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'productos' => $productos
        ]);
    }

    /**
     * Creates a new Paquete model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelPaquete = new Paquete();
        $modelsProducto = [new ProductoPaquete];
        
        $query = new Query;
        $query->select([
            'producto.id AS id',
            'CONCAT(tipo_producto.descripcion," ",marca.nombre," ", producto.nombre,", ",producto.descripcion) As producto'
        ])
        ->from('producto')
        ->join('JOIN','tipo_producto','tipo_producto.id=producto.tipo_producto_id')
        ->join('JOIN','marca','marca.id=producto.marca_id');
        $command = $query->createCommand();
        $productos = $command->queryAll();

        if ($modelPaquete->load(Yii::$app->request->post())) {

            $modelsProducto = Model::createMultiple(ProductoPaquete::classname());
            Model::loadMultiple($modelsProducto, Yii::$app->request->post());

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsProducto),
                    ActiveForm::validate($modelPaquete)
                );
            }

            // validate all models
            $valid = $modelPaquete->validate();
            $valid = Model::validateMultiple($modelsProducto) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelPaquete->save(false)) {
                        $cantidad = 0;
                        foreach ($modelsProducto as $modelProducto) {

                            $modelProducto->paquete_id = $modelPaquete->id; 
                            $newProduct = Producto::find()->where(['id'=>$modelProducto->producto_id])->one();
                            $cantidad = $cantidad + (($modelProducto->cantidad_productos)*$newProduct->costo);

                            if (! ($flag = $modelProducto->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                        $modelPaquete->costo = $cantidad;
                        $modelPaquete->save();

                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelPaquete->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'modelPaquete' => $modelPaquete,
            'modelsProducto' => (empty($modelsProducto)) ? [new ProductoPaquete] : $modelsProducto,
            'productos'=> $productos,
        ]);
    }

    /**
     * Updates an existing Paquete model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $modelPaquete = $this->findModel($id);
        $modelsProducto = $modelPaquete->productoPaquetes;
        $query = new Query;
        $query->select([
            'producto.id AS id',
            'CONCAT(tipo_producto.descripcion," ",marca.nombre," ", producto.nombre,", ",producto.descripcion) As producto'
        ])
        ->from('producto')
        ->join('JOIN','tipo_producto','tipo_producto.id=producto.tipo_producto_id')
        ->join('JOIN','marca','marca.id=producto.marca_id');
        $command = $query->createCommand();
        $productos = $command->queryAll();

        if ($modelPaquete->load(Yii::$app->request->post())) {

            foreach ($modelsProducto as $value) {
                print_r($value);
                echo "<br><br><br><br><br>";
            }
            die;
            $oldIDs = ArrayHelper::map($modelsProducto, 'id', 'id');
            //print_r($oldIDs);die;
            $modelsProducto = Model::createMultiple(ProductoPaquete::classname(), $modelsProducto);

            
            $valor = Model::loadMultiple($modelsProducto, Yii::$app->request->post());
           /* print_r($valor);
            die;*/
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsProducto, 'id', 'id')));
            print_r($deletedIDs);
            die;
            // validate all models
            $valid = $modelPaquete->validate();
            $valid = Model::validateMultiple($modelsProducto) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelPaquete->save(false)) {
                        if (! empty($deletedIDs)) {
                            ProductoPaquete::deleteAll(['id' => $deletedIDs]);
                        }
                        $cantidad = 0;
                        foreach ($modelsProducto as $modelProducto) {

                            $modelProducto->paquete_id = $modelProducto->id; 

                            $newProduct = Producto::find()->where(['id'=>$modelProducto->producto_id])->one();
                            $cantidad = $cantidad + (($modelProducto->cantidad_productos)*$newProduct->costo);

                            


                            if (! ($flag = $modelProducto->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                        $modelPaquete->costo = $cantidad;
                        $modelPaquete->save();

                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelPaquete->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'modelPaquete' => $modelPaquete,
            'productos' => $productos,
            'modelsProducto' => (empty($modelsProducto)) ? [new ProductoPaquete] : $modelsProducto
        ]);
    }

    /**
     * Deletes an existing Paquete model.
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
     * Finds the Paquete model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Paquete the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Paquete::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
