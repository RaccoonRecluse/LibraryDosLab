<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property int $id
 * @property string $name
 * @property string $document_number
 *
 * @property IssuedBooks[] $issuedBooks
 * @property ReturnedBooks[] $returnedBooks
 */
class Clients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'document_number'], 'required'],
            [['id'], 'integer'],
            [['name', 'document_number'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'document_number' => 'Document Number',
        ];
    }

    /**
     * Gets query for [[IssuedBooks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIssuedBooks()
    {
        return $this->hasMany(IssuedBooks::class, ['subject' => 'id']);
    }

    /**
     * Gets query for [[ReturnedBooks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReturnedBooks()
    {
        return $this->hasMany(ReturnedBooks::class, ['client_id' => 'id']);
    }
}
