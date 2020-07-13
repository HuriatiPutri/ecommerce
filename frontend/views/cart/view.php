<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use kartik\widgets\Select2;
use kartik\widgets\DatePicker;
use common\models\entity\User;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\PesanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Checkout';
$this->params['breadcrumbs'][] = $this->title;
?>
  
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<div class="row" style="margin-top: 40px">
    <div class="col-lg-3 col-md-3 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Html::label('Categories') ?>
            </div>

            <div class="panel-body">
                <?= $this->render('/site/_nav') ?>
            </div>
        </div>
    </div>
    <?php $form = ActiveForm::begin([
        'id'      => 'active-form',
        'options' => ['enctype' => 'multipart/form-data'],
        'layout'  => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label'   => 'col-sm-4',
                'offset'  => 'col-sm-offset-4',
                'wrapper' => 'col-sm-8',
                'error'   => '',
                'hint'    => '',
            ],
        ],
    ]); ?>
    
    <div class="col-lg-9 col-md-9 col-sm-12">
        <h1><?= Html::encode($this->title) ?></h1>
  <ul class="nav nav-pills nav-justified nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#legalitas" aria-controls="legalitas" role="tab" data-toggle="tab">Daftar Belanja</a></li>
            <li role="presentation"><a href="#administrasi" aria-controls="administrasi" role="tab" data-toggle="tab">Data Pengiriman</a></li>
    
        </ul>
        <div class="well">
             <div class="tab-content" style="background:white; padding:15px; padding-top:30px">
            <div role="tabpanel" class="tab-pane active" id="legalitas">
                <?= $this->render('_list_belanja', [
                    // 'form' => $form,
                    'dataProvider' => $dataProvider,
                ]) ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="administrasi">
                <?= $this->render('_data_pengiriman', [
                    'form' => $form,
                    // 'model' => $model,
                    'pesan' =>$pesan
                ]) ?>
            </div>

           
        </div>

           
    </div>
   <div class="panel-footer text-right">
            <?=
                Html::button('<i class="glyphicon glyphicon-chevron-left"></i> Sebelumnya', ['class' => 'btn btn-default btn-viewer', 'id' => 'btnPrevious'])
                    . ' ' . Html::button('<i class="glyphicon glyphicon-chevron-right"></i> Berikutnya', ['class' => 'btn btn-warning btn-viewer', 'id' => 'btnNext'])
                    . ' ' . Html::submitButton('<i class="fa fa-paper-plane"></i> Selesai', ['class' => 'btn btn-success', 'id' => 'btnKirim'])
            ?>
        </div>
 
    <?php ActiveForm::end(); ?>
    </div>
</div>
<div>

    <?php
$js = <<<JAVASCRIPT
    i=0;
        console.log(i)
        if(i==2){
        $('#btnNext').hide();
            $('#btnPrevious').show();
        }else if(i==0){
            $('#btnPrevious').hide();
            $('#btnNext').show();
        }
    $('#btnNext').click(function() {
        i++;
        console.log(i)
        $('.nav-tabs > .active').next('li').find('a').trigger('click');
        if(i==1){
            $('#btnNext').hide();
            $('#btnPrevious').show();
        }else if(i==0){
            $('#btnPrevious').hide();
            $('#btnNext').show();
        }else{
            $('#btnPrevious').show();
            $('#btnNext').show();
        }
    });
    $('#btnPrevious').click(function() {
        i--;
        console.log(i)
        $('.nav-tabs > .active').prev('li').find('a').trigger('click');
        if(i==1){
            $('#btnNext').hide();
            $('#btnPrevious').show();
            $('#btnKirim').show();
        }else if(i==0){
            $('#btnPrevious').hide();
            $('#btnNext').show();
        }else{
            $('#btnPrevious').show();
            $('#btnNext').show();
        }
    });
      
JAVASCRIPT;

$this->registerJs($js, \yii\web\View::POS_END);

?>