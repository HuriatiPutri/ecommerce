<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Change Password';
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
        <p>Please fill out the following fields to change your password: </p>
        <br>

        <?php $form = ActiveForm::begin([
            'id'=>'changepassword-form',
        ]); ?>

        <?= $form->field($model,'oldpass',['inputOptions'=>[
            'placeholder'=>''
        ]])->passwordInput() ?>
    
        <?= $form->field($model,'newpass',['inputOptions'=>[
            'placeholder'=>''
        ]])->passwordInput() ?>
    
        <?= $form->field($model,'repeatnewpass',['inputOptions'=>[
            'placeholder'=>''
        ]])->passwordInput() ?>
    
        <div class="form-panel">
            <?= Html::submitButton('Change password',['class'=>'btn btn-primary']) ?>
        </div>
        
        <?php ActiveForm::end(); ?>
        </div>
</div>
</div>