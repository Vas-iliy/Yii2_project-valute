<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_tokens}}`.
 */
class m220318_141239_create_user_tokens_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_tokens}}', [
            'id' => $this->primaryKey(),
            'access_token' => $this->string(),
            'refresh_token' => $this->string(),
            'expire' => $this->bigInteger(),
            'user_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_tokens}}');
    }
}
