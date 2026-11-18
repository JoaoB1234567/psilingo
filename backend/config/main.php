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
     * Protege todos os controladores do backend.
     */
    'as access' => [
        'class' => \yii\filters\AccessControl::class,

        /*
         * Não deixar estes módulos expostos em produção.
         * Se não forem utilizados, é preferível removê-los completamente.
         */
        'except' => [
            'gii/*',
            'debug/*',
        ],

        'rules' => [
            [
                /*
                 * O formulário de login e a página de erro são públicos.
                 */
                'controllers' => ['site'],
                'actions' => ['login', 'error'],
                'allow' => true,
            ],
            [
                /*
                 * Apenas utilizadores autenticados podem terminar sessão.
                 */
                'controllers' => ['site'],
                'actions' => ['logout'],
                'allow' => true,
                'roles' => ['@'],
            ],
            [
                /*
                 * Todas as restantes páginas exigem explicitamente
                 * a permissão accessBackend.
                 */
                'allow' => true,
                'roles' => ['accessBackend'],
            ],
        ],

        'denyCallback' => static function (): Response {
            /*
             * Visitante não autenticado:
             * o Yii envia-o para o login do backend.
             */
            if (Yii::$app->user->isGuest) {
                return Yii::$app->user->loginRequired();
            }

            /*
             * Utilizador autenticado, mas sem accessBackend:
             * termina a sessão específica do backend e volta ao frontend.
             */
            Yii::$app->user->logout();

            return Yii::$app->response->redirect(
                Yii::$app->params['frontendUrl']
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
                'secure' => true,
                'sameSite' => 'Lax',
            ],
        ],

        'session' => [
            'name' => 'advanced-backend',
            'cookieParams' => [
                'httpOnly' => true,
                'secure' => true,
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
