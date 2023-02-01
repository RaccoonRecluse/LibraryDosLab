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
class AddClientForm extends Model
{
    public $name;
    public $document_number;

    private $_user = false;

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ФИО',
            'document_number' => 'Серия и номер паспорта',
        ];
    }
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name'], 'required', 'message' => 'Поле {attribute} не может быть пустым.'],
            [['document_number'], 'unique', 'targetClass' => '\app\models\Clients', 'message' => 'Этот клиент уже существует.'],
            [['name', 'document_number'], 'string', 'min' => 4,  'tooShort' => '{attribute} не может содержать менее 4 символов.'],
            [['name', 'document_number'], 'string', 'max' => 255, 'tooLong' => '{attribute} не может содержать более 255 символов.'],
        ];
    }

    public function addClient()
    {
        if (!$this->validate()) {
            return null;
        }
 
        $client = new Clients();
        $client->document_number = $this->document_number;
        $client->name = $this->name;
        return $client->save() ? $client : null;
    }
}
