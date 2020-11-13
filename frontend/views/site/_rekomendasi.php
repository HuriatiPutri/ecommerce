<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $class */
?>
<div class="<?= $class ?>">
    <div class="panel panel-default panel-product">
        <div class="panel-image">
            <center>
            <?= Html::img(['download', 'id' => $model->id, 'field' => 'mainImage'] //$model->mainImage
                , [
                // 'class' => 'img-responsive',
                'width' => '50',
                'height' => '50'
            ]) ?>
             <?= Html::a($model->name, ['site/view', 'id' => $model->id]) ?>
</center>
        </div>
    </div>
</div>