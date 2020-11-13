<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\entity\Slider */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slider-form">

<div class="row">
<div class="col-md-8 col-sm-12">

    <?php $form = ActiveForm::begin(); ?>
    <?=Html::label('Gambar Slider')?>
  <?= $form->field($model, 'foto', ['template' => "{input}\n{error}{hint}"])->widget(FileInput::className(), [
                // 'options' => ['accept' => 'image/*, application/pdf'],
                'pluginOptions' => [
                    'showPreview'           => false,
                    'showUpload'            => false,
                    // 'allowedFileExtensions' => ['pdf', 'png', 'jpg', 'jpeg'],
                    'elErrorContainer'      => '#error-media_file_physical-file',
                ]
            ]) ?>

    <?=$form->field($model, 'status')->radioList(['0'=>'unpublish','1'=>'publish'])?>
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
