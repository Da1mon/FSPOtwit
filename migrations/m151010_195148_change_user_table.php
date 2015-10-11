<?php

use yii\db\Migration;

class m151010_195148_change_user_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}','firstname', $this->string(20));
        $this->addColumn('{{%user}}','lastname', $this->string(20));
    }

    public function down()
    {
        $this->dropColumn('{{%user}}','firstname');
        $this->dropColumn('{{%user}}','lastname');
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
