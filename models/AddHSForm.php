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
            [['startNA', 'endNA', 'daysOfWeek'], 'safe'],
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

    //Формирю структуру
    public function setStructure($model) 
    {
        $this->getIsoFormatDate($model->startNA);

        return "{
            'division_id': '" . $this->divisionId . "',
            'speciality_type': '" . $model->specialityType . "',
            'providing_condition': '" . $model->providingCondition . "',
            'comment': '" . $model->comment . "',
            'available_time': [
              {
                'days_of_week': '[" . $model->daysOfWeek . "]',
                'all_day': " . ($model->allDay ? 'true' : 'false') . ",
                'available_start_time': '" . ($model->startA ? $model->startA .
                ':00' : '') . "',
                'available_end_time': '" . ($model->endA ? $model->endA .
                ':00' : '') . "'
              }
            ],
            'not_available': [
              {
                'description': 'Санітарний день',
                'during': {
                  'start': '" . 
                ($model->startNA ? $this->getIsoFormatDate($model->startNA) : '') . "',
                  'end': '" . 
                ($model->endNA ? $this->getIsoFormatDate($model->endNA) : '') . "'
                }
              }
            ]
          }";
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

    /**
     * 
     * @param type string
     * Преобразование времени в формат iso8061
     */
    public function getIsoFormatDate($dateTime) 
    {
        $date = new DateTime($dateTime);
        return $date->format(DateTime::ATOM);
    }

}
