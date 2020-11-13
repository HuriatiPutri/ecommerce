<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use kartik\widgets\Select2;
use common\models\entity\Supplier;
use common\models\entity\Category;
use common\models\entity\Product;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\MasukSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Masuk';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="masuk-index">

    <?php 
        $exportColumns = [
            [
                'class' => 'yii\grid\SerialColumn',
            ],
            'id',
            'supplier.name:text:Supplier',
            'category.name:text:Category',
            'product.name:text:Product',
            'price',
            'total',
            'paid',
            'created_at:datetime',
            'createdBy.username:text:Created By',
            'updated_at:datetime',
            'updatedBy.username:text:Updated By',
        ];

        $exportMenu = ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => $exportColumns,
            'filename' => 'Masuk',
            'fontAwesome' => true,
            'dropdownOptions' => [
                'label' => 'Export',
                'class' => 'btn btn-default'
            ],
            'target' => ExportMenu::TARGET_SELF,
            'exportConfig' => [
                ExportMenu::FORMAT_CSV => false,
                ExportMenu::FORMAT_EXCEL => false,
                ExportMenu::FORMAT_HTML => false,
            ],
            'styleOptions' => [
                ExportMenu::FORMAT_EXCEL_X => [
                    'font' => [
                        'color' => ['argb' => '00000000'],
                    ],
                    'fill' => [
                        // 'type' => PHPExcel_Style_Fill::FILL_NONE,
                        'color' => ['argb' => 'DDDDDDDD'],
                    ],
                ],
            ],
            'pjaxContainerId' => 'grid',
        ]);

        $gridColumns = [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['class' => 'text-right serial-column'],
                'contentOptions' => ['class' => 'text-right serial-column'],
            ],
            [
                'contentOptions' => ['class' => 'action-column nowrap text-left'],
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url) {
                        return Html::a('', $url, ['class' => 'glyphicon glyphicon-eye-open btn btn-xs btn-default btn-text-info']);
                    },
                    'update' => function ($url) {
                        return Html::a('', $url, ['class' => 'glyphicon glyphicon-pencil btn btn-xs btn-default btn-text-warning']);
                    },
                    'delete' => function ($url) {
                        return Html::a('', $url, [
                            'class' => 'glyphicon glyphicon-trash btn btn-xs btn-default btn-text-danger', 
                            'data-method' => 'post', 
                            'data-confirm' => 'Are you sure you want to delete this item?']);
                    },
                ],
            ],
            // 'id',
            [
                'attribute' => 'supplier_id',
                'value' => 'supplier.name',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(Supplier::find()->orderBy('name')->asArray()->all(), 'id', 'name'), 
                'filterInputOptions'=>['placeholder'=>''],
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear'=>true],
                ],
            ],
            [
                'attribute' => 'category_id',
                'value' => 'category.category',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(Category::find()->orderBy('category')->asArray()->all(), 'id', 'category'), 
                'filterInputOptions'=>['placeholder'=>''],
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear'=>true],
                ],
            ],
            [
                'attribute' => 'product_id',
                'value' => 'product.name',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(Product::find()->orderBy('name')->asArray()->all(), 'id', 'name'), 
                'filterInputOptions'=>['placeholder'=>''],
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear'=>true],
                ],
            ],
            [
                'attribute' => 'price',
                'format' => 'integer',
                'headerOptions' => ['class' => 'text-right'],
                'contentOptions' => ['class' => 'text-right'],
            ],
            [
                'attribute' => 'total',
                'format' => 'integer',
                'headerOptions' => ['class' => 'text-right'],
                'contentOptions' => ['class' => 'text-right'],
            ],
            [
                'attribute' => 'paid',
                'format' => 'integer',
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
            Html::a('<i class="fa fa-plus"></i> ' . 'Create', ['create'], ['class' => 'btn btn-success']),
            Html::a('<i class="fa fa-repeat"></i> ' . 'Reload', ['index'], ['data-pjax'=>0, 'class'=>'btn btn-default']),
            '{toggleData}',
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
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
    ]); ?>

</div>
