<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public $layout = '@app/views/layouts/admin';
    public function actionIndex()
    {
        return $this->render('index');
    }
}
