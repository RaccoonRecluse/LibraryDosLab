<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%staff}}`.
 */
class m230201_142324_create_staff_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%staff}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'position' => $this->string(255),
            'login' => $this->string(255),
            'password' => $this->string(255),
            'token' => $this->string(255),
        ]);
        $this->batchInsert('{{%staff}}', ['name', 'position', 'login', 'password', 'token'], [
            ['Иванов Иван Иванов', 'Админ', 'admin', '$2y$13$HwjOeSZIcbCec/bc6/qvY.jS2OkcdqDpjjMRu1GxeDtBrS9WIO7Oe', ''],
            ['Поляков Игорь Евгеньевич', 'Библиотекарь', 'worker', '$2y$13$Mhb27.lk3VuukB1HkcVTXua50nCkMjFI892/Q4WcNkUMGX8u7a58u', ''],
          ]
);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%staff}}');
    }
}
