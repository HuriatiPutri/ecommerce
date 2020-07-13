 <?php public function actionCreate($id, $harga)
    {
        if (Yii::$app->user->isGuest) {
             return $this->redirect(['/site/login']);
        }
        $cart  = Pesan::find()->where(['status'=>0, 'user_id'=>Yii::$app->user->identity->id])->one();
        $cartdetail = DetailPesan::find()->joinWith('product')->where(['pesan_id'=>$cart->id, 'product_id'=>$id])->one();
        $model = new pesan();
        $detailPesanan = new DetailPesan();

        if ($model->load(Yii::$app->request->post())) {
            if($cart == null){
                $model->user_id = Yii::$app->user->identity->id;
                $model->paid = $harga;
                $model->date = date('Y-m-d');
                $model->status = 0;
                if($model->save()){
                     $detailPesanan->pesan_id = $model->id;
                     $detailPesanan->product_id = $id;
                     $detailPesanan->qty = 1;
                     $detailPesanan->pesan_total = $harga;
                     if($detailPesanan->save())
                     return $this->redirect(['/cart']);
                }else{
                   Yii::$app->session->addFlash('error', 'Anda tidak mempunyai hak akses ke sistem ini.');
                }
            }else{
                if($cartdetail == null){
                     $detailPesanan->pesan_id = $cart->id;
                     $detailPesanan->product_id = $id;
                     $detailPesanan->qty = 1;
                     $detailPesanan->pesan_total = $harga;
                      if($detailPesanan->save())
                     return $this->redirect(['/cart']);
             }else{
                     $cartdetail->qty = $cartdetail->qty + 1;
                     $cartdetail->pesan_total =  $cartdetail->product->price * $cartdetail->qty;
                      if($cartdetail->save())
                     return $this->redirect(['/cart']);
             }
            }
        }else{
             $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),            
            ]);
            $foto = DetailFoto::find()->where(['product_id'=>$id])->all();

             $info = InfoDetail::find()->where(['product_id'=>$id])->all();
               
             return $this->render('/site/view', [
                'model' => Product::findOne($id),
                'model2' => $model,
                 'foto' => $foto,
                'info' => $info,
                'dataProvider' => $dataProvider,
            ]);
        }
    }