<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username; ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->

        <?=
        dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => 'Người dùng', 'icon' => 'fa fa-file-code-o', 'url' => ['/users'], 'visible' => Yii::$app->user->can('manageUser'),
                            'items' => [
                                ['label' => 'Tất cả', 'icon' => 'fa fa-user', 'url' => ['/users']],
                            ],
                        ],
                        ['label' => 'Bài viết', 'icon' => 'fa fa-dashboard', 'url' => '#', 'visible' => Yii::$app->user->can('managePost'),
                            'items' => [
                                ['label' => 'Tạo bài viết', 'icon' => 'fa fa-plus', 'url' => ['/posts/default/create']],
                                ['label' => 'Tất cả', 'icon' => 'fa fa-pencil-square-o ', 'url' => ['/posts']],
                                ['label' => 'Trang', 'icon' => 'fa fa-file-text-o', 'url' => '#',
                                    'items' => [
                                        ['label' => 'Tất cả', 'icon' => 'fa fa-file-text-o', 'url' => ['/posts/default/','type'=>'page']],
                                        ['label' => 'Tạo mới', 'icon' => 'fa fa-file-text-o', 'url' => ['/posts/default/create', 'type' => 'page']],
                                    ]
                                ],
                                ['label' => 'Danh mục', 'icon' => 'fa fa-sitemap', 'url' => ['/posts/category']],
                                ['label' => 'Tags', 'icon' => 'fa fa-tags', 'url' => ['/posts/tags']],
                            ],
                        ],
                        ['label' => 'Bất động sản', 'icon' => 'fa fa-line-chart', 'url' => '#', 'visible' => Yii::$app->user->can('managePost'),
                            'items' => [
                                ['label' => 'Tạo thêm', 'icon' => 'fa fa-plus', 'url' => ['/batdongsan/default/create'], 'visible' => Yii::$app->user->can('managePost')],
                                ['label' => 'Tất cả', 'icon' => 'fa fa-pencil-square-o', 'url' => ['/batdongsan'], 'visible' => Yii::$app->user->can('managePost')],
                                ['label' => 'Dự án', 'icon' => 'fa fa-file-text-o', 'url' => ['/batdongsan/duan'], 'visible' => Yii::$app->user->can('managePost'),
                                    'items' => [
                                        ['label' => 'Tất cả', 'icon' => 'fa fa-pencil-square-o', 'url' => ['/batdongsan/duan/'], 'visible' => Yii::$app->user->can('managePost')],
                                        ['label' => 'Tạo thêm', 'icon' => 'fa fa-plus', 'url' => ['/batdongsan/duan/create'], 'visible' => Yii::$app->user->can('managePost')],
                                    ]
                                ],
                                ['label' => 'Chủ đầu tư', 'icon' => 'fa fa-life-ring', 'url' => ['/batdongsan/chudautu'], 'visible' => Yii::$app->user->can('managePost')],
                                ['label' => 'Danh mục', 'icon' => 'fa fa-sitemap', 'url' => ['/posts/category','type'=>'batdongsan']],
                                ['label' => 'Tags', 'icon' => 'fa fa-tags', 'url' => ['/posts/tags']],
                            ],
                        ],
                        ['label' => 'Hình ảnh', 'icon' => 'fa fa-image', 'url' => ['/posts/images/'], 'visible' => Yii::$app->user->can('managePost')],
                        ['label' => 'Cấu hình', 'icon' => 'fa fa-file-text-o', 'url' => ['/config/'], 'active' => \Yii::$app->controller->module->id == "config", 'visible' => Yii::$app->user->can('manageAll'),
                            'items' => [
                                ['label' => 'Tổng quan', 'icon' => 'fa fa-dashboard fa-fw', 'url' => ['/config/configapp/']],
                                ['label' => 'Phí đăng tin', 'icon' => 'fa fa-ship', 'url' => ['/config/fee/']],
                                ['label' => 'Thuộc tính', 'icon' => 'fa fa-image', 'url' => ['/config/trangthai/']],
                                ['label' => 'Menu', 'icon' => 'fa fa-image', 'url' => ['/config/menu/']],
                                ['label' => 'Banner', 'icon' => 'fa fa-image', 'url' => ['/config/banner/']],
                            ]
                        ],
                        [
                            'label' => 'Công cụ',
                            'icon' => 'fa fa-share',
                            'url' => '#',
                            'visible' => Yii::$app->user->can('manageAll'),
                            'items' => [
                                ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii'],],
                                ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                                ['label' => 'BackUp', 'icon' => 'fa fa-dashboard', 'url' => ['/backup'], 'visable'],
                            ],
                        ],
                    ],
                ]
        )
        ?>

    </section>

</aside>
