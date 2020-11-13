<?php
use common\models\entity\Category;
use yii\bootstrap\Nav;

/* @var $this yii\web\View */

// Items
$navItems = [];
 $navItems[] = [
        'label' => 'All Category',
        'url' => ['index'],
    ];
foreach (Category::find()->all() as $category) {
    $label = $category->category 
        . '<span class="badge pull-right">'
        . $category->getProducts()->count()
        . '</span>';

    $navItems[] = [
        'label' => $label,
        'url' => ['site/view-by-category', 'id' => $category->id],
    ];
}

echo Nav::widget([
    'items' => $navItems,
    'options' => ['class' => 'nav-pills nav-stacked'],
    'encodeLabels' => false,
]);

