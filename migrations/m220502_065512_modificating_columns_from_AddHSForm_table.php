<?php

use yii\db\Migration;

/**
 * Handles modificating columns from table `{{%AddHSForm}}`.
 */
class m220502_065512_modificating_columns_from_AddHSForm_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%AddHSForm}}', 'daysOfWeek');
        $this->dropColumn('{{%AddHSForm}}', 'startA');
        $this->dropColumn('{{%AddHSForm}}', 'endA');
        $this->addColumn('{{%AddHSForm}}', 'daysOfWeek', $this->json()->after('comment'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%AddHSForm}}', 'endA', $this->string());
        $this->addColumn('{{%AddHSForm}}', 'startA', $this->string());
        $this->addColumn('{{%AddHSForm}}', 'daysOfWeek', $this->string());
    }
}
