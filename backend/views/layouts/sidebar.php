<?php

use hail812\adminlte\widgets\Menu;
use yii\helpers\Html;

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= \yii\helpers\Url::home() ?>" class="brand-link">
        <span class="brand-text font-weight-light">PSILingo Back-Office</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">
                    <?= !Yii::$app->user->isGuest ? Html::encode(Yii::$app->user->identity->username) : 'Visitante' ?>
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?= Menu::widget([
                'items' => [
                    [
                        'label' => 'Dashboard',
                        'icon' => 'tachometer-alt',
                        'url' => ['/site/index'],
                    ],
                    [
                        'label' => 'Utilizadores',
                        'icon' => 'users',
                        'url' => ['/user/index'],
                        'visible' => Yii::$app->user->can('viewUsers'),
                    ],
                ],
            ]); ?>
        </nav>
    </div>
</aside>