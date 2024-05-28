<?php

use app\models\Department;
use app\models\Status;
use app\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Application $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Административная панель', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="application-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'id',
                'value' => Html::encode($model->id)
            ],
            [
                'attribute' => 'description',
                'value' => Html::encode($model->description),
            ],
            [
                'attribute' => 'department_id',
                'value' => Html::encode(Department::getDepartment()[$model->department_id])
            ],
            [
                'attribute' => 'date',
                'value' => Html::encode(Html::encode(Yii::$app->formatter->asDate($model->date,'php:d.m.Y H:i:s')))
            ],
            [
                'attribute' => 'status_id',
                'value' => Html::encode(Html::encode(Status::getStatus()[$model->status_id]))
            ],
            [
                'attribute' => 'created_at',
                'value' => Html::encode(Yii::$app->formatter->asDate($model->created_at,'php:d.m.Y H:i:s'))
            ],
            [
                'label' => 'Логин пользователя',
                'value' => Html::encode(Html::encode(User::findOne($model->user_id)->login)),
            ],             
            
        ],
    ]) ?>

</div>
