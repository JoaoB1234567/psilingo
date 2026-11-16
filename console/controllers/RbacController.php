<?php

namespace console\controllers;

use yii\console\Controller;
use yii\helpers\Console;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = \Yii::$app->authManager;

        // Limpa todos os dados anteriores do RBAC
        $auth->removeAll();

        // ==========================================
        // 1. CRIAR PERMISSÕES GRANULARES (CRUD SEPARADO)
        // ==========================================

        // --- Acesso ao Back-Office ---
        $accessBackend = $auth->createPermission('accessBackend');
        $accessBackend->description = 'Acesso ao painel de administração (Back-Office)';
        $auth->add($accessBackend);

        // --- CRUD Utilizadores (Sys Admin - Back-Office + Soft Delete) ---
        $createUser = $auth->createPermission('createUser');
        $createUser->description = 'Criar utilizadores no back-office';
        $auth->add($createUser);

        $viewUsers = $auth->createPermission('viewUsers');
        $viewUsers->description = 'Listar e pesquisar utilizadores (RF-BO-07)';
        $auth->add($viewUsers);

        $updateUser = $auth->createPermission('updateUser');
        $updateUser->description = 'Editar utilizadores e atribuir roles (RF-BO-02)';
        $auth->add($updateUser);

        $deleteUser = $auth->createPermission('deleteUser');
        $deleteUser->description = 'Desativar/Ativar utilizadores (Soft Delete)';
        $auth->add($deleteUser);

        // --- CRUD Cursos / Línguas (RF-BO-03, RF-BO-04, RF-BO-05) ---
        $createCourse = $auth->createPermission('createCourse');
        $createCourse->description = 'Criar cursos/línguas';
        $auth->add($createCourse);

        $viewCourses = $auth->createPermission('viewCourses');
        $viewCourses->description = 'Visualizar cursos/línguas (RF-FO-01, RF-FO-02)';
        $auth->add($viewCourses);

        $updateCourse = $auth->createPermission('updateCourse');
        $updateCourse->description = 'Editar cursos/línguas';
        $auth->add($updateCourse);

        $deleteCourse = $auth->createPermission('deleteCourse');
        $deleteCourse->description = 'Remover cursos/línguas';
        $auth->add($deleteCourse);

        // --- CRUD Temas e Níveis ---
        $createTheme = $auth->createPermission('createTheme');
        $createTheme->description = 'Criar temas e níveis';
        $auth->add($createTheme);

        $viewThemes = $auth->createPermission('viewThemes');
        $viewThemes->description = 'Visualizar temas e níveis dos cursos';
        $auth->add($viewThemes);

        $updateTheme = $auth->createPermission('updateTheme');
        $updateTheme->description = 'Editar temas e níveis';
        $auth->add($updateTheme);

        $deleteTheme = $auth->createPermission('deleteTheme');
        $deleteTheme->description = 'Remover temas e níveis';
        $auth->add($deleteTheme);

        // --- CRUD Perguntas e Respostas / Exercícios (RF-BO-06) ---
        $createExercise = $auth->createPermission('createExercise');
        $createExercise->description = 'Adicionar perguntas e respostas';
        $auth->add($createExercise);

        $viewExercises = $auth->createPermission('viewExercises');
        $viewExercises->description = 'Visualizar perguntas e respostas';
        $auth->add($viewExercises);

        $updateExercise = $auth->createPermission('updateExercise');
        $updateExercise->description = 'Editar perguntas e respostas';
        $auth->add($updateExercise);

        $deleteExercise = $auth->createPermission('deleteExercise');
        $deleteExercise->description = 'Eliminar perguntas e respostas';
        $auth->add($deleteExercise);

        // --- Revisão de Conteúdos / Histórico Global (Administrador de Cursos) ---
        $reviewContent = $auth->createPermission('reviewContent');
        $reviewContent->description = 'Consultar histórico global de exercícios realizados e rever conteúdos';
        $auth->add($reviewContent);

        // --- Permissões Exclusivas do Cliente Autenticado (Front-Office / App Mobile) ---
        $enrollCourse = $auth->createPermission('enrollCourse');
        $enrollCourse->description = 'Inscrever-se num curso/língua (lingua_has_utilizador)';
        $auth->add($enrollCourse);

        $solveExercises = $auth->createPermission('solveExercises');
        $solveExercises->description = 'Aceder aos conteúdos dos cursos inscritos e resolver exercícios (RF-FO-03, RF-FO-05)';
        $auth->add($solveExercises);

        $viewOwnProgress = $auth->createPermission('viewOwnProgress');
        $viewOwnProgress->description = 'Consultar progresso, histórico e estatísticas pessoais (RF-FO-06, RF-FO-07, RF-AM-03)';
        $auth->add($viewOwnProgress);

        $manageOwnProfile = $auth->createPermission('manageOwnProfile');
        $manageOwnProfile->description = 'Visualizar e editar o próprio perfil (RF-FO-04, RF-AM-05)';
        $auth->add($manageOwnProfile);


        // ==========================================
        // 2. CRIAR ROLES (Papéis - Tabela 5)
        // ==========================================

        $clienteAutenticado = $auth->createRole('clienteAutenticado');
        $clienteAutenticado->description = 'Cliente autenticado (Front-office e App mobile)';
        $auth->add($clienteAutenticado);

        $gestorCursos = $auth->createRole('gestorCursos');
        $gestorCursos->description = 'Administrador de Cursos (Back-office)';
        $auth->add($gestorCursos);

        $sysAdmin = $auth->createRole('sysAdmin');
        $sysAdmin->description = 'Sys Admin (Gestão total do Back-office)';
        $auth->add($sysAdmin);


        // ==========================================
        // 3. ESTABELECER HIERARQUIAS (addChild)
        // ==========================================

        // --- Cliente Autenticado ---
        $auth->addChild($clienteAutenticado, $viewCourses);
        $auth->addChild($clienteAutenticado, $viewThemes);
        $auth->addChild($clienteAutenticado, $enrollCourse);
        $auth->addChild($clienteAutenticado, $solveExercises);
        $auth->addChild($clienteAutenticado, $viewOwnProgress);
        $auth->addChild($clienteAutenticado, $manageOwnProfile);

        // --- Administrador de Cursos ---
        $auth->addChild($gestorCursos, $accessBackend);
        // CRUD Cursos
        $auth->addChild($gestorCursos, $createCourse);
        $auth->addChild($gestorCursos, $viewCourses);
        $auth->addChild($gestorCursos, $updateCourse);
        $auth->addChild($gestorCursos, $deleteCourse);
        // CRUD Temas/Níveis
        $auth->addChild($gestorCursos, $createTheme);
        $auth->addChild($gestorCursos, $viewThemes);
        $auth->addChild($gestorCursos, $updateTheme);
        $auth->addChild($gestorCursos, $deleteTheme);
        // CRUD Exercícios (Perguntas/Respostas)
        $auth->addChild($gestorCursos, $createExercise);
        $auth->addChild($gestorCursos, $viewExercises);
        $auth->addChild($gestorCursos, $updateExercise);
        $auth->addChild($gestorCursos, $deleteExercise);
        // Revisão de conteúdos / histórico
        $auth->addChild($gestorCursos, $reviewContent);

        // --- Sys Admin (CRUD Utilizadores + Herda Administrador de Cursos) ---
        $auth->addChild($sysAdmin, $createUser);
        $auth->addChild($sysAdmin, $viewUsers);
        $auth->addChild($sysAdmin, $updateUser);
        $auth->addChild($sysAdmin, $deleteUser);
        $auth->addChild($sysAdmin, $gestorCursos);

        Console::output("RBAC inicializado com sucesso para o PSILingo!");
    }
}