<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use kartik\widgets\Select2;
use kartik\widgets\DatePicker;
use common\models\entity\User;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\PesanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cart';
$this->params['breadcrumbs'][] = $this->title;
?>
  

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
    <div class="col-lg-9 col-md-9 col-sm-12">
        <h1><?= Html::encode($this->title) ?></h1>
<div class="panel-default">
                <div class="panel-body">
            <?=Html::label('ID Pesanan : '. $id_pesan)?> 
        </div>
        </div>
        <div class="well">

        <Table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th></th>
                        <th>Product</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $tot = 0;
                    foreach ($dataProvider as $key) {
                    ?>
                    <tr>
                        <td>#</td>
                        <td> <?= Html::img(['download', 'id' => $key->product->id, 'field' => 'mainImage'] //$model->mainImage
                , [
                'class' => 'img-responsive',
                'width' => '100'
            ]) ?></td>
                        <td><?=$key->product->name?>
                            <br>
                            <?=$key->ukuran?>
                        </td>
                        <td>Rp. <?=number_format(($key->product->price))?>
                        </td>
                        <?=$this->render('_add_qty', ['key'=>$key])?>
                        <td>Rp. <?=number_format($key->product->price * $key->qty)?></td>
                        <td> <?=Html::a('Hapus', ['cart/delete','id'=>$key->id],['class'=>'btn btn-sm btn-danger'])?></td>
                    </tr>
                <?php 
                $tot = $key->pesan_total+$tot;
            } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5"><?=Html::label('Total Belanja')?></td>
                        <td>Rp. <?=number_format($tot)?></td>
                    </tr>
                </tfoot>
        </Table>
       
        <?=Html::a('Belanja Lagi', ['site/index'],['class'=>'btn btn-primary'])?> 
        <?php if($dataProvider != null ) echo Html::a('checkout', ['cart/view','id'=>$id_pesan],['class'=>'btn btn-warning'])?> 
   
    </div>
</div>
<div>