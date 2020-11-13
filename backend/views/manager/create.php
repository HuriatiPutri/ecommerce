<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\entity\manager */

$this->title = 'Create Manager';
$this->params['breadcrumbs'][] = ['label' => 'Manager', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manager-create">

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
    
</div>
