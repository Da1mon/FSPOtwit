<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\common\grid\ActionColumn;
use kartik\date\DatePicker;
use app\common\grid\LinkColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Комментарии';
$this->params['breadcrumbs'][] = ['label' => 'Admin-панель', 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'contentOptions'=>[ 'style'=>'width: 50px'],

            ],
            [
                'class' => LinkColumn::className(),
                'controller' => 'posts',
                'attribute' => 'post_id',
                'value' => function ($model, $key, $index, $column) {
                    /** @var app\models\Comment $model */
                    return Html::a(Html::encode($model->post_id), ['posts/view', 'id' => $model->post_id]);

                },
                'contentOptions'=>[ 'style'=>'width: 50px'],
            ],
            [
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'date_from',
                    'attribute2' => 'date_to',
                    'type' => DatePicker::TYPE_RANGE,
                    'separator' => '-',
                    'pluginOptions' => ['format' => 'yyyy-mm-dd']
                ]),
                'attribute' => 'created_at',
                'format' => 'datetime',
                'contentOptions'=>[ 'style'=>'width: 240px'],
            ],
            [
                'class' => LinkColumn::className(),
                'controller' => 'users',
                'attribute' => 'author',
                'value' => function ($model, $key, $index, $column) {
                    /** @var app\models\Post $model */
                    return Html::a(Html::encode($model->author->username), ['users/view', 'id' => $model->author_id]);
                },
                'label' => 'Автор',
                'contentOptions'=>[ 'style'=>'width: 150px'],
            ],
            [
                'attribute'=>'content',
                'contentOptions'=>[ 'style'=>'width: 590px; word-wrap: break-word;'],
            ],


            //'updated_at',
            // 'like_counter',

            ['class' => ActionColumn::className()],
        ],
    ]); ?>

</div>
