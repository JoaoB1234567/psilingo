<?php

declare(strict_types=1);

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ErrorAction;
use yii\web\Response;

class SiteController extends Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,

                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['accessBackend'],
                    ],
                ],
            ],

            'verbs' => [
                'class' => VerbFilter::class,

                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions(): array
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
        ];
    }

    public function actionIndex(): string
    {
        return $this->render('index');
    }

    public function actionLogin(): string|Response
    {
        /*
         * Se já existir uma sessão no backend:
         * - administrador: permanece no backend;
         * - utilizador comum: é enviado para o frontend.
         */
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->can('accessBackend')) {
                return $this->goHome();
            }

            Yii::$app->user->logout();

            return $this->redirect(
                Yii::$app->params['frontendUrl']
            );
        }

        $this->layout = 'blank';
        $model = new LoginForm();

        if (
            $model->load(Yii::$app->request->post())
            && $model->login()
        ) {
            /*
             * Login válido não significa acesso ao backend.
             */
            if (!Yii::$app->user->can('accessBackend')) {
                Yii::$app->user->logout();

                return $this->redirect(
                    Yii::$app->params['frontendUrl']
                );
            }

            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout(): Response
    {
        Yii::$app->user->logout();

        return $this->redirect(
            Yii::$app->params['frontendUrl']
        );
    }
}
