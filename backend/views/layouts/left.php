<?php 
    use yii\helpers\Url;
?>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <?php if (!Yii::$app->user->isGuest) { ?>
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= Url::base().'/img/user.jpg' ?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->name ?></p>

                <a href="#"><i class="circle text-success"></i> <?= Yii::$app->user->identity->roles ?></a>
            </div>
        </div>
        <?php } ?>

        <?php if (!Yii::$app->user->isGuest) { ?>
        <?php   
            $menuItems = [
                ['label' => '<b>MENU</b>', 'encode' => false, 'options' => ['class' => 'header']],

                ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/site/index']],
                // ['label' => 'Product', 'icon' => 'file-o', 'url' => ['/product/index']],
                // ['label' => 'Category', 'icon' => 'file-o', 'url' => ['/category/index']],
                // ['label' => 'Costumer', 'icon' => 'file-o', 'url' => ['/costumer/index']],
                // ['label' => 'Employee', 'icon' => 'file-o', 'url' => ['/karyawan/index']],
                // ['label' => 'Supplier', 'icon' => 'file-o', 'url' => ['/supplier/index']],
                // ['label' => 'Barang Masuk', 'icon' => 'file-o', 'url' => ['/masuk/index']],
                // ['label' => 'Pesanan', 'icon' => 'file-o', 'url' => ['/pesan/index']],
                [
                    'label' => 'Master',
                    'icon' => 'lock',
                    'url' => '#',
                    'options' => ['class' => 'treeview'],
                    // 'visible' => Yii::$app->user->can('superuser'),
                    'items' => [
                        ['label' => 'Category',         'url' => ['/category/index']],
                        ['label' => 'Product',   'url' => ['/product/index']],
                        ['label' => 'Costumer',         'url' => ['/costumer/index']],
                        ['label' => 'Employee',   'url' => ['/karyawan/index']],
                        ['label' => 'Supplier',        'url' => ['/supplier/index']],
                    ],
                ],
                 [
                    'label' => 'Transaksi',
                    'icon' => 'list',
                    'url' => '#',
                    'options' => ['class' => 'treeview'],
                    // 'visible' => Yii::$app->user->can('superuser'),
                    'items' => [
                        ['label' => 'Pesanan',         'url' => ['/pesan/index']],
                        // ['label' => 'Pengiriman',   'url' => ['/pengiriman/index']],
                        ['label' => 'Barang Masuk',         'url' => ['/masuk/index']],
                        // ['label' => 'Costumer',         'url' => ['/karyawan/index']],
                        // ['label' => 'Employee',   'url' => ['/acf/permission']],
                        // ['label' => 'Supplier',        'url' => ['/supplier/index']],
                        // ['label' => 'Barang Masuk',         'url' => ['/masuk/index']],
                    ],
                ],
                [
                    'label' => 'Laporan',
                    'icon' => 'file-o',
                    'url' => '#',
                    'options' => ['class' => 'treeview'],
                    // 'visible' => Yii::$app->user->can('superuser'),
                    'items' => [
                        ['label' => 'Pesanan',         'url' => ['/pesan/report']],
                        // ['label' => 'Pengiriman',   'url' => ['/pengiriman/index']],
                        ['label' => 'Stok Barang',   'url' => ['/product/report']],
                        // ['label' => 'Costumer',         'url' => ['/karyawan/index']],
                        // ['label' => 'Employee',   'url' => ['/acf/permission']],
                        // ['label' => 'Supplier',        'url' => ['/supplier/index']],
                        // ['label' => 'Barang Masuk',         'url' => ['/masuk/index']],
                    ],
                ],
                ['label' => 'Slider', 'icon' => 'file-o', 'url' => ['/slider/index']],

                ['label' => 'User', 'icon' => 'user', 'url' => ['/user/index'],'visible' => Yii::$app->user->can('superuser')],
                ['label' => 'Log', 'icon' => 'clock-o', 'url' => ['/log/index'],'visible' => Yii::$app->user->can('superuser')],
            ];

            // $menuItems = mdm\admin\components\Helper::filter($menuItems);
        ?>
        <?php } else { ?>
            <?php 
            $menuItems = [
                ['label' => '<b>MENU</b>', 'encode' => false, 'options' => ['class' => 'header']],
                ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                ['label' => 'Lupa Password', 'url' => ['site/request-password-reset'], 'visible' => Yii::$app->user->isGuest],
            ];
            ?>
        <?php } ?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => $menuItems,
            ]
        ) ?>
        
        <!-- <ul class="sidebar-menu"><li><a href="<?= \yii\helpers\Url::to(['site/logout']) ?>" data-method="post"><i class="sign-out"></i>  <span>Logout</span></a></li></ul> -->
    
    </section>

</aside>

