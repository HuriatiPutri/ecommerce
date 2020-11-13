<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Info Pembayaran';
// $this->params['breadcrumbs'][] = $this->title;
?>

<div class="row" style="margin-top: 70px" >

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

            <div class="row">
                <div class="col-md-12">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <b>Pembayaran</b>
                    </div>
                    <div class="panel-body">
                        Silahkan lakukan pembayaran ke <b> no rek. 0843874834 </b>
                        atas nama Pemilik toko. dalam waktu 2x24 jam. kemudian konfirmasi ke Wa. <b> 088847348</b>
                    </div>
                   
                </div>
        </div>
                <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>Detail Pembeli</b>
                    </div>
                    <div class="panel-body">
                        <p><b><?=$model->nama_penerima?></b></p>
                        <?=$model->jln?>, <?=$model->kota_tujuan?>, <?=$model->provinsi_tujuan?>, <?=$model->kodepos?>
                        <br>
                        <?=$model->no_telp?>
                    </div>
                    <div class="panel-footer">
                        <b></b>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>Ringkasan Belanja</b>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                        <div class="col-md-7">Total Harga Barang</div>
                        <div class="col-md-5"><?=$model->paid?></div>  
                        <div class="col-md-7">Biaya Kirim</div>
                        <div class="col-md-5"><?=$model->ongkir?></div>   
                        <hr>
                        </div>                     
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                        <div class="col-md-7"><b>Total Belanja</b></div>
                        <div class="col-md-5"><b><?=$model->total?></b></div> 
                        </div>  
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>Detail Belanja</b>
                    </div>
                    <div class="panel-body">
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
                        <td><?=$key->product->name?></td>
                        <td>Rp. <?=number_format(($key->product->price))?></td>
                        <td><?=$key->qty?></td>
                        <td>Rp. <?=number_format($key->product->price * $key->qty)?></td>
                        <td></td>
                    </tr>
                <?php 
            } ?>
                </tbody>
        </Table>
       
                   
                    </div>
                
                </div>
            </div>
        </div>
            
</div>