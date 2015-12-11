<?php
/**
 * Created by PhpStorm.
 * User: Ilya
 * Date: 10.12.2015
 * Time: 20:18
 */

namespace app\common\grid;
use yii\grid\DataColumn;

class StatusColumn extends DataColumn
{
    public $contentOptions = [
        'class' => 'status-column',
    ];
}