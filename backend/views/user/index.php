<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Utilizadores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= Html::a('Criar Utilizador', ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => ['class' => 'table table-hover align-middle mb-0'],
                'layout' => "{items}\n<div class='d-flex justify-content-between align-items-center p-3 border-top'><div>{pager}</div><div class='text-muted small'>{summary}</div></div>",
                'summary' => 'A apresentar <b>{begin}-{end}</b> de <b>{totalCount}</b> registos.',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' => 'username',
                        'label' => 'Utilizador',
                    ],
                    [
                        'attribute' => 'email',
                        'format' => 'email',
                    ],
                    [
                        'attribute' => 'status',
                        'label' => 'Estado',
                        'format' => 'raw',
                        // Filtro dropdown como na segunda imagem
                        'filter' => [
                            User::STATUS_ACTIVE => 'Ativo',
                            User::STATUS_INACTIVE => 'Inativo',
                        ],
                        'value' => function (User $model) {
                            if ($model->status === User::STATUS_ACTIVE) {
                                return Html::tag('span', 'Ativo', ['class' => 'badge bg-success']);
                            }
                            return Html::tag('span', 'Inativo', ['class' => 'badge bg-warning text-dark']);
                        },
                    ],
                    [
                        'label' => 'Perfis (RBAC)',
                        'format' => 'raw',
                        'value' => function (User $model) {
                            $roles = Yii::$app->authManager->getRolesByUser($model->id);
                            if (empty($roles)) {
                                return Html::tag('span', 'Sem perfil', ['class' => 'badge bg-secondary']);
                            }

                            $badges = [];
                            foreach ($roles as $role) {
                                $cor = $role->name === 'admin' ? 'bg-danger' : 'bg-primary';
                                $badges[] = Html::tag('span', Html::encode($role->name), ['class' => "badge {$cor} me-1"]);
                            }
                            return implode(' ', $badges);
                        },
                    ],
                    [
                        'attribute' => 'created_at',
                        'label' => 'Criado em',
                        'format' => ['date', 'php:d/m/Y'],
                    ],
                    [
                        'class' => ActionColumn::class,
                        'header' => 'Ações',
                        'headerOptions' => ['class' => 'text-primary'],
                        'template' => '{view} {update} {toggle-status}',
                        'buttons' => [
                            'toggle-status' => function ($url, User $model, $key) {
                                if ($model->status === User::STATUS_ACTIVE) {
                                    return Html::a(
                                        '<i class="fas fa-pause-circle text-warning"></i>',
                                        ['toggle-status', 'id' => $model->id],
                                        [
                                            'title' => 'Desativar utilizador',
                                            'data-confirm' => 'Tens a certeza que queres desativar este utilizador?',
                                            'data-method' => 'post',
                                        ]
                                    );
                                }
                                return Html::a(
                                    '<i class="fas fa-play-circle text-success"></i>',
                                    ['toggle-status', 'id' => $model->id],
                                    [
                                        'title' => 'Ativar utilizador',
                                        'data-confirm' => 'Tens a certeza que queres ativar este utilizador?',
                                        'data-method' => 'post',
                                    ]
                                );
                            },
                        ],
                        'urlCreator' => function ($action, User $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>
        </div>
    </div>

</div>