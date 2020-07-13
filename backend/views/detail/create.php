<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\entity\detail */

$this->title = 'Create Detail';
$this->params['breadcrumbs'][] = ['label' => 'Detail', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-create">

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
    
</div>
