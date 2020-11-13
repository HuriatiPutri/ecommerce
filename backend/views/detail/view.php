<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\entity\detail */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Detail', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="detail-view">

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
                'pesan.name:text:Pesan',
                'costumer.name:text:Costumer',
                'costumer_address:integer',
                'product.name:text:Product',
                'pesan_total:integer',
                'pesan_paid:integer',
                'date',
                'status:ntext',
                // 'created_at:datetime',
                // 'createdBy.username:text:Created By',
                // 'updated_at:datetime',
                // 'updatedBy.username:text:Updated By',
            ],
        ]) ?>
    </div>
    
</div>
