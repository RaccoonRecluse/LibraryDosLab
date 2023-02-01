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
class AddWorkerForm extends Model
{
    public $name;
    public $login;
    public $position;
    public $password;

    private $_user = false;

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ФИО',
            'login' => 'Логин',
            'password' => 'Пароль',
            'position' => 'Должность',
            'token' => 'Token',
        ];
    }
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // login and password are both required
            [['login', 'name', 'position', 'password'], 'required', 'message' => 'Поле {attribute} не может быть пустым.'],
            [['login'], 'unique', 'targetClass' => '\app\models\User', 'message' => 'Этот логин уже занят другим работником.'],
            [['login', 'name', 'position', 'password'], 'string', 'min' => 4, 'tooShort' => '{attribute} не может содержать менее 4 символов.'],
            [['login', 'name', 'position', 'password'], 'string', 'max' => 255, 'tooLong' => '{attribute} не может содержать более 255 символов.'],
        ];
    }

    public function addWorker()
    {
        if (!$this->validate()) {
            return null;
        }
 
        $user = new User();
        $user->login = $this->login;
        $user->name = $this->name;
        $user->position = $this->position;
        $user->setPassword($this->password);
        $user->generateToken();
        return $user->save() ? $user : null;
    }

    public function getWorker()
    {
        if ($this->_user === false) {
            $this->_user = User::findBylogin($this->login);
        }

        return $this->_user;
    }
}
