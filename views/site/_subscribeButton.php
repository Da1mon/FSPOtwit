<?php
/**
 * Created by PhpStorm.
 * User: Ilya
 * Date: 19.11.2015
 * Time: 20:55
 */
use yii\helpers\Html;
?>
<?= Html::a('Подписаться', ['site/subscribe'], [
        'class' => 'btn btn-primary btn-lg btn-block',
        'id' => 'subscribe',
        'format' => 'raw',
        'data-user-id' => $id,
        'data-pjax' => 0,
    ]);
?>