<?php

namespace frontend\controllers;

use Yii;
use common\models\entity\pesan;
use common\models\entity\product;
use common\models\entity\DetailPesan;
use common\models\search\PesanSearch;
use common\models\entity\DetailFoto; 
use common\models\entity\InfoDetail; 
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\IntegrityException;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

/**
 * CartController implements the CRUD actions for pesan model.
 */
class CartController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            // 'verbs' => [
            //     'class' => VerbFilter::className(),
            //     'actions' => [
            //         'delete' => ['POST'],
            //     ],
            // ],
        ];
    }

    /**
     * Lists all pesan models.
     * @return mixed
     */
    public function actionIndex()
    {
         if (Yii::$app->user->isGuest) {
             return $this->redirect(['/site/login']);
        }
        
        $searchModel = new PesanSearch();
        $cart  = Pesan::find()->where(['status'=>0, 'user_id'=>Yii::$app->user->identity->id])->one();

        if($cart != null)
            $id_pesan = $cart->id;
        else
            $id_pesan = 0;

        $dataProvider = DetailPesan::find()->joinWith('product')->where(['pesan_id'=> $id_pesan])->all();

        return $this->render('index', [
            'id_pesan' =>  $id_pesan,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single pesan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $searchModel = new PesanSearch();
        $cart  = Pesan::find()->where(['status'=>0, 'user_id'=>Yii::$app->user->identity->id])->one();
        $dataProvider = DetailPesan::find()->joinWith('product')->where(['pesan_id'=>$cart->id])->all();

        $totBelanja = DetailPesan::find()->select('sum(pesan_total) as pesan_total')->where(['pesan_id'=>$cart->id])->one();

        $pesan = Pesan::findOne($id);

        if ($pesan->load(Yii::$app->request->post())) {
            $pesan->paid = $totBelanja->pesan_total;
            $pesan->status = 2;
            $pesan->total = $pesan->paid+$pesan->ongkir;
            if($pesan->save())
                $this->redirect(['selesai','id'=>$pesan->id]);
            else  $this->redirect('index');
        }else{
            return $this->render('view', [
                'pesan' =>$pesan,
                'id_pesan' => $cart->id,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }
   public function actionDownload($id, $field)
    {
       $model = Product::findOne($id);
        if (!$model->downloadFile($field)) throw new NotFoundHttpException('The requested file does not exist.');
    }
    public function actionSelesai($id){
        $model = Pesan::findOne($id);
        $dataProvider = DetailPesan::find()->joinWith('product')->where(['pesan_id'=>$id])->all();

        return $this->render('selesai',['model'=>$model,
                'dataProvider' => $dataProvider]);
    }
    /**
     * Creates a new pesan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        if (Yii::$app->user->isGuest) {
             return $this->redirect(['/site/login']);
        }
        $model = new Pesan();
        $detailPesanan = new DetailPesan();
        $product = Product::findOne($id);

        $cart  = Pesan::find()->where(['status'=>0, 'user_id'=>Yii::$app->user->identity->id])->one();

        if ($detailPesanan->load(Yii::$app->request->post())) {
            if($cart == null){
            $model->user_id = Yii::$app->user->identity->id;
            $model->paid = 0;
            $model->date = date('Y-m-d');
            $model->status = 0;
             if($model->save()){
                     $detailPesanan->pesan_id = $model->id;
                     $detailPesanan->product_id = $id;
                     $detailPesanan->pesan_total = $detailPesanan->qty * $product->price;
                     if($detailPesanan->save())
                     return $this->redirect(['/cart']);
                }
            }else{
                     $detailPesanan->pesan_id = $cart->id;
                     $detailPesanan->product_id = $id;
                     $detailPesanan->pesan_total = $detailPesanan->qty * $product->price;
                     if($detailPesanan->save())
                     return $this->redirect(['/cart']);
                     else
                    Yii::$app->session->addFlash('error', \yii\helpers\Json::encode($detailPesanan->errors));
             
            }
            // $this->redirect('cart');
        }else{
             $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),            
            ]);
            $foto = DetailFoto::find()->where(['product_id'=>$id])->all();

             $info = InfoDetail::find()->where(['product_id'=>$id])->all();
               
             return $this->render('_view', [
                'model' => Product::findOne($id),
                'model2' => $detailPesanan,
                 'foto' => $foto,
                'info' => $info,
                'dataProvider' => $dataProvider,
            ]);
        }
    }
    public function actionUpdateQty($id,$set){
        $detail = DetailPesan::find()->joinWith('product')->where(['detail_pesan.id'=>$id])->one();
        $product = Product::findOne($detail->product_id);
        if($set == 'kurang'){
            if($detail->qty >1){
            $detail->qty = $detail->qty - 1;
            $detail->pesan_total = $detail->product->price * $detail->qty;
            $detail->save();
            $product->stock = $product->stock+1;
            $product->save();
            }else{
                $detail->delete();
            }
        }else{
             $detail->qty = $detail->qty + 1;
             $detail->pesan_total = $detail->product->price * $detail->qty;
             $detail->save();

            $product->stock = $product->stock - 1;
            $product->save();
        }
        return $this->redirect(['/cart']);
    }

      public function actionInfoPembayaran($id){
     
        return $this->redirect(['/info-pembayaran']);
    }

    /**
     * Updates an existing pesan model.
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
    public function actionUploadBukti($id)
    {
        $model = Pesan::findOne($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->status = 3;
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


                return $this->redirect(Url::toRoute('/profile'));
            }
        } else {
            return $this->render('_formbukti', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Deletes an existing pesan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
           DetailPesan::findOne($id)->delete();
            return $this->redirect(['index']);
        } catch (IntegrityException $e) {
            throw new \yii\web\HttpException(500,"Integrity Constraint Violation. This data can not be deleted due to the relation.", 405);
        }
    }

    /**
     * Finds the pesan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return pesan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = pesan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionProvinsi(){
        $curl = curl_init(); 
        curl_setopt_array($curl, array(
        CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          "key: 7b5b229fc8fdafec21d94e9fda937643"
        ),
      ));
          $response = curl_exec($curl);
          $err = curl_error($curl);
          curl_close($curl);
          $data = json_decode($response, true);
          for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
              echo "<option></option>";
              echo "<option value='".$data['rajaongkir']['results'][$i]['province_id']."'>".$data['rajaongkir']['results'][$i]['province']."</option>";
          }
    }
    public function actionCity(){
        $curl = curl_init(); 
        curl_setopt_array($curl, array(
        CURLOPT_URL => "http://api.rajaongkir.com/starter/city/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          "key: 7b5b229fc8fdafec21d94e9fda937643"
        ),
      ));
          $response = curl_exec($curl);
          $err = curl_error($curl);
          curl_close($curl);
          $data = json_decode($response, true);
          for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
              echo "<option></option>";
              echo "<option value='".$data['rajaongkir']['results'][$i]['city_id']."'>".$data['rajaongkir']['results'][$i]['city_name']."</option>";
          }
    }
    public function actionCost($kotaasal, $kotatujuan,$berat, $kurir){
        error_reporting(0);
         // $kota_asal = $_POST['kota_asal'];
         // $kota_tujuan = $_POST['kota_tujuan'];
         // $kurir = $_POST['kurir'];
         $berat2 = $berat*1000;

         $curl = curl_init();
         curl_setopt_array($curl, array(
           CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
           CURLOPT_RETURNTRANSFER => true,
           CURLOPT_ENCODING => "",
           CURLOPT_MAXREDIRS => 10,
           CURLOPT_TIMEOUT => 30,
           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
           CURLOPT_CUSTOMREQUEST => "POST",
           CURLOPT_POSTFIELDS => "origin=".$kotaasal."&destination=".$kotatujuan."&weight=".$berat2."&courier=".$kurir."",
           CURLOPT_HTTPHEADER => array(
             "content-type: application/x-www-form-urlencoded",
             "key: 7b5b229fc8fdafec21d94e9fda937643"
           ),
         ));
         $response = curl_exec($curl);
         $err = curl_error($curl);
         curl_close($curl);
         $data= json_decode($response, true);
         $kurir=$data['rajaongkir']['results'][0]['name'];
         $harga=$data['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'];
         $kotaasal=$data['rajaongkir']['origin_details']['city_name'];
         $provinsiasal=$data['rajaongkir']['origin_details']['province'];
         $kotatujuan=$data['rajaongkir']['destination_details']['city_name'];
         $provinsitujuan=$data['rajaongkir']['destination_details']['province'];
         $berat=$data['rajaongkir']['query']['weight']/1000;
         if($harga == null){ $hrg = 0; $pesan ="tidak ada pengiriman";
         }else{ $hrg = $harga; $pesan='';}
            echo json_encode(['pesan'=>$pesan,'harga'=>$harga,'kota_asal'=>$kotaasal,'kotatujuan'=>$kotatujuan,'provinsiasal'=>$provinsiasal,'provinsitujuan'=>$provinsitujuan,'berat'=>$berat,'kurir'=>$kurir]);
    }

}
