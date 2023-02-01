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
class SearchBookForm extends Model
{
    public $title;
    public $availability;

    private $_user = false;

    public function rules()
    {
        return [
            [['title'], 'string'],
            [['availability'], 'boolean'],

        ];
    }

}
