<?php
/**
 * Created by PhpStorm.
 * User: Ilya
 * Date: 07.10.2015
 * Time: 21:40
 */
/* @var $posts app\models\Post */
/* @var $post app\models\Post */
/* @var $user app\models\User */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use yii\widgets\ListView;
use app\models\User;
$this->registerJsFile(
    Yii::$app->homeUrl.'scripts/comment.js',
    ['depends'=>'app\assets\AppAsset']
);
if(!$addPostFlag) {
    $this->registerJsFile(
        Yii::$app->homeUrl . 'scripts/subscribe.js',
        ['depends' => 'app\assets\AppAsset']
    );
}
?>
<div class="row">
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
        <div class="well opacity" id="user-info">
            <?php
            if ($user->avatar) {
                echo Html::img(Yii::$app->homeUrl . 'uploads/sqr_' . $user->avatar,
                    ['alt' => 'avatar', 'class' => 'img-rounded']);
            } else {
                echo Html::img(Yii::$app->homeUrl . 'img/avatars/sqr_default_avatar.png',
                    ['alt' => 'avatar', 'class' => 'img-rounded']);
            }
            ?>
            <p class="text-center" style="margin-top:5px">
                <strong>
                    <?= Html::tag('a','@'. $user->username,['style'=>['font-size'=>'20px']]) ?>
                </strong>
            </p>
            <?php if(!$addPostFlag) {
                if(User::isSubscribe(Yii::$app->user->identity->getId(),$user->id)) {
                    echo Html::a('Отписаться', ['site/unsubscribe'], [
                        'class' => 'btn btn-default btn-lg btn-block',
                        'id' => 'unsubscribe',
                        'format' => 'raw',
                        'data-user-id' => $user->id,
                        'data-pjax'=> 0,
                        'style' => ['background-color' => '#E5E5E5'],
                    ]);
                } else {
                    echo Html::a('Подписаться', ['site/subscribe'], [
                        'class' => 'btn btn-primary btn-lg btn-block',
                        'id' => 'subscribe',
                        'format' => 'raw',
                        'data-user-id' => $user->id,
                        'data-pjax' => 0,
                    ]);
                }
            }
            ?>
        </div>
    </div>
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <?php if ($addPostFlag): ?>
            <div class="user-index">
                <div class="well opacity">
                    <?php Pjax::begin(['id' => 'new_post', 'enablePushState' => false]) ?>
                    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true],'id'=>'new-post-form']); ?>
                    <?= $form->field($post, 'content')->textarea(['maxlength' => true, 'rows' => 2])->label('новая публикация') ?>
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
                    <?php ActiveForm::end(); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        <?php endif; ?>
        <div id="posts">
            <?php Pjax::begin(['id' => 'notes','enablePushState' => false]) ?>
                <?= ListView::widget([
                    'dataProvider' => $listDataProvider,
                    'layout' => "{items}",
                    'itemView' => function ($model, $key, $index, $widget) {
                        return $this->render('_post',['model' => $model]);
                    },
                ]);
            ?>
            <?php Pjax::end() ?>
        </div>
    </div>
</div>