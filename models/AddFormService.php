<?php

namespace app\models;

use Yii;
use yii\base\Model;
use kartik\datetime\DateTimePicker;
use DateTime;

/**
 * Structure Formatting Service
 *
 * @author alex
 */
class AddFormService  extends Model
{
    
    /**
     * Формирю структуру
     * @param $model 
     * @return json
     */
    public function setStructure($model) 
    {
        $model = $this->getDaysOfWeek($model);
        
        $model->daysOfWeek = json_encode($model->daysOfWeek);
        
        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Данные приняты');
        } else {
            var_dump($model->getErrors());
            die();
            Yii::$app->session->setFlash('error', 'Ошибка');
        }
        
        $struct = $model->find()
                ->where(['id' => $model->id])
                ->one();
        
        $availableTime = $this->getAvailableTime($struct);
                
        return "{
            'division_id': '" . $struct->divisionId . "',
            'speciality_type': '" . $struct->specialityType . "',
            'providing_condition': '" . $struct->providingCondition . "',
            'comment': '" . $struct->comment . "',
            'available_time': [".$availableTime."
                ],
            'not_available': [
              {
                'description': 'Санітарний день',
                'during': {
                  'start': '" . 
                ($struct->startNA ? $this->getIsoFormatDate($struct->startNA) : '') . "',
                  'end': '" . 
                ($struct->endNA ? $this->getIsoFormatDate($struct->endNA) : '') . "'
                }
              }
            ]
          }";
    }
    
    /**
     * 
     * Formating DateTime in iso8061
     * @param $dateTime 
     * @return DateTime
     */
    public function getIsoFormatDate($dateTime) 
    {
        $date = new DateTime($dateTime);
        
        return $date->format(DateTime::ATOM);
    }
    
    /**
     * 
     * return array
     */
    public function getDayOfWeek()
    {
        return $week = [
            'Mon' => 'Пн',
            'Tue' => 'Вт',
            'Wed' => 'Ср',
            'Thur' => 'Чт',
            'Fri' => 'Пт',
            'Sat' => 'Сб',
            'Sun' => 'Вс'
        ];        
    }
    
    /**
     * Return in model not empty days of week and time
     * @param $model
     * @return $model
     */
    public function getDaysOfWeek($model)
    {
        foreach($model->daysOfWeek as $day => $time){
            if($time != "")
                $dayTime[$day] = $time;
        }
        $model->daysOfWeek = $dayTime;
        
        return $model;
    }
    
    /**
     * Convert obj to string
     * @param obj $struct - $model->find()
     * @return string $availableTime
     */
    public function getAvailableTime($struct)
    {
        //convert obj to array
        foreach(json_decode($struct->daysOfWeek) as $day => $time){
            $daysOfWeek[$day] = $time;
        }
        
        //set available_time
        $availableTime = '';
        foreach($this->getDayOfWeek() as $dayUS => $dayUA)
        {
            if(isset($daysOfWeek[$dayUS.'Start']) && isset($daysOfWeek[$dayUS.'End']))
            {
                $availableTime .= "
                    {
                      'days_of_week': '[" . $dayUS. "]',
                      'all_day': " . ($struct->allDay ? 'true' : 'false') . ",
                      'available_start_time': '" . ($daysOfWeek[$dayUS.'Start'] ? $daysOfWeek[$dayUS.'Start'] .
                      ':00' : '') . "',
                      'available_end_time': '" . ($daysOfWeek[$dayUS.'End'] ? $daysOfWeek[$dayUS.'End'] .
                      ':00' : '') . "'
                    }";
            }   
        }    
        
        return $availableTime;
    }
}
