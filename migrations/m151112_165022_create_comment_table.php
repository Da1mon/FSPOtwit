<?php

use yii\db\Migration;

class m151112_165022_create_comment_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'content' => $this->string(140)->notNull(),
            'author_id' => $this->integer()->notNull(),
            'post_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('FK_comment_author', '{{%comment}}', 'author_id');
        $this->addForeignKey(
            'FK_comment_author', '{{%comment}}', 'author_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE'
        );
        $this->createIndex('FK_comment_post', '{{%comment}}', 'post_id');
        $this->addForeignKey(
            'FK_comment_post', '{{%comment}}', 'post_id', '{{%post}}', 'id', 'CASCADE', 'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('{{%comment}}');
    }
}
