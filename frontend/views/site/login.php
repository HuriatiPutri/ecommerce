<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
// $this->params['breadcrumbs'][] = $this->title;
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

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div class="form-panel">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <div style="color:#999;margin:1em 0">
                <?php // Html::a('Lupa Password', ['site/request-password-reset']) ?>
                <!-- <br> -->
                <?php // echo Html::a('Resend Verification Email', ['site/resend-verification-email']) ?>
            </div>
            Belum Mempunyai Akun? Register <?=Html::a('disini', ['site/signup'])?> 
        <?php ActiveForm::end(); ?>
    </div>
    </div>
</div>
</div>