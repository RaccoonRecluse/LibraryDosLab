<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%conditions}}`.
 */
class m230201_142549_create_conditions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%conditions}}', [
            'id' => $this->primaryKey(),
            'book_condition' => $this->string(255),
        ]);
        $this->batchInsert('{{%conditions}}', ['book_condition'], [
            ['Отличное'],
            ['Удовлетворительное'],
            ['Незначительно повреждена'],
            ['Требует реставрации'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%conditions}}');
    }
}
