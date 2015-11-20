<?php
/**
 * Created by PhpStorm.
 * User: Ilya
 * Date: 19.11.2015
 * Time: 20:55
 */
use yii\helpers\Html;
?>
<?= Html::a('Отписаться', ['site/unsubscribe'], [
        'class' => 'btn btn-default btn-lg btn-block',
        'id' => 'unsubscribe',
        'format' => 'raw',
        'data-user-id' => $id,
        'data-pjax'=> 0,
        'style' => ['background-color' => '#E5E5E5'],
    ]);
?>