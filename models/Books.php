<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string $title
 * @property int $vendor_code
 * @property string $author
 * @property string $receipt_date
 * @property int $availability
 * @property int $book_condition
 *
 * @property Conditions $bookCondition
 * @property IssuedBooks[] $issuedBooks
 * @property ReturnedBooks[] $returnedBooks
 */
class Books extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'vendor_code', 'author', 'receipt_date', 'availability', 'book_condition'], 'required'],
            [['vendor_code', 'availability', 'book_condition', 'id'], 'integer'],
            [['receipt_date'], 'safe'],
            [['title', 'author'], 'string', 'max' => 255],
            [['book_condition'], 'exist', 'skipOnError' => true, 'targetClass' => Conditions::class, 'targetAttribute' => ['book_condition' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'vendor_code' => 'Vendor Code',
            'author' => 'Author',
            'receipt_date' => 'Receipt Date',
            'availability' => 'Availability',
            'book_condition' => 'Book Condition',
        ];
    }

    /**
     * Gets query for [[BookCondition]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookCondition()
    {
        return $this->hasOne(Conditions::class, ['id' => 'book_condition']);
    }

    /**
     * Gets query for [[IssuedBooks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIssuedBooks()
    {
        return $this->hasMany(IssuedBooks::class, ['object' => 'id']);
    }

    /**
     * Gets query for [[ReturnedBooks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReturnedBooks()
    {
        return $this->hasMany(ReturnedBooks::class, ['book_id' => 'id']);
    }

    public static function getBookById($id){
        return Books::findOne($id);
    }


}
