<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\modules\admin\models\User */

$this->title = "Admin-панель";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-default-index">

        <h1><?= Html::encode($this->title) ?></h1>
    <div class="well">
        <?= Html::a("Пользователи", ['users/index'], ['class' => 'btn btn-lg btn-primary', 'style'=> 'margin-right:15px;']) ?>
        <?= Html::a("Публикации", ['posts/index'], ['class' => 'btn btn-lg btn-primary', 'style'=> 'margin-right:15px;']) ?>
        <?= Html::a("Комментарии", ['comments/index'], ['class' => 'btn btn-lg btn-primary', 'style'=> 'margin-right:15px;']) ?>
    </div>
</div>
