<?php

namespace app\controllers;

use Yii;
use app\models\Inventario;
use app\models\InventarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\query;

/**
 * InventarioController implements the CRUD actions for Inventario model.
 */
class InventarioController extends Controller
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
     * Lists all Inventario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InventarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Inventario model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Inventario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Inventario();
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'productos' => $productos,
            ]);
        }
    }

    /**
     * Updates an existing Inventario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'productos' => $productos,
            ]);
        }
    }

    /**
     * Deletes an existing Inventario model.
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
     * Finds the Inventario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Inventario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Inventario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
