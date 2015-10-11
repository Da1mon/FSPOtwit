<?php
/**
 * Created by PhpStorm.
 * User: Ilya
 * Date: 07.10.2015
 * Time: 21:40
 */
use yii\helpers\Html;

?>
<div class="user-index">
    <div class="jumbotron">
        <h1>
            Привет, <?= Html::encode($username) ?>!
        </h1>
        <p class="lead">Вы находитесь на главной странице сервиса <strong>FSPOtwit</strong></p>
    </div>
</div>