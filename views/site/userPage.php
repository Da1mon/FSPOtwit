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
?>
<div class="user-index">
    <div class="row">
        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2">
            <div class="well opacity">
                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($post, 'content')->textarea(['maxlength' => true, 'rows' => 2]) ?>
                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
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