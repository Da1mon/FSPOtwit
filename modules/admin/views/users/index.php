<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\common\grid\ActionColumn;
use app\common\grid\SetColumn;
use app\modules\admin\models\User;
use kartik\date\DatePicker;
use app\common\grid\LinkColumn;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = ['label' => 'Admin-панель', 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
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
            ],
            [
                'class' => LinkColumn::className(),
                'attribute' => 'username',
            ],
            'email:email',
            //'auth_key',
            // 'email_confirm_token:email',
            // 'password_hash',
            // 'password_reset_token',
            // 'email:email',
            // 'status',
            // 'firstname',
            // 'lastname',
            // 'filename',
            // 'avatar',
            [
                'class' => SetColumn::className(),
                'filter' => User::getStatusesArray(),
                //'filterInputOptions' => ['class' => ['form-control', 'user-status']],
                'contentOptions' => ['style' => 'text-align: center;'],
                'attribute' => 'status',
                'name' => 'statusName',
                'cssCLasses' => [
                    User::STATUS_ACTIVE => 'success',
                    User::STATUS_WAIT => 'warning',
                    User::STATUS_BLOCKED => 'default',
                ],
            ],
            [
                'class' => SetColumn::className(),
                'filter' => User::getAdminsArray(),
                //'filterInputOptions' => ['class' => ['form-control', 'user-status']],
                'contentOptions' => ['style' => 'text-align: center;'],
                'attribute' => 'admin',
                'name' => 'adminName',
                'cssCLasses' => [
                    User::STATUS_DEFAULT => 'default',
                    User::STATUS_ADMIN => 'danger',
                ],
            ],
            ['class' => ActionColumn::className()],
        ],
    ]); ?>

</div>
