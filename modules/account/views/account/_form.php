<?php

use app\models\Department;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Application $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="application-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'department_id')->dropDownList(Department::getDepartment(), ['prompt' => 'Выберите отдел']) ?>

    <?= $form->field($model, 'date')->textInput([
        'type' => 'datetime-local',
        'min' => date('Y-m-d') . 'T00:00'
    ]) ?>

    <?= $form->field($model, 'description')->textarea() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
