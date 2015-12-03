<?php

use yii\db\Migration;

class m151127_211943_create_post_like_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%like_post}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'post_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('FK_like_post_user', '{{%like_post}}', 'user_id');
        $this->addForeignKey(
            'FK_like_post_user', '{{%like_post}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE'
        );
        $this->createIndex('FK_like_post_post', '{{%like_post}}', 'post_id');
        $this->addForeignKey(
            'FK_like_post_post', '{{%like_post}}', 'post_id', '{{%post}}', 'id', 'CASCADE', 'CASCADE'
        );

        $this->addColumn('{{%post}}','like_counter', $this->integer()->notNull()->defaultValue(0));
    }

    public function down()
    {
        $this->dropTable('{{%like_post}}');
    }

}
