<?php
/**
 * Created by PhpStorm.
 * User: Ilya
 * Date: 20.11.2015
 * Time: 3:15
 */
/* @var $model app\models\Subscription */
use yii\helpers\Html;
use yii\helpers\Url;
$user = $model->subscriptionUser
?>
<?= Html::beginTag('div', ['class' => 'col-xs-4 col-sm-4 col-md-4 col-lg-4','data' => ['subscription-id' => $model->id]]); ?>
	<div class="well opacity">
        <?php
        if ($user->avatar) {
            echo Html::img(Yii::$app->homeUrl . 'uploads/sm_' . $user->avatar, ['alt' => 'avatar', 'class' => 'img-rounded post-avatar']);
        } else {
            echo Html::img(Yii::$app->homeUrl . 'img/avatars/sm_default_avatar.png', ['alt' => 'avatar', 'class' => 'img-rounded post-avatar']);
        }
        ?>
        <div><strong><?= Html::a('@'. $user->username, Yii::$app->homeUrl . $user->id,[ 'data-pjax'=>"0", 'style'=>['font-size'=>'16px']]) ?></strong></div>
        <?= Html::a('Отписаться', Url::to(['feed/unsubscribe', 'id' =>  $model->id]), [
            'class' => 'btn btn-danger btn-sm unsubscribe-btn',
            'format' => 'raw',
            'data-pjax' => 0,
        ]); ?>
    </div>
<?= Html::endTag('div');?>
