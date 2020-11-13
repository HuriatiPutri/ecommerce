<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\entity\pesan */

$this->title = 'Update Pesan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pesan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pesan-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
