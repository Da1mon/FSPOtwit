<?php
/**
 * Created by PhpStorm.
 * User: Ilya
 * Date: 12.11.2015
 * Time: 1:05
 */
/* @var $posts app\models\Post */
/* @var $user app\models\User */
use yii\helpers\Html;
?>
<div class="user-index">
    <?php foreach ($posts as $currentPost): ?>
        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2">
                <div class="well opacity padding-fix">
                    <?php
                    if($user->avatar) {
                        echo Html::img( Yii::$app->homeUrl.'uploads/sm_'. $user->avatar, ['alt'=>'avatar', 'class'=>'img-rounded post-avatar']);
                    } else {
                        echo Html::img( Yii::$app->homeUrl.'img/avatars/sm_default_avatar.png', ['alt'=>'avatar', 'class'=>'img-rounded post-avatar']);
                    } ?>
                    <p>
                        <strong>
                            <?php echo Html::a( $user->firstname .' '. $user->lastname, Yii::$app->homeUrl. $user->id ) ?>
                        </strong>
                    </p>
                    <div class="post-content"><?php echo $currentPost->content ?></div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>