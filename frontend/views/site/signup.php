<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row" style="margin-top: 70px" >

    <div class="col-lg-3 col-md-3 col-sm-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Html::label('Categories') ?>
            </div>

            <div class="panel-body">
                <?= $this->render('_nav') ?>
            </div>
        </div>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-12">
        <h1><?= Html::encode($this->title) ?></h1>

        <div class="well">
            <div class="row">
            <div class="col-md-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            Sudah Mempunyai Akun? Login <?=Html::a('disini', ['site/login'])?> 

            <?php ActiveForm::end(); ?>
    </div>
    </div>
</div>
</div>