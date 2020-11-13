<?php

namespace backend\controllers;

use Yii;
use common\models\entity\Slider;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\IntegrityException;
use yii\web\UploadedFile;

/**
 * SliderController implements the CRUD actions for Slider model.
 */
class SliderController extends Controller
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
     * Lists all Slider models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Slider::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Slider model.
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
     * Creates a new Slider model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Slider();

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

              
                return $this->redirect(['view', 'id' => $model->id]);
            }


        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

 public function actionDownload($id, $field)
    {
       $model = Slider::findOne($id);
        if (!$model->downloadFile($field)) throw new NotFoundHttpException('The requested file does not exist.');
    }
    /**
     * Updates an existing Slider model.
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
          
            if ($model->save()) {
                foreach ($model->uploadableFields() as $field) {
                        $uploadedFile = UploadedFile::getInstance($model, $field);
                    if ($uploadedFile) {
                        $model->saveFile($uploadedFile, $field);
                    }
                }

              
                return $this->redirect(['view', 'id' => $model->id]);
            }


        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Slider model.
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

    /**
     * Finds the Slider model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Slider the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Slider::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
