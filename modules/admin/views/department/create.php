<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Department $model */

$this->title = 'Создание отдела';
$this->params['breadcrumbs'][] = ['label' => 'Управление Отделами', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
