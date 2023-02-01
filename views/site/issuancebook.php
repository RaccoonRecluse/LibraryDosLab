<?php

use app\models\Conditions;
use Codeception\PHPUnit\ResultPrinter\HTML as ResultPrinterHTML;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */

$condition = Conditions::findOne(['id' => $book->book_condition]);

?>
<h1>Выдача книги</h1>
<div style="display: flex;justify-content:space-evenly;">
    <div style="width: 500px;">
        <h4>Информация о книге</h4>
        <!-- знаю что можно просто напрямую к переменной обращаться, но просто они уже стилизованы -->
        <?php $form = ActiveForm::begin(['id' => 'book-info']); ?>
        <?= $form->field($book, 'title')->textInput(['disabled' => true])->label('Название') ?>
        <?= $form->field($book, 'author')->textInput(['disabled' => true])->label('Автор') ?>
        <?= $form->field($book, 'receipt_date')->textInput(['disabled' => true])->label('Дата поступления') ?>
        <?= $form->field($condition, 'book_condition')->textInput(['disabled' => true])->label('Состояние') ?>
        <?php ActiveForm::end(); ?>
    </div>
    <div style="width: 500px;">
        <h4>Информация о клиенте</h4>
        <?php $form = ActiveForm::begin(['id' => 'search-client']); ?>
        <div style=" display: flex; align-items:end; justify-content:space-between;">
            <div><?= $form->field($search, 'document_number')->label('Поиск клиента по серии и номеру паспорта') ?></div>
            <div class="form-group">
                <?= Html::submitButton('Найти', ['class' => 'btn mb-3 btn-primary', 'name' => 'search-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <?php $form = ActiveForm::begin(['id' => 'search-client']); ?>
        <div><?= $form->field($client, 'name')->textInput(['readonly'=>true])->label('ФИО') ?></div>
        <div><?= $form->field($client, 'document_number')->textInput(['readonly'=>true])->label('Серия и номер паспорта') ?></div>
        <div><?= $form->field($issueBook, 'issuance_period')->input('date', ['value' => date('Y-m-d')])->label('Введите дату возврата книги') ?> </div>
        <?= Html::submitButton('Выдать книгу', ['class' => 'btn mb-3 btn-primary', 'name' => 'search-button']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<br>
<br>