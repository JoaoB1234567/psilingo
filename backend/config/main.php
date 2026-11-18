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

    /*
     * Proteção global de todas as páginas do backend.
     */
    'as access' => [
        'class' => \yii\filters\AccessControl::class,

        /*
         * Em produção, estes módulos devem estar desativados.
         */
        'except' => [
            'gii/*',
            'debug/*',
        ],

        'rules' => [
            [
                /*
                 * Login e página de erro são acessíveis sem autenticação.
                 */
                'controllers' => ['site'],
                'actions' => ['login', 'error'],
                'allow' => true,
            ],
            [
                /*
                 * Logout apenas para utilizadores autenticados.
                 */
                'controllers' => ['site'],
                'actions' => ['logout'],
                'allow' => true,
                'roles' => ['@'],
            ],
            [
                /*
                 * Todas as restantes páginas exigem accessBackend.
                 */
                'allow' => true,
                'roles' => ['accessBackend'],
            ],
        ],

        'denyCallback' => static function () {
            /*
             * Visitante: vai para o login do backend.
             */
            if (\Yii::$app->user->isGuest) {
                return \Yii::$app->user->loginRequired();
            }

            /*
             * Utilizador autenticado sem permissão:
             * termina a sessão do backend e volta ao frontend.
             */
            \Yii::$app->user->logout();

            return \Yii::$app->response->redirect(
                \Yii::$app->params['frontendUrl']
            );
        },
    ],

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

                /*
                 * Funciona em HTTP durante o desenvolvimento
                 * e ativa Secure automaticamente em HTTPS.
                 */
                'secure' => \Yii::$app->request->isSecureConnection,

                'sameSite' => 'Lax',
            ],
        ],

        'session' => [
            'name' => 'advanced-backend',

            'cookieParams' => [
                'httpOnly' => true,

                /*
                 * Em HTTP será false.
                 * Em HTTPS será true.
                 */
                'secure' => \Yii::$app->request->isSecureConnection,

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
