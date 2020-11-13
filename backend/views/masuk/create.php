<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\entity\masuk */

$this->title = 'Create Masuk';
$this->params['breadcrumbs'][] = ['label' => 'Masuk', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="masuk-create">

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
    
</div>
