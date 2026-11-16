<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php if ($model->isNewRecord): ?>
        <div class="form-group">
            <label class="control-label" for="user-password">Password</label>
            <?= Html::passwordInput('password', '', ['class' => 'form-control', 'id' => 'user-password', 'required' => true]) ?>
        </div>
    <?php endif; ?>

    <?= $form->field($model, 'status')->dropDownList([
        10 => 'Ativo',
        9 => 'Inativo (Soft Delete)',
    ]) ?>

    <div class="form-group">
        <label class="control-label" for="user-role">Papel (Role RBAC)</label>
        <?= Html::dropDownList('role', $currentRole ?? 'clienteAutenticado', [
            'clienteAutenticado' => 'Cliente Autenticado',
            'gestorCursos' => 'Administrador de Cursos',
            'sysAdmin' => 'Sys Admin',
        ], ['class' => 'form-control', 'id' => 'user-role']) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>