      <?php

use common\models\entity\Province;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
      ?>
        <h4>Data Pengiriman</h4>
        <ul class="list-group">
          <li class="list-group-item">
                  <?= $form->field($pesan, 'nama_penerima')->textInput(['maxlength' => true]) ?>
        </li>
          <li class="list-group-item"><?= $form->field($pesan, 'no_telp')->textInput(['maxlength' => true]) ?></li>
        
          <li class="list-group-item">
             <?= $form->field($pesan, 'kotatujuan')->widget(Select2::classname(), [
            // 'data' => ArrayHelper::map(Province::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => ''],
             // 'onChange' => 'bahanInfo(this.value,$("#bahandatang-input_quantity").val())'
            'pluginOptions' => ['allowClear' => true],
             ]); ?>
         </li>
           <li class="list-group-item">
            <?php 
              $kurir = [];
              $kurir = array('jne'=>'jne','tiki'=>'tiki','pos'=>'pos');
            ?>
             <?= $form->field($pesan, 'kurir')->widget(Select2::classname(), [
            'data' => $kurir,
            'options' => ['placeholder' => '', 'onChange'=>'getCost(321,$("#pesan-kotatujuan").val(),1,$("#pesan-kurir").val())'],
             // 'onChange' => 'bahanInfo(this.value,$("#bahandatang-input_quantity").val())'
            'pluginOptions' => ['allowClear' => true],
             ]); ?>
         </li>
          <li class="list-group-item"><?= $form->field($pesan, 'jln')->textInput(['maxlength' => true]) ?></li>
          <li class="list-group-item">            
            <?= $form->field($pesan, 'kodepos')->textInput(['maxlength' => true]) ?></li>
          <li class="list-group-item">    
            <?= $form->field($pesan, 'ongkir')->textInput(['maxlength' => true]) ?><div id="pesan"></div></li>
             <?= $form->field($pesan, 'kota_asal')->hiddenInput(['maxlength' => true])->label(false) ?>
        <?= $form->field($pesan, 'kota_tujuan')->hiddenInput(['maxlength' => true])->label(false) ?>
        <?= $form->field($pesan, 'provinsi_asal')->hiddenInput(['maxlength' => true])->label(false) ?>
        <?= $form->field($pesan, 'provinsi_tujuan')->hiddenInput(['maxlength' => true])->label(false) ?>
        </ul>
       
<?php
$url = Url::to(['/cart/city']);
$url2 = Url::to(['/cart/cost/']);


$js = <<<JAVASCRIPT
getKota();
function getKota(){

   $.get("{$url}", function(response){
        if(response){
        $('#pesan-kotaasal').html(response);
        $('#pesan-kotatujuan').html(response);
        }
    });
}
function getCost(kotaasal,kotatujuan,berat,kurir){
 $.get("{$url2}", { kotaasal : kotaasal, kotatujuan : kotatujuan, berat:berat, kurir:kurir},  function(response){
        if(response){
          obj = JSON.parse(response)
        console.log('cost', obj)
        $("#pesan").html(obj.pesan)
        $("#pesan-ongkir").val(obj.harga)
        $("#pesan-kota_asal").val(obj.kota_asal)
        $("#pesan-kota_tujuan").val(obj.kotatujuan)
        $("#pesan-provinsi_asal").val(obj.provinsiasal)
        $("#pesan-provinsi_tujuan").val(obj.provinsitujuan)
        }else{
         $("#pesan-ongkir").val("Tidak ada pengiriman")
        }
    });
}
JAVASCRIPT;

$this->registerJs($js, \yii\web\View::POS_END);

?>