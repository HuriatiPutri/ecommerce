<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\entity\Product */

$this->title = 'Create Product';
$this->params['breadcrumbs'][] = ['label' => 'Product', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
    
</div>
