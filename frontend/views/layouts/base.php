<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use frontend\assets\AppAsset;
use common\models\entity\pesan;
use common\models\entity\DetailPesan;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> - Ecommerce</title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() 
    ?>

    <header>
        <?php
             

            NavBar::begin([
                'brandLabel' => Yii::$app->name,
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
           if (!Yii::$app->user->isGuest) { 
            $cart  = DetailPesan::find()->joinWith('pesan')->where(['status'=>0, 'user_id'=>Yii::$app->user->identity->id])->count();
            $menuItems = [
                ['label' => 'Home', 'url' => ['site/index']],
                [
                    'label' => 'Cart' . '&nbsp' . Html::tag('span', $cart, ['class' => 'badge']),
                    'url' => ['cart/index'],
                ],
                ['label' => 'Profile', 'url' => ['profile/index']],
                ['label' => 'Logout', 'url' => ['site/logout']],
            ];
        }else{
             $menuItems = [
                ['label' => 'Home', 'url' => ['site/index']],
                // ['label' => 'Catalog', 'url' => ['catalog/index']],
                [
                    'label' => 'Cart',
                    'url' => ['cart/index'],
                ],
                ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],

            ];
        }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
                'encodeLabels' => false,
            ]);
            NavBar::end();
        ?>
    </header>

    <main>
        <?= $content ?>
    </main>

    <footer>
        <div class="footer-bottom">
            <div class="container">
                <p class="pull-left">
                    © <?= Yii::$app->name ?> <?= date('Y') ?>. <?= Html::label('All rights reserved') ?>.
                </p>
            </div>
        </div>
        <!--/.footer-bottom-->
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
