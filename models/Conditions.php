<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "conditions".
 *
 * @property int $id
 * @property string $book_condition
 *
 * @property Books[] $books
 */
class Conditions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'conditions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_condition'], 'required'],
            [['book_condition'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_condition' => 'Book Condition',
        ];
    }

    /**
     * Gets query for [[Books]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Books::class, ['book_condition' => 'id']);
    }
}
