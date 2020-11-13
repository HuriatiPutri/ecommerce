<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\entity\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Product', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="product-view">

    <p>
        <?= Html::a('<i class="glyphicon glyphicon-pencil"></i> '. 'Update', ['update', 'id' => $model->id], [
            'class' => 'btn btn-warning',
        ]) ?>
        <?= Html::a('<i class="glyphicon glyphicon-trash"></i> ' . 'Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="detail-view-container">
        <?= DetailView::widget([
            'options' => ['class' => 'table detail-view'],
            'model' => $model,
            'attributes' => [
                // 'id',
                'name',
                'price:integer',
                'desc:ntext',
                [
                    'label' => 'Foto',
                    'value' => function($model){
                    return $model->mainImage ? Html::img(['download', 'id' => $model->id, 'field' => 'mainImage'], ['class' => '', 'data-pjax' => 0, 'width'=>100]) : null;
                },
                    'format' => 'raw',
                ],
                'category.category:text:Category',
            ],
        ]) ?>

         <?php 
       
        $gridColumns = [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['class' => 'text-right serial-column'],
                'contentOptions' => ['class' => 'text-right serial-column'],
            ],
            [
                    'label' => 'Foto',
                    'value' => function($model){
                    return $model->foto ? Html::img(['download-detail', 'id' => $model->id, 'field' => 'foto'], ['class' => '', 'data-pjax' => 0, 'width'=>100]) : null;
                },
                    'format' => 'raw',
                ],
        ];
          $gridColumns2 = [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['class' => 'text-right serial-column'],
                'contentOptions' => ['class' => 'text-right serial-column'],
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
</div>
<div class="col-sm-6 panel panel-default">
     <div class="panel panel-header">
            <h4>Foto Detail</h4>
        </div>
        <div class="panel panel-body">
    <?= GridView::widget([
        'dataProvider' => $foto,
        'responsiveWrap' => false,
        'pjax' => false,
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
            
            <div class="clearfix"></div>
        ',
        'pjaxSettings' => ['options' => ['id' => 'grid']],
        'columns' => $gridColumns,
    ]); ?>
    
    </div>
    </div>
    <div class="col-sm-6 panel panel-default">
        <div class="panel panel-header">
            <h4>Info Produk</h4>
        </div>
        <div class="panel panel-body">
  <?= GridView::widget([
        'dataProvider' => $info,
        'responsiveWrap' => false,
        'pjax' => false,
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
           
            <div class="clearfix"></div>
        ',
        'pjaxSettings' => ['options' => ['id' => 'grid']],
        'columns' => $gridColumns2,
    ]); ?>  
    
    </div>
    </div>
</div>
</div>

 