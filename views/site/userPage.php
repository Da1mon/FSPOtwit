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

$this->registerJsFile(
    Yii::$app->homeUrl.'scripts/comment.js',
    ['depends'=>'app\assets\AppAsset']
);
?>
<?php if ($addPostFlag): ?>
    <div class="user-index">
        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2">
                <div class="well opacity">
                    <?php Pjax::begin(['id' => 'new_post', 'enablePushState' => false]) ?>
                    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true],'id'=>'new-post-form']); ?>
                    <?= $form->field($post, 'content')->textarea(['maxlength' => true, 'rows' => 2])->label('новая публикация') ?>
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
                    <?php ActiveForm::end(); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
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
