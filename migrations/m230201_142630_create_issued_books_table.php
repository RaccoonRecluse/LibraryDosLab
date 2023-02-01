<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%issued_books}}`.
 */
class m230201_142630_create_issued_books_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%issued_books}}', [
            'id' => $this->primaryKey(),
            'subject' => $this->integer(),
            'object' => $this->integer(),
            'staff_id' => $this->integer(),
            'date_of_issue' => $this->date(),
            'issuance_period' => $this->date(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%issued_books}}');
    }
}
