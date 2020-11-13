<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\DetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'pesan_id') ?>

    <?= $form->field($model, 'costumer_id') ?>

    <?= $form->field($model, 'costumer_address') ?>

    <?= $form->field($model, 'product_id') ?>

    <?php // echo $form->field($model, 'pesan_total') ?>

    <?php // echo $form->field($model, 'pesan_paid') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
