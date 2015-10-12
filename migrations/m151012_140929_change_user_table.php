<?php

use yii\db\Migration;

class m151012_140929_change_user_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}','filename', $this->string());
        $this->addColumn('{{%user}}','avatar', $this->string());
    }

    public function down()
    {
        $this->dropColumn('{{%user}}','filename');
        $this->dropColumn('{{%user}}','avatar');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
