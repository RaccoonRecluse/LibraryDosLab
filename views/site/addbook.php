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



$this->title = 'Добавить книгу';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="site-add-book">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Для добавления книги заполните следующие поля:</p>
    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'add-book-form']); ?>
            <?= $form->field($model, 'title')->textInput(['autofocus' => true])->label('Название') ?>
            <?= $form->field($model, 'author')->label('Автор') ?>
            <?= $form->field($model, 'vendor_code')->label('Артикул') ?>
            <?= $form->field($model, 'receipt_date')->input('date')?>
            <?= $form->field($model, 'book_condition')->dropDownList($items, $params)->label('Состояние') ?>

            <div class="form-group">
                <?= Html::submitButton('Добавить книгу', ['class' => 'btn btn-primary', 'name' => 'add-book-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>