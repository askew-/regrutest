<?php

use yii\db\Migration;

/**
 * Handles the creation of table `company`.
 */
class m181008_121539_create_company_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = $this->db->driverName === 'mysql'
            ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB'
            : null;
        $this->createTable('{{%company}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'title' => $this->string(),
        ], $tableOptions);

        $this->addForeignKey("users_fk", "{{%company}}", "user_id", "{{%user}}", "id", 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%company}}');
        $this->dropForeignKey('users_fk','{{%user}}');
    }
}
