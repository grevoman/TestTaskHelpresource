<?php

namespace console\modules\reportForm\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%monthly_report}}`.
 */
class m220129_135507_create_monthly_report_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%monthly_report}}', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer()->notNull(),
            'workers' => $this->integer()->notNull(),
            'salary' => $this->float()->notNull(),
            'taxes' => $this->float()->notNull(),
            'energy_amount' => $this->float(),
            'energy_organization' => $this->string(),
            'created_at' => $this->dateTime()->null()->defaultValue(null),
            'updated_at' => $this->dateTime()->null()->defaultValue(null),
        ]);

        $this->createIndex('company_id', '{{%monthly_report}}', ['company_id']);

        $this->addForeignKey(
            'fk-monthly_report_company_id-company',
            '{{%monthly_report}}',
            'company_id',
            '{{%company}}',
            'id',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-monthly_report_company_id-company', '{{%monthly_report}}');
        $this->dropTable('{{%monthly_report}}');
    }
}
