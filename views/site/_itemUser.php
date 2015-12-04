<?php
/**
 *
 */
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?= Html::beginTag('div', ['class' => 'col-xs-4 col-sm-4 col-md-4 col-lg-4',]); ?>
    <div class="well opacity" style="height: 90px;">
        <?php
        if ($model->avatar) {
            echo Html::img(Yii::$app->homeUrl . 'uploads/sm_' . $model->avatar,
                ['alt' => 'avatar', 'class' => 'img-rounded post-avatar']);
        } else {
            echo Html::img(Yii::$app->homeUrl . 'img/avatars/sm_default_avatar.png',
                ['alt' => 'avatar', 'class' => 'img-rounded post-avatar']);
        }
        ?>
        <div style="margin-top:13px;">
            <strong>
                <?= Html::a('@'. $model->username, Yii::$app->homeUrl . $model->id,
                    [ 'data-pjax'=>"0", 'style'=>['font-size'=>'16px']])
                ?>
            </strong>
        </div>
    </div>
<?= Html::endTag('div');?>