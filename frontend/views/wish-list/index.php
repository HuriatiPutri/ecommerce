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
$this->title = 'Wishlist';
// Yii::$app->params['showTitle'] = false;
?>


<div class="row" style="margin-top: 40px" >

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
    <div class="col-lg-9 col-md-9 col-sm-12">
        <h1><?= Html::encode($this->title) ?></h1>


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