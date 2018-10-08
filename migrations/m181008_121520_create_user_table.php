<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m181008_121520_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = $this->db->driverName === 'mysql'
            ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB'
            : null;

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'fullname' => $this->string(),
            'email' => $this->string(),
            'type' => $this->string(),
            'inn' => $this->integer(),
            'password' => $this->string(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
