 <?php

use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\PesanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Checkout';
$this->params['breadcrumbs'][] = $this->title;
?>
  
 Daftar Belanja
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
       
   