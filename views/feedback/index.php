<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Feedback $model */
/** @var ActiveForm $form */
$this->title = 'Отзывы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-index">
<h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(
        [
            'id' => 'feedback',
        ]
    ); ?>

        <?= $form->field($model, 'full_name') ?>
        <?= $form->field($model, 'phone') ?>
        <?= $form->field($model, 'imageFile')->fileInput() ?>
        <?= $form->field($model, 'feedback')->textarea() ?>
        <?= $form->field($model, 'rules')->checkbox() ?>
    
        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- feedback-index -->
