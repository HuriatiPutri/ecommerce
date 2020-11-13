<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\entity\costumer */

$this->title = 'Update Costumer: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Costumer', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="costumer-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
