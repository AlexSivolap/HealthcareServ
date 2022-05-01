<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\AddHSForm;
use app\models\test;
use app\models\AddFormService;

/**
 * Description of HealthcareServController
 *
 * @author alex
 * @var $model app\models\AddHSForm
 */
class HealthcareServController extends Controller
{

    public function actionIndex() 
    {
        $model = new AddHSForm();
        $formService = new AddFormService();
        
        $week = $formService->getDayOfWeek();
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            //$model->daysOfWeek = json_encode($model->daysOfWeek);
//            var_dump($model->daysOfWeek);
//            die;
            //$model->daysOfWeek = $model->getDaysOfWeek($model);

            

            

            $structure = $formService->setStructure($model);

            return $this->render('result', [
                'struct' => $structure
            ]);
        }

        return $this->render('index', [
            'model' => $model,
            'week' => $week
        ]);
    }

}
