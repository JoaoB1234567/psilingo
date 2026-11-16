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
    'layout' => 'adminlte', // Usa o backend/views/layouts/adminlte.php
    'modules' => [],

    // ACF global: protege TODOS os controladores do backend (incluindo os gerados pelo Gii)
    'as access' => [
        'class' => \yii\filters\AccessControl::class,
        'except' => ['gii/*', 'debug/*'], // módulos de desenvolvimento
        'rules' => [
            [
                // Login e página de erro: qualquer pessoa
                'controllers' => ['site'],
                'actions' => ['login', 'error'],
                'allow' => true,
            ],
            [
                // Logout: qualquer utilizador autenticado
                'controllers' => ['site'],
                'actions' => ['logout'],
                'allow' => true,
                'roles' => ['@'],
            ],
            [
                // Todo o resto: só quem tem acesso ao back-office
                // (clienteAutenticado não tem esta permissão)
                'allow' => true,
                'roles' => ['accessBackend'],
            ],
        ],
        'denyCallback' => function ($rule, $action) {
            if (\Yii::$app->user->isGuest) {
                // Visitante -> login do backend
                return \Yii::$app->user->loginRequired();
            }
            // Autenticado sem permissão (cliente) -> index do front-office
            return \Yii::$app->response->redirect(\Yii::$app->params['frontendUrl']);
        },
    ],

    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => \common\models\User::class,
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
            'rules' => [
            ],
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => [
                        '@app/views', // Procura primeiro nas vistas locais (ex: sidebar.php)
                        '@vendor/hail812/yii2-adminlte3/src/views', // Se não existir localmente, usa o do vendor
                    ],
                ],
            ],
        ],
    ],
    'params' => $params,
];
