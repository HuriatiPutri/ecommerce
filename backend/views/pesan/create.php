<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\entity\pesan */

$this->title = 'Create Pesan';
$this->params['breadcrumbs'][] = ['label' => 'Pesan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pesan-create">

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
    
</div>
