<?php

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute' => 'home',
    'modules' => [
        'home' => [
            'class' => 'frontend\modules\home\HomeModule',
        ],
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\Member',
            'enableAutoLogin' => true,
            'loginUrl'=>['/home/member/login']
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'view' => [
            'theme' => [
                'basePath' => '@frontend/views/layouts/bdshd',
                'pathMap' => [
                    '@app/views' => '@frontend/views/layouts/bdshd'
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'dang-ky'=>'home/member/register',
                'dang-tin'=>'home/batdongsan/create',
                '<slug>/<page:\d+>' => 'home/category/post',
                '<slug>' => 'home/category/post',
                '<slug:\w+>' => 'site/demo',

            ],
        ],
    ],
    'params' => $params,
];
