<?php
/**
 * Created by PhpStorm.
 * User: Ilya
 * Date: 05.10.2015
 * Time: 20:38
 */
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['/default/email-confirm', 'token' => $user->email_confirm_token]);
?>

hello, <?= Html::encode($user->username) ?>!

Для подтверждения адреса пройдите по ссылке:

<?= Html::a(Html::encode($confirmLink), $confirmLink) ?>

Если Вы не регистрировались у на нашем сайте, то просто удалите это письмо.