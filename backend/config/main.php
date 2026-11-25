<?php

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'layout' => 'adminlte',
    'modules' => [],

    // ACF global: protege TODOS os controladores do backend (incluindo os gerados pelo Gii)
    /*'as access' => [
    'as access' => [
        'class' => \yii\filters\AccessControl::class,

        'except' => [
            'gii/*',
            'debug/*',
        ],

        'rules' => [
            [
                'controllers' => ['site'],
                'actions' => ['login', 'error'],
                'allow' => true,
            ],
            [
                'controllers' => ['site'],
                'actions' => ['logout'],
                'allow' => true,
                'roles' => ['@'],
            ],
            [
                'allow' => true,
                'roles' => ['accessBackend'],
            ],
        ],

        'denyCallback' => static function () {
            if (\Yii::$app->user->isGuest) {
                return \Yii::$app->user->loginRequired();
            }

            \Yii::$app->user->logout();

            return \Yii::$app->response->redirect(
                \Yii::$app->params['frontendUrl']
            );
        },
    ],*/

    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],

        'user' => [
            'identityClass' => \common\models\User::class,
            'enableAutoLogin' => true,

            'identityCookie' => [
                'name' => '_identity-backend',
                'httpOnly' => true,
                'secure' => false,
                'sameSite' => 'Lax',
            ],
        ],

        'session' => [
            'name' => 'advanced-backend',

            'cookieParams' => [
                'httpOnly' => true,
                'secure' => false,
                'sameSite' => 'Lax',
            ],
        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,

            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
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
            'rules' => [],
        ],

        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => [
                        '@app/views',
                        '@vendor/hail812/yii2-adminlte3/src/views',
                    ],
                ],
            ],
        ],
    ],

    'params' => $params,
];
