<?php
/**
 * Created by PhpStorm.
 * User: Ilya
 * Date: 07.10.2015
 * Time: 1:03
 */
use yii\helpers\Html;
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['/default/password-reset', 'token' => $user->password_reset_token]);
?>

    <p>Hello <?= Html::encode($user->username) ?>,</p>

    <p>Follow the link below to reset your password:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>

