<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\entity\Exam;
use common\models\entity\MediaType;
use common\models\entity\Participant;
use miloschuman\highcharts\Highcharts;
use yii\widgets\ListView;
use yii\helpers\Url;

/* @var $this yii\web\View */

$institution = Yii::$app->user->identity;
$this->title = 'Product';
// Yii::$app->params['showTitle'] = false;
?>

 <div id="slideshow-mudah" class="carousel slide" data-ride="carousel" style="margin-top: 100px">
  <!-- Indicators, Ini adalah Tombol BULET BULET dibawah. item ini dapat dihapus jika tidak diperlukan -->
  <ol class="carousel-indicators">
    <li data-target="#slideshow-mudah" data-slide-to="0" class="active"></li>
    <li data-target="#slideshow-mudah" data-slide-to="1"></li>
    <li data-target="#slideshow-mudah" data-slide-to="2"></li>
  </ol>
 
  <!-- Wrapper for slides, Ini adalah Tempat Gambar-->
  <div class="carousel-inner">
    <?php
    $i = 0;
    foreach ($slider as $key) { 
      if($i == 0)
        $active = 'active';
      else
        $active = '';
      ?>
  
    <div class="item <?=$active?>">
      <?= Html::img(['slider', 'id' => $key->id, 'field' => 'foto'] //$model->mainImage
                , [
                // 'class' => 'img-responsive',
                  'alt'=>"slideshow-mudah"
            ]) ?>
     <!—Gambar -->
    </div>

<?php
$i++; 
} ?>
  
 
  <!-- Controls, Ini adalah Panah Kanan dan Kiri. item ini dapat dihapus jika tidak diperlukan-->
  <a class="left carousel-control" href="#slideshow-mudah" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#slideshow-mudah" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div>

<div class="row" style="margin-top: 40px" >

    <div class="col-lg-3 col-md-3 col-sm-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Html::label('Categories') ?>
            </div>

            <div class="panel-body">
                <?= $this->render('_nav') ?>
            </div>
        </div>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-12">
        <h1><?= Html::encode($this->title) ?></h1>

        <div class="well">
            <?= Html::label('Order by:') ?>
            <?= $dataProvider->sort->link('name', [
                'class' => 'btn btn-primary btn-sm'
            ]) ?>
            <?= $dataProvider->sort->link('category_id', [
                'class' => 'btn btn-primary btn-sm'
            ]) ?>
            <?= $dataProvider->sort->link('price', [
                'class' => 'btn btn-primary btn-sm'
            ]) ?>
        </div>

        <?php
        echo ListView::widget([
            'layout' => "{summary}\n<div class=\"row\">{items}</div>\n{pager}",
            'dataProvider' => $dataProvider,
            'itemView' => '_product',
            'viewParams' => ['class' => 'col-sm-4 col-lg-4 col-md-4 col-xs-6'],
            'summaryOptions' => [
                'class' => 'alert alert-info'
            ],
        ]) 
        ?>
    </div>
</div>