<?php
/**
 * Created by PhpStorm.
 * User: Ilya
 * Date: 09.10.2015
 * Time: 15:46
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $model2 app\models\PasswordChangeForm */
/* @var $model3 app\models\UserUploadAvatarForm */

$this->title = 'Редактирование';
$this->params['breadcrumbs'][] = ['label' => 'Профиль', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-update">

    <div class="user-form">
        <div class="row">
            <div class="col-lg-5">
                <div class="well opacity">
                <h3 class="page-header" style="margin-top: 10px;">Основные Параметры</h3>
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
                <h3 class="page-header" style="margin-top: 10px;">Личные данные</h3>
                <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>


                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>

                <h3 class="page-header">Смена пароля</h3>
                <?php $form2 = ActiveForm::begin(); ?>

                <?= $form2->field($model2, 'currentPassword')->passwordInput(['maxlength' => true]) ?>
                <?= $form2->field($model2, 'newPassword')->passwordInput(['maxlength' => true]) ?>
                <?= $form2->field($model2, 'newPasswordRepeat')->passwordInput(['maxlength' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Сменить пароль', ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="well opacity">
                    <h3 class="page-header" style="margin-top: 10px;" >Загрузить аватар</h3>
                    <?php $form3 = ActiveForm::begin([
                        'options'=>['enctype'=>'multipart/form-data'] // important
                    ]); ?>
                    <?= $form3->field($model3, 'file')->widget(FileInput::classname(), [
                        'options' => ['accept' => 'image/*'],
                        'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png']],
                    ])
                    ->label(false);   ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>

</div>