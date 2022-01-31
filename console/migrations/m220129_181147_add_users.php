<?php

use yii\db\Migration;

/**
 * Class m220129_181147_add_users
 */
class m220129_181147_add_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%user}}', [
            'username' => 'user',
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(32),
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('user'),
            'email' => 'user@user.user',
            'status' => 10,
            'created_at' => microtime(),
            'updated_at' => microtime(),
        ]);

        $this->insert('{{%user}}', [
            'username' => 'manager',
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(32),
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('manager'),
            'email' => 'manager@manager.manager',
            'status' => 10,
            'created_at' => microtime(),
            'updated_at' => microtime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%user}}', ['username' => 'manager']);
        $this->delete('{{%user}}', ['username' => 'user']);
    }
}
