<?php

namespace console\modules\company\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%industry}}`.
 */
class m220129_073202_create_industry_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%industry}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'type_id' => $this->integer()->null()->defaultValue(null),
            'created_at' => $this->dateTime()->null()->defaultValue(null),
            'updated_at' => $this->dateTime()->null()->defaultValue(null),
        ]);

        $this->createIndex('type_id', '{{%industry}}', ['type_id']);

        $this->addForeignKey(
            'fk-industry_type_id-industry_type',
            '{{%industry}}',
            'type_id',
            '{{%industry_type}}',
            'id',
            'SET NULL',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-industry_type_id-industry_type', '{{%industry}}');
        $this->dropTable('{{%industry}}');
    }
}
