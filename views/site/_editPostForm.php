<?php
/**
 * Created by PhpStorm.
 * User: Ilya
 * Date: 27.11.2015
 * Time: 21:43
 */
use yii\widgets\ActiveForm;
use yii\bootstrap\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
?>
<?php Pjax::begin(['id'=>'edit-post','class' => 'edit-post', 'enablePushState' => false,]) ?>
    <?php $form = ActiveForm::begin(['method'=>'post','action' => Url::to(['site/edit-post','id' =>  $model->id]),'options' => ['data-pjax' => true]]); ?>
    <?= $form->field($model, 'content')->textarea(['maxlength' => true, 'rows' => 2])->label(false) ?>
    <?= Html::submitButton('Редактировать', ['class' => 'btn btn-primary edit-post']) ?>
    <?php ActiveForm::end();?>
<?php Pjax::end() ?>