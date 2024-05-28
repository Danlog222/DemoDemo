<?php

use app\models\Application;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\modules\admin\models\ApplicationSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Административная панель';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="application-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Управление категориями граждан', ['./category'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Управление Отделами', ['./department'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'col-md-3 d-flex justify-content-center mb-3'],
        'pager' => [
            'class' => LinkPager::class
        ],
        'layout' => '<div class ="row m-auto">{items}</div>{pager}',
        'itemView' => 'item',
    ]) ?>

    <?php Pjax::end(); ?>

</div>
