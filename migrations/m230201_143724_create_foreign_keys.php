<?php

use yii\db\Migration;

/**
 * Class m230201_143724_create_foreign_keys
 */
class m230201_143724_create_foreign_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex(
            'books_idx_1',
            'books',
            'book_condition'
        );
        $this->addForeignKey(
            'books_ibfk_1',
            'books',
            'book_condition',
            'conditions',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'issued_books_idx_1',
            'issued_books',
            'subject'
        );
        $this->addForeignKey(
            'issued_books_ibfk_1',
            'issued_books',
            'subject',
            'clients',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'issued_books_idx_2',
            'issued_books',
            'object'
        );
        $this->addForeignKey(
            'issued_books_ibfk_2',
            'issued_books',
            'object',
            'books',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'issued_books_idx_3',
            'issued_books',
            'staff_id'
        );
        $this->addForeignKey(
            'issued_books_ibfk_3',
            'issued_books',
            'staff_id',
            'staff',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'returned_books_idx_1',
            'returned_books',
            'client_id'
        );
        $this->addForeignKey(
            'returned_books_ibfk_1',
            'returned_books',
            'client_id',
            'clients',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'returned_books_idx_2',
            'returned_books',
            'book_id'
        );
        $this->addForeignKey(
            'returned_books_ibfk_2',
            'returned_books',
            'book_id',
            'books',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'returned_books_idx_3',
            'returned_books',
            'staff_id'
        );
        $this->addForeignKey(
            'returned_books_ibfk_3',
            'returned_books',
            'staff_id',
            'staff',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropForeignKey(
            'books_ibfk_1',
            'books',
        );
        $this->dropIndex(
            'books_idx_1',
            'books',
        );

        $this->dropForeignKey(
            'issued_books_ibfk_1',
            'issued_books',

        );
        $this->dropIndex(
            'issued_books_idx_1',
            'issued_books',
        );

        $this->dropForeignKey(
            'issued_books_ibfk_2',
            'issued_books',

        );
        $this->dropIndex(
            'issued_books_idx_2',
            'issued_books',
        );

        $this->dropForeignKey(
            'issued_books_ibfk_3',
            'issued_books',

        );
        $this->dropIndex(
            'issued_books_idx_3',
            'issued_books',
        );


        $this->dropForeignKey(
            'returned_books_ibfk_1',
            'returned_books',

        );
        $this->dropIndex(
            'returned_books_idx_1',
            'returned_books',
        );

        $this->dropForeignKey(
            'returned_books_ibfk_2',
            'returned_books',

        );
        $this->dropIndex(
            'returned_books_idx_2',
            'returned_books',
        );

        $this->dropForeignKey(
            'returned_books_ibfk_3',
            'returned_books',

        );
        $this->dropIndex(
            'returned_books_idx_3',
            'returned_books',
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230201_143724_create_foreign_keys cannot be reverted.\n";

        return false;
    }
    */
}
