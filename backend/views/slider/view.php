<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\entity\Slider */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Slider', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="slider-view">

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
              [
                    'label' => 'Foto',
                    'value' => function($model){
                    return $model->foto ? Html::img(['download', 'id' => $model->id, 'field' => 'foto'], ['class' => '', 'data-pjax' => 0, 'width'=>100]) : null;
                },
                    'format' => 'raw',
                ],
[
                    'label' => 'Status',
                    'value' => function($model){
                    return $model->status ==1 ? 'publish' : 'unpublish';
                },
                    'format' => 'raw',
                ],  
            ],
        ]) ?>
    </div>
    
</div>
