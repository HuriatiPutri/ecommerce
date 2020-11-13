<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $class */
?>
<div class="<?= $class ?>">
    <div class="panel panel-default panel-product">
        <div class="panel-image" style="margin-top: 10px">
            <center>
            <?= Html::img(['download', 'id' => $model->id, 'field' => 'mainImage'] //$model->mainImage
                , [
                // 'class' => 'img-responsive',
                'width' => '250',
                'height' => '150'
            ]) ?>
</center>
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
        </div>
        <div class="panel-body">
            <h4>
                <?= Html::a($model->name, ['cart/create', 'id' => $model->id]) ?>
            </h4>
            <hr>

            <p class="text-muted">
                category : 
                <?= Html::a($model->category->category, ['site/view-by-category', 'id' => $model->category->id], [
                    'class' => 'category-link',
                ]) ?>
            </p>

            <p>Rp. <?= number_format($model->price) ?></p>

            <?=Html::a('Wishlist',Url::toRoute(['wishlist','id'=>$model->id]),['class'=> $model->onWishList() ? 'btn btn-success btn-xs' : 'btn btn-default btn-xs'])?>
                    
        </div>
    </div>
</div>