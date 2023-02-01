<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\AddWorkerForm $model */

use app\models\Conditions;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;

$conditions = Conditions::find()->all();
$items = ArrayHelper::map($conditions, 'id', 'book_condition');
$params = [
    'prompt' => 'Укажите состояние книги'
];
$conditionsBefore = Conditions::findOne(['id'=>$model->book_condition]);

$this->title = 'Принять книгу';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="site-add-book">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Для принятия книги заполните следующие поля:</p>
    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'add-book-form']); ?>
            <?= $form->field($model, 'title')->textInput(['autofocus' => true ,'disabled'=>true])->label('Название') ?>
            <?= $form->field($client, 'name')->textInput(['autofocus' => true ,'disabled'=>true])->label('ФИО клиента') ?>
            <?= $form->field($client, 'document_number')->textInput(['autofocus' => true ,'disabled'=>true])->label('Серия и номер паспорта') ?>
            <?= $form->field($conditionsBefore, 'book_condition')->textInput(['disabled'=>true])->label('Состояние при выдаче') ?>
            <?= $form->field($returnedBook, 'book_condition')->dropDownList($items, $params)->label('Состояние ныне') ?>

            <div class="form-group">
                <?= Html::submitButton('Принять книгу', ['class' => 'btn btn-primary', 'name' => 'add-book-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>