<?php

use yii\db\Migration;

/**
 * Class m191029_122610_alter_user_table
 */
class m191029_122610_alter_user_table extends Migration
{

    public function up()
    {
        $this->addColumn('{{%user}}', 'about', $this->text());
        $this->addColumn('{{%user}}', 'type', $this->integer());
        $this->addColumn('{{%user}}', 'nickname', $this->string(70));
        $this->addColumn('{{%user}}', 'picture', $this->string());
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'about', $this->text());
        $this->dropColumn('{{%user}}', 'type', $this->integer());
        $this->dropColumn('{{%user}}', 'nickname', $this->string(70));
        $this->dropColumn('{{%user}}', 'picture', $this->string());
    }
}
