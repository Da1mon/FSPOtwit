<?php
/**
 * Created by PhpStorm.
 * User: Ilya
 * Date: 14.11.2015
 * Time: 23:42
 */
/* @var $comment app\models\Comment
 * @var $postId int;
 */
use yii\widgets\ActiveForm;
use yii\bootstrap\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
?>


<li class="comment-form">
    <?php Pjax::begin(['id'=>'new-comment','class' => 'new_comment', 'enablePushState' => false,]) ?>
        <?php $form = ActiveForm::begin(['method'=>'post','action' => Url::to(['site/send-comment', 'id' =>  $authorId]),'options' => ['data-pjax' => true],
        ]); ?>
        <?= $form->field($comment, 'post_id')->hiddenInput()->label(false);?>
        <?= $form->field($comment, 'content')->textarea(['maxlength' => true, 'rows' => 2,'style'=>['max-width'=>' 700px']])->label(false) ?>
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary new-comment']) ?>
        <?php ActiveForm::end();?>
    <?php Pjax::end() ?>
</li>