<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\AddWorkerForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
 
$this->title = 'Добавить клиента';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-add-worker">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Для добавления клиента заполните следующие поля:</p>
    <div class="row">
        <div class="col-lg-5">
 
            <?php $form = ActiveForm::begin(['id' => 'add-worker-form']); ?>
                <?= $form->field($model, 'name')->textInput(['autofocus' => true])->label('ФИО') ?>
                <?= $form->field($model, 'document_number')->label('Серия и номер паспорта') ?>
                <div class="form-group">
                    <?= Html::submitButton('Добавить клиента', ['class' => 'btn btn-primary', 'name' => 'add-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
 
        </div>
    </div>
</div>