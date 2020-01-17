<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?if (Yii::$app->user->can('create')): ?>
            <?= Html::a('Create Company', ['create'], ['class' => 'btn btn-success']) ?>
        <?endif;?>
    </p>

    <?php Pjax::begin(); ?>
<!--    --><?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'inn',
            'director',
            'address',
            [
                'class' => 'yii\grid\ActionColumn',
                'visibleButtons' => [
                    'view' => \Yii::$app->user->can('view'),
                    'update' => \Yii::$app->user->can('update'),
                    'delete' => \Yii::$app->user->can('delete'),
                ],
            ],
        ],
    ]) ?>

    <?php Pjax::end(); ?>

</div>
