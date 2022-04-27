<?php
/* @var $this yii\web\View */

use yii\helpers\VarDumper;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\datetime\DateTimePicker;
use kartik\date\DatePicker;

$this->title = 'HealthcareServices';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Медицынские услуги!</h1>
    </div>

    <div class="body-content">

        <div class="col-md-12">
            <h2>Добавить медицынскую услугу</h2>
            <?php $form = ActiveForm::begin(); ?>

            <div class="col-md-12"><?= $form->field($model, 'specialityType') ?></div>
            <div class="col-md-12"><?= $form->field($model, 'providingCondition') ?></div>
            <div class="col-md-12"><?= $form->field($model, 'comment') ?></div>
            <div class="col-md-12"><?= $form->field($model, 'daysOfWeek')->dropdownList(['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'], ['multiple' => 'true']) ?></div>
            <!--<input type="time" id="date" name="date"/>-->
            <div class="col-md-2 h-100"><?= $form->field($model, 'startA',[
                     'inputOptions' => ['class' => '']
                ])->input('time') ?></div>
            
            <div class="col-md-2 h-100"><?= $form->field($model, 'endA',[
                     'inputOptions' => ['class' => '']
                ])->input('time') ?></div>
            
            <div class="col-md-12"><?= $form->field($model, 'allDay')->radioList([0=>'нет', 1 => 'да']) ?></div>
            <div class="col-md-12"><?= $form->field($model, 'startNA')->widget(DateTimePicker::class, [
			'options' => [
				'placeholder' => 'Оберіть дату ...',
			],
			'pluginOptions' => [
                                'language' => 'ru',
				'format' => 'dd-mm-yyyy hh:ii:ss',
				'todayHighlight' => true,
				'autoclose' => true
			]
		]) ?></div>
            <div class="col-md-12"><?= $form->field($model, 'endNA')->widget(DateTimePicker::class, [
			'options' => [
				'placeholder' => 'Оберіть дату ...',
				'placeholder' => 'Оберіть дату ...',
			],
			'pluginOptions' => [
                                'language' => 'ru',
				'format' => 'dd-mm-yyyy hh:ii:ss',
				'todayHighlight' => true,
				'autoclose' => true
			]
		]) ?></div>

            <div class="col-md-4">
                <?= Html::submitButton('отправить', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
