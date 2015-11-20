<?php

use yii\db\Migration;

class m151119_165150_create_subscription_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%subscription}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'subscription_user_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('FK_subscription_user', '{{%subscription}}', 'user_id');
        $this->addForeignKey(
            'FK_subscription_user', '{{%subscription}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE'
        );
        $this->createIndex('FK_subscription_subscription_user', '{{%subscription}}', 'subscription_user_id');
        $this->addForeignKey(
            'FK_subscription_subscription_user', '{{%subscription}}', 'subscription_user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE'
        );
    }

    public function down()
    {
        {
            $this->dropTable('{{%subscription}}');
        }
    }

}
