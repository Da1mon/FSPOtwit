<?php
/**
 * Created by PhpStorm.
 * User: Ilya
 * Date: 10.12.2015
 * Time: 19:49
 */

namespace app\common\grid;


class ActionColumn extends \yii\grid\ActionColumn
{
    public $contentOptions = [
        'class' => 'action-column',
    ];
}