<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use kartik\widgets\Select2;
use kartik\widgets\DatePicker;
use common\models\entity\User;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\PesanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pesan';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row" style="margin-top: 70px" >

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

        <div class="well">
            <div class="panel panel-default">
            <div class="panel-heading">
                <b>Profile Pengguna</b>
            </div>
            <div class="panel-body">
                 <div class="col-md-12" style="padding: 16px">
                    <img src="<?= Url::base().'/img/user.jpg' ?>" width='75' class="img-circle" alt="User Image"/>
                </div>
                <div class="col-md-5">Nama Pengguna</div>
                <div class="col-md-7">: <?=Yii::$app->user->identity->name?></div>  
                <div class="col-md-5">Email</div>
                <div class="col-md-7">: <?=Yii::$app->user->identity->email?></div>   
            </div>
            </div>
            <div class="panel-footer">
                <?=Html::a('Ganti Password', Url::toRoute('site/change-password'),['class'=>'btn btn-info'])?>
            </div>
        </div>
                    <div class="panel panel-default">
                <div class="panel panel-heading" style="padding: 10px">Histori Belanja</div>
                <div class="panel panel-body">
                <?php
      $gridColumns = [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['class' => 'text-right serial-column'],
                'contentOptions' => ['class' => 'text-right serial-column'],
            ],
            
            // 'id',
          
            'nama_penerima',
            [
                'label'=>'alamat',
                'value' => function($model){
                    return $model->jln .', '. $model->kota_tujuan .', '. $model->provinsi_tujuan .'. '. $model->kodepos;
                }
            ],
            
            'kurir',
           
            [
                'attribute' => 'total',
                'format' => 'integer',
                'headerOptions' => ['class' => 'text-right'],
                'contentOptions' => ['class' => 'text-right'],
            ],
            [
                'attribute' => 'date',
                'format' => 'date',
                'filterType' => GridView::FILTER_DATE,
                'filterInputOptions' => ['placeholder' => ''],
                'filterWidgetOptions' => [
                    'pluginOptions' => ['autoclose' => true, 'format' => 'yyyy-mm-dd'],
                ],
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value'=>function($model){
                    return $model->getStatusTypeText(true);
                },
                'headerOptions' => ['class' => 'text-right'],
                'contentOptions' => ['class' => 'text-right'],
            ],
            // 'created_at:integer',
            // 'created_by:integer',
            // 'updated_at:integer',
            // 'updated_by:integer',
        ];
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'responsiveWrap' => false,
        'pjax' => true,
        'hover' => true,
        'striped' => false,
        'bordered' => false,
        'toolbar'=> [
            // Html::a('<i class="fa fa-plus"></i> ' . 'Create', ['create'], ['class' => 'btn btn-success']),
            // Html::a('<i class="fa fa-repeat"></i> ' . 'Reload', ['index'], ['data-pjax'=>0, 'class'=>'btn btn-default']),
            // '{toggleData}',
            // $exportMenu,
        ],
        'panel' => [
            'type' => 'no-border transparent',
            'heading' => false,
            'before' => '{summary}',
            'after' => false,
        ],
        'panelBeforeTemplate' => '
            <div class="row">
                <div class="col-sm-8">
                    <div class="btn-toolbar kv-grid-toolbar" role="toolbar">
                        {toolbar}
                    </div> 
                </div>
                <div class="col-sm-4">
                    <div class="pull-right">
                        {before}
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        ',
        'pjaxSettings' => ['options' => ['id' => 'grid']],
        'columns' => $gridColumns,
    ]); ?>
    </div>
</div>
</div>
</div>