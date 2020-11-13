<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\entity\detail */

$this->title = 'Update Detail: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Detail', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="detail-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
