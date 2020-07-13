<?php

use yii\helpers\Html;
?>
<td>
	<input type="number" id="qty" value="<?=$key->qty?>" class="form-control input-sm">
	<?=Html::a('-',['update-qty', 'id'=>$key->id, 'set'=>'kurang'],['class'=>'btn btn-xs btn-warning'])?>
	<?=Html::a('+',['update-qty', 'id'=>$key->id, 'set'=>'tambah'],['class'=>'btn btn-xs btn-danger'])?>
</td>
