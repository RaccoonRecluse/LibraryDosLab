<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%returned_books}}`.
 */
class m230201_142819_create_returned_books_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%returned_books}}', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer(),
            'client_id' => $this->integer(),
            'staff_id' => $this->integer(),
            'return_date' => $this->date(),
            'book_condition' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%returned_books}}');
    }
}
