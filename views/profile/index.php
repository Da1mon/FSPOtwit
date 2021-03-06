<?php
/**
 * Created by PhpStorm.
 * User: Ilya
 * Date: 09.10.2015
 * Time: 15:06
 */
use yii\helpers\Html;
use yii\widgets\DetailView;
use nepster\faceviewer\Widget;
/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $pathToUserImg */
/* @var $pathToDefaultImg */
$this->title = 'Профиль';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile">

    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="well opacity">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'username',
                        'email',
                        'firstname',
                        'lastname',
                    ],
                    'formatter' => [
                        'class' => '\yii\i18n\Formatter',
                        'nullDisplay' => 'Не указано',
                    ],
                    'options' => [
                        'class' => 'table table-hover',
                        'style' => 'background-color: white;',
                    ],
                ]) ?>
                <?= Html::a('Редактировать', ['update'], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="well opacity">
                <?= Widget::widget([
                    // шаблон отображения
                    'template' => '<div class="user-image">{face}</div>',
                    // Поле текущего изображения
                    'faceField' => 'avatar',
                    // Массив Данных пользователя
                    'data' => $model,
                    // Url адрес с загруженными аватарками
                    'faceUrl' => $pathToUserImg,
                    // Директория с загруженными аватарками на сервере
                    //'facePath' => $path,
                    // Url адрес с аватарками по умолчанию
                    'faceUrlDefault' => $pathToDefaultImg,
                    // Дефолтная аватарка
                    'faceDefault' => 'default_avatar.png',
                    'faceImgOptions' => ['class' => 'img-rounded'],
                ]);?>
            </div>
        </div>
    </div>
</div>