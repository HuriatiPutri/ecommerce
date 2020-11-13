<?php

namespace backend\controllers;

use Yii;
use common\models\entity\Product;
use common\models\entity\DetailFoto;
use common\models\entity\InfoDetail;
use common\models\search\DetailFotoSearch;
use common\models\search\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\IntegrityException;
use yii\web\UploadedFile;


/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReport()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('report', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
         $foto = new \yii\data\ActiveDataProvider([
            'query' => DetailFoto::find()->where(['product_id'=>$id])
        ]);

         $info = new \yii\data\ActiveDataProvider([
                    'query' => InfoDetail::find()->where(['product_id'=>$id])
                ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'foto' => $foto,
            'info' => $info
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post())) {
                foreach ($model->uploadableFields() as $field) {
                    unset($model->$field);
                }
          
            if ($model->save()) {
                foreach ($model->uploadableFields() as $field) {
                        $uploadedFile = UploadedFile::getInstance($model, $field);
                    if ($uploadedFile) {
                        $model->saveFile($uploadedFile, $field);
                    }
                }

              
                return $this->redirect(['foto', 'id' => $model->id]);
            }


        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    public function actionFoto($id)
    {
         $model = new DetailFoto();
        if ($model->load(Yii::$app->request->post())) {
                foreach ($model->uploadableFields() as $field) {
                    unset($model->$field);
                }
                $model->product_id = $id;
            if ($model->save()) {
                foreach ($model->uploadableFields() as $field) {
                        $uploadedFile = UploadedFile::getInstance($model, $field);
                    if ($uploadedFile) {
                        $model->saveFile($uploadedFile, $field);
                    }
                }

              
                return $this->redirect(['foto', 'id' => $id]);
            }
        }

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => DetailFoto::find()->where(['product_id'=>$id])
        ]);

        return $this->render('_foto', [
            'id'=>$id,
            'model' =>$model,
            'dataProvider' => $dataProvider,
        ]);

    }
     public function actionInfoDetail($id)
    {
        $model = new InfoDetail();

        if ($model->load(Yii::$app->request->post())) {
            $model->product_id = $id;
            if($model->save())
            return $this->redirect(['info-detail', 'id' => $id]);
        } 
            $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => InfoDetail::find()->where(['product_id'=>$id])->orderBy('group')
        ]);

        return $this->render('_info', [
            'id'=>$id,
            'model' =>$model,
            'dataProvider' => $dataProvider,
        ]);

    }


    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

                foreach ($model->uploadableFields() as $field) {
                    unset($model->$field);
                }
                if($model->save()){
                    foreach ($model->uploadableFields() as $field) {
                        $uploadedFile = UploadedFile::getInstance($model, $field);
                    if ($uploadedFile) {
                        $model->saveFile($uploadedFile, $field);
                    }
                    }
                return $this->redirect(['foto', 'id' => $model->id]);
                }else{
                    Yii::$app->session->addFlash('error', 'error');
                     return $this->render('create', [
                     'model' => $model,
            ]);
                }

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        } catch (IntegrityException $e) {
            throw new \yii\web\HttpException(500,"Integrity Constraint Violation. This data can not be deleted due to the relation.", 405);
        }
    }
    public function actionDeleteDetail($id)
    {
        $model = DetailFoto::findOne($id);
        try {
            $model->delete();
            return $this->redirect(['foto', 'id'=>$model->product_id]);
        } catch (IntegrityException $e) {
            throw new \yii\web\HttpException(500,"Integrity Constraint Violation. This data can not be deleted due to the relation.", 405);
        }
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
     public function actionDownload($id, $field)
    {
       $model = $this->findModel($id);
        if (!$model->downloadFile($field)) throw new NotFoundHttpException('The requested file does not exist.');
    }
    public function actionDownloadDetail($id, $field)
    {
       $model = DetailFoto::findOne($id);
        if (!$model->downloadFile($field)) throw new NotFoundHttpException('The requested file does not exist.');
    }
}
