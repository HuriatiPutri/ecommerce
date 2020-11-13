<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;
use common\models\entity\Category;
use kartik\widgets\FileInput;

use common\models\entity\FotoDetail;

use mdm\widgets\TabularInput;
/* @var $this yii\web\View */
/* @var $model common\models\entity\Product */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Upload Bukti Pembayaran';
// $this->params['breadcrumbs'][] = ['label' => 'Pesan', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>

<div class="pesan-form">

    <div class="row" style="margin-top: 100px">

        <div class="col-md-8 col-sm-12">
            <h2><?= $this->title ?></h2>
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'nama_penerima')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'total')->textInput() ?>

            <?= $form->field($model, 'bukti', ['template' => "{input}\n{error}{hint}"])->widget(FileInput::className(), [
                // 'options' => ['accept' => 'image/*, application/pdf'],
                'pluginOptions' => [
                    'showPreview'           => false,
                    'showUpload'            => false,
                    // 'allowedFileExtensions' => ['pdf', 'png', 'jpg', 'jpeg'],
                    'elErrorContainer'      => '#error-media_file_physical-file',
                ]
            ])->label("file bukti pembayaran") ?>

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