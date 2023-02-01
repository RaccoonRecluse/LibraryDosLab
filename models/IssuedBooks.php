<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "issued_books".
 *
 * @property int $id
 * @property int $subject
 * @property int $object
 * @property int $staff_id
 * @property string $date_of_issue
 * @property string $issuance_period
 *
 * @property Books $object0
 * @property Staff $staff
 * @property Clients $subject0
 */
class IssuedBooks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'issued_books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subject', 'object', 'staff_id', 'date_of_issue', 'issuance_period'], 'required'],
            [['subject', 'object', 'staff_id'], 'integer'],
            [['date_of_issue', 'issuance_period'], 'safe'],
            
            [['object'], 'exist', 'skipOnError' => true, 'targetClass' => Books::class, 'targetAttribute' => ['object' => 'id']],
            [['subject'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::class, 'targetAttribute' => ['subject' => 'id']],
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
            'subject' => 'Subject',
            'object' => 'Object',
            'staff_id' => 'Staff ID',
            'date_of_issue' => 'Date Of Issue',
            'issuance_period' => 'Issuance Period',
        ];
    }

    /**
     * Gets query for [[Object0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObject0()
    {
        return $this->hasOne(Books::class, ['id' => 'object']);
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

    /**
     * Gets query for [[Subject0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubject0()
    {
        return $this->hasOne(Clients::class, ['id' => 'subject']);
    }
}
