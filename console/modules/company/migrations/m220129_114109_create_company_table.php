<?php

namespace console\modules\company\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%company}}`.
 */
class m220129_114109_create_company_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%company}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'type_id' => $this->integer()->notNull(),
            'industry_id' => $this->integer()->notNull(),
            'inn' => $this->string()->notNull(),
            'address' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'created_at' => $this->dateTime()->null()->defaultValue(null),
            'updated_at' => $this->dateTime()->null()->defaultValue(null),
        ]);

        $this->createIndex('type_id', '{{%company}}', ['type_id']);
        $this->createIndex('industry_id', '{{%company}}', ['industry_id']);

        $this->addForeignKey(
            'fk-company_type_id-company_type',
            '{{%company}}',
            'type_id',
            '{{%company_type}}',
            'id',
        );
        $this->addForeignKey(
            'fk-company_industry_id-industry',
            '{{%company}}',
            'industry_id',
            '{{%industry}}',
            'id',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-company_industry_id-industry', '{{%company}}');
        $this->dropForeignKey('fk-company_type_id-company_type', '{{%company}}');
        $this->dropTable('{{%company}}');
    }
}
