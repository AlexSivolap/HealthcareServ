<?php

use yii\db\Migration;
use app\models\AddHSForm;

/**
 * Class m220420_103122_AddHSForm
 */
class m220420_103122_AddHSForm extends Migration {
        
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
    
        $this->createTable (AddHSForm::tableName(),[
                'id' => $this->primaryKey(),
                'divisionId' => $this->string(),
                'specialityType' => $this->string(),
                'providingCondition' => $this->string(),
                'comment' => $this->string(),
                'daysOfWeek' => $this->text(),
                'allDay' => $this->tinyInteger(1),
                'startA' => $this->string(),
                'endA' => $this->string(),
                'startNA' => $this->string(),
                'endNA' => $this->string()
            ],
            $tableOptions
        ); 
    }

    public function safeDown()
    {
        $this->dropTable(AddHSForm::tableName());
    }
}
