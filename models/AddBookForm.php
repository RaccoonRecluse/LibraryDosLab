<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class AddBookForm extends Model
{
    public $title;
    public $author;
    public $vendor_code;
    public $receipt_date;
    public $book_condition;


    private $_user = false;

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название книги',
            'author' => 'Автор',
            'receipt_date' => 'Дата поступления',
            'vendor_code' => 'Артикул',
            'book_condition' => 'Состояние книги',
        ];
    }
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['author', 'title', 'vendor_code', 'receipt_date', 'book_condition'], 'required', 'message' => 'Поле {attribute} не может быть пустым.'],
            [['title'], 'unique', 'targetClass' => '\app\models\Books', 'message' => 'Книга с таким названием уже существует.'],
            [['author', 'title'], 'string', 'min' => 4, 'tooShort' => '{attribute} не может содержать менее 4 символов.'],
            [['vendor_code'], 'integer', 'message' => 'Артикул должен содержать только цифры.'],
            [['author', 'title'], 'string', 'max' => 255, 'tooLong' => '{attribute} не может содержать более 255 символов.'],
        ];
    }

    public function addBook()
    {
        if (!$this->validate()) {
            return null;
        }
 
        $book = new Books();
        $book->title = $this->title;
        $book->author = $this->author;
        $book->receipt_date = $this->receipt_date;
        $book->vendor_code = $this->vendor_code;
        $book->book_condition = $this->book_condition;
        $book->availability = 1;

        return $book->save() ? $book : null;
    }

}
