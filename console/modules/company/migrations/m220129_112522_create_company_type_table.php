<?php

namespace console\modules\company\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%company_type}}`.
 */
class m220129_112522_create_company_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%company_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%company_type}}');
    }
}
