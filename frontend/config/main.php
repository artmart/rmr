<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'name' => 'runmyreports.com',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-runmyreports',
            'baseUrl' => '',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-runmyreports', 'httpOnly' => false, /* 'lifetime' => 3600 * 24*/],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'runmyreports-frontend',
            'cookieParams' => [
                'httpOnly' => false,
                'path' => '/',
                //'domain' => '.runmyreports.com',
                'lifetime' => 3600 * 24,
            ],
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
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'page/<slug:[\w \-]+>' => 'site/page',
                'login'=>'site/login',
                'signup' => 'site/signup',
                'logout' => 'site/logout',
                '/' =>'params',
                
                '<controller:\w+>/<action:\w+>/<slug>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>/<id:\d+>/<slug>' => '<controller>/<action>',
            
            ],
        ],
        
    ],
    'params' => $params,
];
