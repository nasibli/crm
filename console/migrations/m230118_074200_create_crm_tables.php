<?php

use yii\db\Migration;

/**
 * Class m230118_074200_create_crm_tables
 */
class m230118_074200_create_crm_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%application_status}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
        ]);

        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
        ]);

        $this->createTable('{{%application}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'status_id' => $this->integer()->notNull(),
            'name' => $this->string(200)->notNull(),
            'customer_name' => $this->string(150)->notNull(),
            'price' => $this->integer()->notNull(),
            'phone' => $this->string(20)->notNull(),
            'comment' => $this->text()->null(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'product_id-product',
            'application',
            'product_id',
            'product',
            'id'
        );

        $this->addForeignKey(
            'status_id-application_status',
            'application',
            'status_id',
            'application_status',
            'id'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_role}}');
        $this->dropTable('{{%customer}}');
        $this->dropTable('{{%application}}');
        $this->dropTable('{{%application_status}}');
        $this->dropTable('{{%product}}');
    }

}
