<?php

use Codeception\PHPUnit\ResultPrinter\HTML as ResultPrinterHTML;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
/** @var yii\web\View $this */
?>

<table style="margin: auto;">
    <tr>
        <th class="tabletd">Название</th>
        <th class="tabletd">Автор</th>
        <th class="tabletd">Дата поступления</th>
        <th class="tabletd">Состояние</th>
        <th class="tabletd">Доступность</th>

    </tr>
    <tr>
        <td class="tabletd"><?= $book->title ?></td>
        <td class="tabletd"><?= $book->author ?></td>
        <td class="tabletd"><?= $book->receipt_date ?></td>
        <td class="tabletd"><?= $book->bookCondition->book_condition ?></td>
        <?php if ($book->availability) { ?>
            <td class="tabletd" style="color: rgb(31, 224, 31)">Доступно к выдаче</td>
        <?php } else { ?>
            <td class="tabletd" style="color: red">Занято</td>
        <?php } ?>
    </tr>
</table>
<br>
<br>
<div style="display: flex;">
    <div>
        <?php $form = ActiveForm::begin(['id' => 'search-client']); ?>
        <div style=" display: flex; align-items:end; gap:50px; margin-bottom:50px;justify-content:center;">
            <div style="width: 500px;"><?= $form->field($searchClient, 'document_number')->label('Поиск клиента по серии и номеру паспорта') ?></div>
            <div class="form-group offset-lg-1">
                <?= Html::submitButton('Найти', ['class' => 'btn mb-3 btn-primary', 'name' => 'search-button']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
        <br>
        <?php $form = ActiveForm::begin(['id' => 'search-client']); ?>
        <div style=" display: flex; align-items:end; gap:50px; margin-bottom:50px;justify-content:center;">
        <div style="width: 500px;"><?= $form->field($issueBook, 'issuance_period')->input('date', ['value'=>date('Y-m-d')])->label('Введите дату возврата книги') ?></div>
            <?= Html::submitButton('Выдать книгу', ['class' => 'btn mb-3 btn-primary', 'name' => 'search-button']) ?>
        </div>
    </div>

    <br>
    <table style="margin: auto;">
        <tr>
            <th class="tabletd">ФИО</th>
            <th class="tabletd">Серия и номер паспорта</th>
        </tr>
        <?php foreach ($clients as $key => $client) { ?>
            <tr>

                <td class="tabletd"><label for="<?= $client->id ?>"><?= $client->name ?></label></td>
                <td class="tabletd"><label for="<?= $client->id ?>"><?= $client->document_number ?></label></td>


                <td class="tabletd checkbox-client"><?= $form->field($issueBook, 'subject')->radio(['id' => $client->id, 'value' => $client->id, 'uncheck' => null])->label('') ?></td>
            </tr>
        <?php } ?>

    </table>
    <?php ActiveForm::end(); ?>
</div>