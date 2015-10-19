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

$this->title = 'Профиль';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile">

   <div class="row">
       <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
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
           ]) ?>
           <p class="pull-right">
               <?= Html::a('Редактировать', ['update'], ['class' => 'btn btn-primary']) ?>
           </p>
       </div>
       <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
           <?= Widget::widget([
               // шаблон отображения
               'template' => '<div class="user-image">{face}</div>',
               // Поле текущего изображения
               'faceField' => 'avatar',
               // Массив Данных пользователя
               'data' => $model,
               // Url адрес с загруженными аватарками
               'faceUrl' => '/FSPOtwit/web/uploads',
               // Директория с загруженными аватарками на сервере
               //'facePath' => '/basic/web/uploads',
               // Url адрес с аватарками по умолчанию
               'faceUrlDefault' => '/FSPOtwit/web/img/avatars',
               // Дефолтная аватарка
               'faceDefault' => 'default_avatar.png',
               'faceImgOptions' => ['class' => 'img-rounded'],

           ]);?>
       </div>
   </div>
</div>
