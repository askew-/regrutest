<?php

use yii\db\Migration;

/**
 * Class m181009_111418_change_user_table
 */
class m181009_111418_change_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'username', $this->string()->notNull());
        $this->alterColumn('{{%user}}', 'fullname', $this->string()->notNull());
        $this->alterColumn('{{%user}}', 'email', $this->string()->notNull());
        $this->alterColumn('{{%user}}', 'type', $this->string()->notNull());
        $this->alterColumn('{{%user}}', 'password', $this->string()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'username');
        $this->alterColumn('{{%user}}', 'fullname', $this->string());
        $this->alterColumn('{{%user}}', 'email', $this->string());
        $this->alterColumn('{{%user}}', 'type', $this->string());
        $this->alterColumn('{{%user}}', 'password', $this->string());
    }
}
