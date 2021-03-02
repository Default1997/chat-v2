<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m210302_103514_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(),
            'auth_key' => $this->string(),
            'password_hash' => $this->string(),
            'password_reset_token' => $this->string(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->string(),
            'verification_token' => $this->string(),
            'type' => $this->integer()
        ]);

        $this->insert('user', [
            'username' => 'elAdmin',
            'password_hash' => '$2y$13$wzH70uHOebaLjk44tKcVhOJOGkneZRki.1VT8VE7EQaWJfKI38ofq',
            'status' => 10,
            'type' => 1,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
