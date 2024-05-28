<?php

use app\models\Category;
use app\models\Department;
use app\models\Status;
use app\models\User;
use yii\bootstrap5\Html;
?>
<div class="card" style="width: 18rem;">
  <ul class="list-group list-group-flush">
  <li class="list-group-item">Номер заявки: <?=Html::encode($model->id)?></li>
    <li class="list-group-item">Описание: <?=Html::encode($model->description)?></li>
    <li class="list-group-item">Статус заявки: <?=Html::encode(Status::getStatus()[$model->status_id])?></li>
    <li class="list-group-item">Дата приёма: <?=Html::encode(Yii::$app->formatter->asDate($model->date,'php:d.m.Y H:i:s'))?></li>
    <li class="list-group-item">Время формирования: <?=Html::encode(Yii::$app->formatter->asDate($model->created_at,'php:d.m.Y H:i:s'))?></li>
    <li class="list-group-item">Отдел: <?=Html::encode(Department::getDepartment()[$model->department_id])?></li>
    <li class="list-group-item">Категория гражданина: <?=Html::encode(Category::getCategory()[User::findOne($model->user_id)->category_id])?></li>
  </ul>
  <div class="card-body">
  <?= Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
  <?= $model->status_id == 1 
   ?Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить?',
                'method' => 'post',
            ],
        ]) :''?>
  </div>
</div>
