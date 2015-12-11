<?php

use yii\db\Migration;

class m151211_040229_change_user_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}','admin', $this->smallInteger()->notNull()->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('{{%user}}','admin');
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
