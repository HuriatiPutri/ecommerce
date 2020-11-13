<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;
use common\models\entity\Supplier;
use common\models\entity\Category;
use common\models\entity\Product;

/* @var $this yii\web\View */
/* @var $model common\models\entity\masuk */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="masuk-form">

<div class="row">
<div class="col-md-8 col-sm-12">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'supplier_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Supplier::find()->all(), 'id', 'name'),
        'options' => ['placeholder' => ''],
        'pluginOptions' => ['allowClear' => true],
    ]); ?>

    <?= $form->field($model, 'category_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Category::find()->all(), 'id', 'category'),
        'options' => ['placeholder' => ''],
        'pluginOptions' => ['allowClear' => true],
    ]); ?>

    <?= $form->field($model, 'product_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Product::find()->all(), 'id', 'name'),
        'options' => ['placeholder' => ''],
        'pluginOptions' => ['allowClear' => true],
    ]); ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'total')->textInput() ?>

    <?= $form->field($model, 'paid')->textInput() ?>

    
    <div class="form-panel">
        <div class="row">
    	    <div class="col-sm-12">
    	        <?= Html::submitButton('<i class="glyphicon glyphicon-ok"></i> ' . ($model->isNewRecord ? 'Create' : 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
	    </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>

</div>
