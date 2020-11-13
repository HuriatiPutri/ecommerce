<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $class */
?>
<div class="<?= $class ?>">
    <div class="panel panel-default panel-product">
        <div class="panel-image" style="margin-top: 10px">
            <center>
            <?= Html::img(['/site/download', 'id' => $model->id, 'field' => 'mainImage'] //$model->mainImage
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
                <?= Html::a($model->product->name, ['cart/create', 'id' => $model->product->id]) ?>
            </h4>
            <hr>

            <p class="text-muted">
                category : 
                <?= Html::a($model->product->category->category, ['site/view-by-category', 'id' => $model->product->category->id], [
                    'class' => 'category-link',
                ]) ?>
            </p>

            <p>Rp. <?= number_format($model->product->price) ?></p>
<a href="wishlist?id=<?=$model->product->id?>"><i class="fa fa-heart btn <?=$model->product->onWishList() ? 'btn-success' : 'btn-default'?> btn-xs pull-right" aria-hidden="true">
                WishList
            </i></a>



        
        </div>
    </div>
</div>