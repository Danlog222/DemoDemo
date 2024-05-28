<?php

use app\models\Category;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var ActiveForm $form */
$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-register">
<h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'full_name') ?>
        <?= $form->field($model, 'login') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'passport') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'phone') ?>
        <?= $form->field($model, 'category_id')->dropDownList(Category::getCategory(),['prompt' => 'Выберите категорию'])?>
        <?= $form->field($model, 'rules')->checkbox() ?>
    
        <div class="form-group">
            <?= Html::submitButton('Зарегистрироватсья', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-register -->
