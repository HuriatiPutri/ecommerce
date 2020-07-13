<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\entity\costumer */

$this->title = 'Create Costumer';
$this->params['breadcrumbs'][] = ['label' => 'Costumer', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="costumer-create">

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
    
</div>
