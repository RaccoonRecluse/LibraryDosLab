<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\AddWorkerForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
 
$this->title = 'Добавить сотрудника';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-add-worker">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Для добавления сотрудника заполните следующие поля:</p>
    <div class="row">
        <div class="col-lg-5">
 
            <?php $form = ActiveForm::begin(['id' => 'add-worker-form']); ?>
                <?= $form->field($model, 'name')->textInput(['autofocus' => true])->label('ФИО') ?>
                <?= $form->field($model, 'login')->label('Логин') ?>
                <?= $form->field($model, 'position')->label('Должность') ?>
                <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>
                <div class="form-group">
                    <?= Html::submitButton('Добавить сотрудника', ['class' => 'btn btn-primary', 'name' => 'add-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
 
        </div>
    </div>
</div>