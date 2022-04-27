<?php
/* @var $this yii\web\View */
/* @var $model \app\models\AddHSForm */

use yii\helpers\VarDumper;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'HealthcareServices';

?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Медицынские услуги!</h1>
    </div>

    <div class="body-content">

        <div class="col-md-12">
            <h2>Добавлено медицынскую услугу</h2>
          
            <pre><?= var_dump($struct); ?></pre>
        </div>
    </div>
</div>
