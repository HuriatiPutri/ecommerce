<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\entity\Exam;
use common\models\entity\MediaType;
use common\models\entity\Participant;
use common\models\entity\InfoDetail;
use miloschuman\highcharts\Highcharts;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */

$institution = Yii::$app->user->identity;
$this->title = $model->name;
// Yii::$app->params['showTitle'] = false;
?>
<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

<div class="row" style="margin-top: 70px">

  <div class="col-lg-3 col-md-3 col-sm-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <?= Html::label('Categories') ?>
      </div>

      <div class="panel-body">
        <?= $this->render('/site/_nav') ?>
      </div>
    </div>
  </div>
  <h1><?= Html::encode($this->title) ?></h1>

  <div class="col-md-5">

    <div class="well">
      <div class="row">
        <div class="col-md-12">

          <div id="slideshow-mudah" class="carousel slide " data-ride="carousel">
            <!-- Indicators, Ini adalah Tombol BULET BULET dibawah. item ini dapat dihapus jika tidak diperlukan -->
            <ol class="carousel-indicators">
              <li data-target="#slideshow-mudah" data-slide-to="0" class="active"></li>
              <li data-target="#slideshow-mudah" data-slide-to="1"></li>
              <li data-target="#slideshow-mudah" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides, Ini adalah Tempat Gambar-->
            <div class="carousel-inner">
              <div class="item active">
                <?= Html::img(
                  ['download', 'id' => $model->id, 'field' => 'mainImage'] //$model->mainImage
                  ,
                  [
                    'class' => 'img-responsive',
                  ]
                ) ?>
              </div>
              <?php
              foreach ($foto as $key) {
              ?>
                <div class="item">
                  <?= Html::img(
                    ['download-detail', 'id' => $key->id, 'field' => 'foto'] //$model->mainImage
                    ,
                    [
                      'class' => 'img-responsive',
                    ]
                  ) ?>
                </div>
              <?php
              } ?>
            </div>
          </div>
          <!-- Controls, Ini adalah Panah Kanan dan Kiri. item ini dapat dihapus jika tidak diperlukan-->
          <a class="left carousel-control" href="#slideshow-mudah" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
          </a>
          <a class="right carousel-control" href="#slideshow-mudah" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
        </div>
      </div>
    </div>

  </div>
  <div class="col-md-4">
    <hr>
    <h4>Info detail produk</h4>
    <b class="text-danger pull-right"><?= $model->stock == 0 ? "Habis" : "" ?></b>
    <br>
    <h4 class="pull-right">Rp. <?= number_format($model->price) ?></h4>
    <br>

    Category : <?= $model->category->category ?><br>
    Stock : <?= $model->stock?><br>
    Deskripsi : <?= $model->desc ?><br>
    <hr>
    Ukuran :
    <?php
    foreach ($info as $key) {
      if ($key->group == 1)
        echo $key->name . ',';
    }
    ?>
    <br>
    Warna :
    <?php
    foreach ($info as $key) {
      if ($key->group == 2)
        echo $key->name . ',';
    }
    ?>
    <hr>
    <?php if ($model->stock > 0) { ?>
      <?= $form->field($model2, 'qty')->textInput(['autofocus' => true,]) ?>

      <?= $form->field($model2, 'ukuran')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(InfoDetail::find()->where(['product_id' => $model->id, 'group' => '1'])->all(), 'name', 'name'),
        'options' => ['placeholder' => ''],
        'pluginOptions' => ['allowClear' => true],
      ]); ?>

      <?= $form->field($model2, 'warna')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(InfoDetail::find()->where(['product_id' => $model->id, 'group' => '2'])->all(), 'name', 'name'),
        'options' => ['placeholder' => ''],
        'pluginOptions' => ['allowClear' => true],
      ]); ?>
      <?= Html::submitButton('Add to cart', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    <?php } ?>
  </div>
</div>
<?php ActiveForm::end(); ?>