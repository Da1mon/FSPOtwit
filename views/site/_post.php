<?php
/**
 * Created by PhpStorm.
 * User: Ilya
 * Date: 15.11.2015
 * Time: 19:28
 */
use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php
$user = $model->author;
$commentFlag = false;
if ($comments = $model->comments) {
    $commentFlag = true;
    echo Html::beginTag('div', ['class' => 'well opacity padding-fix', 'style' => 'margin-bottom:0px;', 'data' => ['post-id' => $model->id, 'author-id' => $user->id]]);
} else {
    echo Html::beginTag('div', ['class' => 'well opacity padding-fix', 'data' => ['post-id' => $model->id, 'author-id' => $user->id]]);
}
?>

<?php

if ($user->avatar) {
    echo Html::img(Yii::$app->homeUrl . 'uploads/sm_' . $user->avatar, ['alt' => 'avatar', 'class' => 'img-rounded post-avatar']);
} else {
    echo Html::img(Yii::$app->homeUrl . 'img/avatars/sm_default_avatar.png', ['alt' => 'avatar', 'class' => 'img-rounded post-avatar']);
}
?>
<?php if($user->id == Yii::$app->user->getId()) {
    echo Html::tag('div', '', [
        'class' => 'delete-post-btn',
        'style' => ['background'=>'url(' . Yii::$app->homeUrl . 'img/pics/statusx_op.gif' . ') 0 0 no-repeat'],
        'href' => Url::to(['site/delete-post', 'id' =>  $model->id]),
    ]);
} ?>
<p>
    <strong>
        <?php $userName = ($user->firstname&&$user->lastname) ?
            $user->firstname . ' ' . $user->lastname : '@'. $user->username   ?>
        <?= Html::a($userName, Yii::$app->homeUrl . $user->id,[ 'data-pjax'=>"0"]) ?>
    </strong>
</p>

<div class="post-content"><?php echo $model->content ?></div>
<?= Html::a('комментировать', ['site/comment'], [
    'class' => 'comment-btn pull-right',
    'format' => 'raw',
    'data-on-done' => 'simpleDone',
    'data-pjax'=>0,
]) ?>
<?= Html::endTag('div') ?>
<?php
if ($commentFlag) {
    echo Html::beginTag('ul', ['class' => 'post-comment-wrap']);
    echo Html::beginTag('div', ['class' => 'post-comments']);
}
foreach ($comments as $comment): ?>
    <li>
        <?php $commentAuthor = $comment->author;
        if ($commentAuthor->avatar) {
            echo Html::img(Yii::$app->homeUrl . 'uploads/sm_' . $commentAuthor->avatar, ['alt' => 'avatar', 'class' => 'img-rounded post-avatar']);
        } else {
            echo Html::img(Yii::$app->homeUrl . 'img/avatars/sm_default_avatar.png', ['alt' => 'avatar', 'class' => 'img-rounded post-avatar']);
        }
        ?>
        <p>
            <strong>
                <?php $commentName = ($commentAuthor->firstname&&$commentAuthor->lastname) ?
                    $commentAuthor->firstname . ' ' . $commentAuthor->lastname :
                    '@'. $commentAuthor->username   ?>
                <?= Html::a($commentName, Yii::$app->homeUrl . $commentAuthor->id,[ 'data-pjax'=>0]) ?>
            </strong>
        </p>

        <div class="post-content"><?php echo $comment->content ?></div>
    </li>
<?php
endforeach;
if ($commentFlag) {
    echo Html::endTag('div');
    echo Html::endTag('ul');
}
?>
