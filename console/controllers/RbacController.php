<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\helpers\Console;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll(); // Limpa dados anteriores

        // 1. Criar permissões
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Criar um post';
        $auth->add($createPost);

        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Atualizar um post';
        $auth->add($updatePost);

        // 2. Criar Roles (Papéis)
        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $createPost);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $admin->addChild($admin, $updatePost);
        $admin->addChild($admin, $author);

        // 3. Atribuir roles a utilizadores (ajusta os IDs conforme a tua tabela user)
        $auth->assign($admin, 1);
        $auth->assign($author, 2);

        Console::output("RBAC inicializado com sucesso!");
    }
}