<?php

namespace console\modules\company\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%industry_type}}`.
 */
class m220129_072402_create_industry_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%industry_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%industry_type}}');
    }
}
