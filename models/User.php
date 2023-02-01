<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "staff".
 *
 * @property int $id
 * @property string $name
 * @property string $login
 * @property string $password
 * @property string $position
 * @property string $token
 *
 * @property IssuedBooks[] $issuedBooks
 * @property ReturnedBooks[] $returnedBooks
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staff';
    }

    public static function findIdentity($id){
        return static::findOne(['id'=> $id]);
    }
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }
 
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->token;
    }
 
    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public static function findByLogin($username)
    {
        return static::findOne(['login' => $username]);
    }

    public function validatePassword($password)
    {
        return $this->password === $password;
    }
 
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['password'], 'string', 'min' => 8],
            [['name', 'login', 'password', 'position'], 'required'],
            [['name', 'login', 'password', 'position', 'token'], 'string', 'max' => 255],
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
            'login' => 'Login',
            'password' => 'Password',
            'position' => 'Position',
            'token' => 'Token',
        ];
    }

    /**
     * Gets query for [[IssuedBooks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIssuedBooks()
    {
        return $this->hasMany(IssuedBooks::class, ['staff_id' => 'id']);
    }

    /**
     * Gets query for [[ReturnedBooks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReturnedBooks()
    {
        return $this->hasMany(ReturnedBooks::class, ['staff_id' => 'id']);
    }
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }
 
    /**
     * Generates "remember me" authentication key
     */
    public function generateToken()
    {
        $this->token = Yii::$app->security->generateRandomString();
    }
}
