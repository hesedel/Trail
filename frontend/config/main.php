<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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

        'assetManager' => [
            'bundles' => YII_ENV_PROD ?
                require(__DIR__ . '/assets-prod.php') :
                [
                    'yii\web\JqueryAsset' => [
                        'basePath' => '@webroot',
                        'baseUrl' => '@web',
                        'js' => [
                            'js/vendor/jquery-1.11.2.min.js',
                        ],
                    ],
                ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'rules' => [
                null => 'site/index',
                'blog' => 'site/blog',
            ],
            'showScriptName' => false,
            'suffix' => '/',
        ],
    ],
    'params' => $params,
];
