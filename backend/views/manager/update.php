<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\entity\manager */

$this->title = 'Update Manager: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Manager', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="manager-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
