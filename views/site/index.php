<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */



?>
<?php $form = ActiveForm::begin(['id' => 'search-book-form']); ?>
<div style=" display: flex; align-items:end; gap:50px; margin-bottom:50px;justify-content:center;">
    <div style="width: 500px;"><?= $form->field($model, 'title')->label('Поиск по названию книги') ?></div>

    <?= $form->field($model, 'availability')->label('Только доступные')->checkbox([
        'template' => "<div  class=\"  custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
    ]) ?>
    <div class="form-group offset-lg-1">
        <?= Html::submitButton('Найти', ['class' => 'btn mb-3 btn-primary', 'name' => 'search-button']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>


<?php if (!$books) { ?>
    <h1 style="text-align: center;">Ничего не найдено</h1>
<?php } else { ?>


    <table style="margin: auto;">
        <tr>
            <th class="tabletd">Название</th>
            <th class="tabletd">Автор</th>
            <th class="tabletd">Дата поступления</th>
            <th class="tabletd">Состояние</th>
            <th class="tabletd">Доступность</th>

        </tr>
        <?php foreach ($books as $key => $book) { ?>
            <tr>
                <td class="tabletd"><?= $book->title ?></td>
                <td class="tabletd"><?= $book->author ?></td>
                <td class="tabletd"><?= $book->receipt_date ?></td>
                <td class="tabletd"><?= $book->bookCondition->book_condition ?></td>
                <?php if ($book->availability) { ?>
                    <td class="tabletd" style="color: rgb(31, 224, 31)">Доступно к выдаче</td>

                    <td class="tabletd">
                    <?php $form = ActiveForm::begin(['id' => 'search-book-form']); ?>
                        <div style="display: none;"><?=$form->field($issue_id, 'id')->input('text', ['value'=>$book->id])?></div>
                        <div class="form-group offset-lg-1">
                            <?= Html::submitButton('Выдать книгу', ['class' => 'btn mb-3 btn-primary', 'name' => 'search-button']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                    </td>

                <?php } else { ?>
                    <td class="tabletd" style="color: red">Занято</td>
                    <td class="tabletd">
                    <?php $form = ActiveForm::begin(['id' => 'search-book-form']); ?>
                        <div style="display: none;"><?=$form->field($return_id, 'id')->input('text', ['value'=>$book->id])?></div>
                        <div class="form-group offset-lg-1">
                            <?= Html::submitButton('Вернуть книгу', ['class' => 'btn mb-3 btn-primary', 'name' => 'search-button']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>

    </table>
<?php } ?>

<script>

</script>