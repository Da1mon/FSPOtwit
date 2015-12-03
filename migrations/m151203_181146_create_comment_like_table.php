<?php

use yii\db\Migration;

class m151203_181146_create_comment_like_table extends Migration
{
    public function up()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%like_comment}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'comment_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('FK_like_comment_user', '{{%like_comment}}', 'user_id');
        $this->addForeignKey(
            'FK_like_comment_user', '{{%like_comment}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE'
        );
        $this->createIndex('FK_like_comment_comment', '{{%like_comment}}', 'comment_id');
        $this->addForeignKey(
            'FK_like_comment_comment', '{{%like_comment}}', 'comment_id', '{{%comment}}', 'id', 'CASCADE', 'CASCADE'
        );

        $this->addColumn('{{%comment}}','like_counter', $this->integer()->notNull()->defaultValue(0));
    }

    public function down()
    {
        $this->dropTable('{{%like_comment}}');
    }
}
