<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\entity\supplier */

$this->title = 'Update Supplier: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Supplier', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="supplier-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
