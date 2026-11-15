<?php

namespace console\controllers;

use yii\console\Controller;
use yii\helpers\Console; // <-- O 'use' fica sempre no topo do ficheiro

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = \Yii::$app->authManager;

        // Limpa todos os dados anteriores do RBAC (cuidado em produção!)
        $auth->removeAll();

        // ==========================================
        // 1. CRIAR PERMISSÕES GRANULARES (Actions)
        // ==========================================

        // Permissões de Sys Admin (Utilizadores)
        $manageUsers = $auth->createPermission('manageUsers');
        $manageUsers->description = 'Gestão de utilizadores no back-office';
        $auth->add($manageUsers);

        $deleteUser = $auth->createPermission('deleteUser');
        $deleteUser->description = 'Remoção de utilizadores';
        $auth->add($deleteUser);

        // Permissões de Cursos / Conteúdos (Administrador de Cursos)
        $manageCourses = $auth->createPermission('manageCourses');
        $manageCourses->description = 'Gerir administrador de cursos / Criar e remover cursos';
        $auth->add($manageCourses);

        $reviewContent = $auth->createPermission('reviewContent');
        $reviewContent->description = 'Revisão dos conteúdos';
        $auth->add($reviewContent);

        $editWords = $auth->createPermission('editWords');
        $editWords->description = 'Edição de palavras';
        $auth->add($editWords);

        $editQuestions = $auth->createPermission('editQuestions');
        $editQuestions->description = 'Edição de questões';
        $auth->add($editQuestions);

        $deleteCourse = $auth->createPermission('deleteCourse');
        $deleteCourse->description = 'Remoção de cursos';
        $auth->add($deleteCourse);

        // Permissões de Cliente / Front-office / App Mobile
        $viewCourses = $auth->createPermission('viewCourses');
        $viewCourses->description = 'Visualização de cursos';
        $auth->add($viewCourses);

        $viewCourseThemes = $auth->createPermission('viewCourseThemes');
        $viewCourseThemes->description = 'Visualização dos temas dos cursos';
        $auth->add($viewCourseThemes);

        $accessCourseContent = $auth->createPermission('accessCourseContent');
        $accessCourseContent->description = 'Acesso aos conteúdos do curso';
        $auth->add($accessCourseContent);


        // ==========================================
        // 2. CRIAR ROLES (Papéis)
        // ==========================================

        // Role: Cliente Autenticado
        $clienteAutenticado = $auth->createRole('clienteAutenticado');
        $clienteAutenticado->description = 'Cliente autenticado (Front-office e App mobile)';
        $auth->add($clienteAutenticado);

        // Role: Administrador de Cursos
        $gestorCursos = $auth->createRole('gestorCursos');
        $gestorCursos->description = 'Administrador de Cursos';
        $auth->add($gestorCursos);

        // Role: Sys Admin
        $sysAdmin = $auth->createRole('sysAdmin');
        $sysAdmin->description = 'Sys Admin (Gestão total do BackOffice)';
        $auth->add($sysAdmin);


        // ==========================================
        // 3. ESTABELECER HIERARQUIAS (addChild)
        // ==========================================

        // --- Cliente Autenticado herda permissões de visualização ---
        $auth->addChild($clienteAutenticado, $viewCourses);
        $auth->addChild($clienteAutenticado, $viewCourseThemes);
        $auth->addChild($clienteAutenticado, $accessCourseContent);

        // --- Administrador de Cursos herda as suas permissões específicas ---
        $auth->addChild($gestorCursos, $manageCourses);
        $auth->addChild($gestorCursos, $reviewContent);
        $auth->addChild($gestorCursos, $editWords);
        $auth->addChild($gestorCursos, $editQuestions);
        $auth->addChild($gestorCursos, $deleteCourse);

        // --- Sys Admin herda a gestão de utilizadores e absorve também o papel de Administrador de Cursos ---
        $auth->addChild($sysAdmin, $manageUsers);
        $auth->addChild($sysAdmin, $deleteUser);
        $auth->addChild($sysAdmin, $gestorCursos); // Sys Admin herda privilégios do gestor de cursos


        // ==========================================
        // 4. ATRIBUIÇÕES DE TESTE (Opcional)
        // ==========================================
        // $auth->assign($sysAdmin, 1);
        // $auth->assign($clienteAutenticado, 2);

        // Mensagem de sucesso no fim do método
        Console::output("RBAC inicializado com sucesso para o psilingo!");
    }
}