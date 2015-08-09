<?php
/**
 * Configuration file for the "yii asset" console command.
 */

// In the console environment, some path aliases may not exist. Please define these:
Yii::setAlias('@webroot', __DIR__ . '/web');
Yii::setAlias('@web', '/');

return [
    // Adjust command/callback for JavaScript files compressing:
    'jsCompressor' => 'juicer merge -o {to} -m closure_compiler -f -s -t js {from}',
    // Adjust command/callback for CSS files compressing:
    'cssCompressor' => 'juicer merge -o {to} -m yui_compressor -f -s -t css -b -d frontend/web/css -c none {from}',
    // The list of asset bundles to compress:
    'bundles' => [
        //'app\assets\AppAsset',
        //'yii\web\YiiAsset',
        //'yii\web\JqueryAsset',
        'frontend\assets\AppAsset',
        'frontend\assets\AppAsset2',
    ],
    // Asset bundle for compression output:
    'targets' => [
        'all' => [
            'class' => 'yii\web\AssetBundle',
            'basePath' => '@webroot/assets',
            'baseUrl' => '@web/assets',
            'js' => 'all-{hash}.js',
            'css' => 'all-{hash}.css',
        ],
    ],
    // Asset manager configuration:
    'assetManager' => [
        'basePath' => '@webroot/assets',
        'baseUrl' => '@web/assets',
        'bundles' => [
            'yii\web\JqueryAsset' => [
                'basePath' => '@webroot',
                'baseUrl' => '@web',
                'js' => [
                    'js/vendor/jquery-1.11.2.min.js',
                ],
            ],
        ],
    ],
];