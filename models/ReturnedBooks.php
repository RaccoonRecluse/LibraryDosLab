<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "returned_books".
 *
 * @property int $id
 * @property int $book_id
 * @property int $client_id
 * @property int $staff_id
 * @property string $return_date
 * @property string $book_condition
 *
 * @property Books $book
 * @property Clients $client
 * @property Staff $staff
 */
class ReturnedBooks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'returned_books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_id', 'client_id', 'staff_id', 'return_date', 'book_condition'], 'required'],
            [['book_id', 'client_id', 'staff_id'], 'integer'],
            [['return_date'], 'safe'],
            [['book_condition'], 'string', 'max' => 255],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Books::class, 'targetAttribute' => ['book_id' => 'id']],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::class, 'targetAttribute' => ['client_id' => 'id']],
            [['staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['staff_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_id' => 'Book ID',
            'client_id' => 'Client ID',
            'staff_id' => 'Staff ID',
            'return_date' => 'Return Date',
            'book_condition' => 'Book Condition',
        ];
    }

    /**
     * Gets query for [[Book]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Books::class, ['id' => 'book_id']);
    }

    /**
     * Gets query for [[Client]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Clients::class, ['id' => 'client_id']);
    }

    /**
     * Gets query for [[Staff]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasOne(Staff::class, ['id' => 'staff_id']);
    }
}
