<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use kartik\datetime\DateTimePicker;
use yii\db\ActiveRecord;
use DateTime;

/**
 * AddHSForm is a form model for adding medical services
 * 
 * @author alex
 */
class AddHSForm extends ActiveRecord 
{
    public $dayOfWeek;
    
    public static function tableName() 
    {
        return '{{AddHSForm}}';
    }

    public function rules() 
    {

        return [
            [['specialityType'], 'required'],
            [['providingCondition', 'comment'], 'string'],
            [['allDay'], 'boolean'],
            [['startNA', 'endNA', 'daysOfWeek', 'dayOfWeek'], 'safe'],
            [['startA', 'endA'], 'time', 'format' => 'php:H:m']
        ];
    }

    public function attributeLabels() 
    {
        return [
            'specialityType' => 'Специальность',
            'providingCondition' => 'Режим приема',
            'comment' => 'Комментарий',
            'startA' => 'Время начала приема',
            'endA' => 'Время окончания приема',
            'allDay' => 'Прием целый день',
            'startNA' => 'Начало неприемного периода',
            'endNA' => 'Окончание неприемного периода'
        ];
    }

    

    //Возвращает выбранные дни
    public function getDaysOfWeek($model) 
    {

        if ($model->daysOfWeek) {
            $daysOfWeek = [];
            $days = [
                0 => 'Mon',
                1 => 'Tue',
                2 => 'Wed',
                3 => 'Thur',
                4 => 'Fri',
                5 => 'Sat',
                6 => 'Sun'
            ];
            
            foreach ($model->daysOfWeek as $key => $day) {
                $daysOfWeek[] = $days[$day];
            }

            $daysOfWeek = implode($daysOfWeek, ',');

            return $daysOfWeek;
        }
    }
}
