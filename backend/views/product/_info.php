<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use kartik\widgets\Select2;
use common\models\entity\Category;
use yii\bootstrap\ActiveForm;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Info detail product';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="product-index">
    <div class="row">
    <div class="col-sm-4 panel panel-default">
        <div class="panel panel-body">
  <?php $form = ActiveForm::begin(); ?>

    <?=Html::label('Inpukan Ukuran / Warna Produk')?>
    <hr>
    <?=Html::label('Ukuran/Warna')?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(false) ?>
        <?= $form->field($model, 'group')->radioList(['1'=>'size', '2'=>'warna'])?>

   
     <div class="form-panel">
        <div class="row">
            <div class="col-sm-12">
                <?= Html::submitButton('<i class="glyphicon glyphicon-ok"></i> ' . ($model->isNewRecord ? 'Create' : 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                 <?= Html::a('Selesai',['view', 'id'=>$id], ['class' =>'btn btn-warning']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
</div>

 <div class="col-sm-8 panel panel-default">
        <div class="panel panel-body">
    <?php 
       
        $gridColumns = [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['class' => 'text-right serial-column'],
                'contentOptions' => ['class' => 'text-right serial-column'],
            ],
            [
                'contentOptions' => ['class' => 'action-column nowrap text-left'],
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete-detail}',
                'buttons' => [
                    'delete-detail' => function ($url) {
                        return Html::a('', $url, [
                            'class' => 'glyphicon glyphicon-trash btn btn-xs btn-default btn-text-danger', 
                            'data-method' => 'post', 
                            'data-confirm' => 'Are you sure you want to delete this item?']);
                    },
                ],
            ],
            'name:Text:warna/ukuran',
            [
                'label' =>'Group',
                'value' =>function($model){
                    return $model->group == 1 ? 'Size' : 'Warna';
                }
            ]
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
