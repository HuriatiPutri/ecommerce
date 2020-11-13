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
?>

<div class="product-form">

    <div class="row">
        <div class="col-md-8 col-sm-12">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'price')->textInput() ?>
            
            <?= $form->field($model, 'stock')->textInput() ?>

            <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'mainImage', ['template' => "{input}\n{error}{hint}"])->widget(FileInput::className(), [
                // 'options' => ['accept' => 'image/*, application/pdf'],
                'pluginOptions' => [
                    'showPreview'           => false,
                    'showUpload'            => false,
                    // 'allowedFileExtensions' => ['pdf', 'png', 'jpg', 'jpeg'],
                    'elErrorContainer'      => '#error-media_file_physical-file',
                ]
            ]) ?>
            <?= $form->field($model, 'category_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Category::find()->all(), 'id', 'category'),
                'options' => ['placeholder' => ''],
                'pluginOptions' => ['allowClear' => true],
            ]); ?>

            <!-- <div class="panel panel-default">
        <table class="table table-condensed table-hover">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th align="right"><a id="btn-add" class="btn btn-success"><i class="fa fa-plus"></i></a></th>
                </tr>
            </thead>
            <?php
            // TabularInput::widget([
            //     'id'            => 'detail-grid',
            //     'allModels'     => $model->fotoDetails,
            //     'model'         => FotoDetail::className(),
            //     'tag'           => 'tbody',
            //     'form'          => $form,
            //     'itemOptions'   => ['tag' => 'tr'],
            //     'itemView'      => '_item_detail',
            //     'clientOptions' => [
            //         'btnAddSelector' => '#btn-add',
            //     ]
            // ]);
            ?>

        </table>
    </div>
     -->
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