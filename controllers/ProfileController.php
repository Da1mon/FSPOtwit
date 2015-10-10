<?php
/**
 * Created by PhpStorm.
 * User: Ilya
 * Date: 08.10.2015
 * Time: 18:24
 */

namespace app\controllers;

use app\models\ProfileChangeForm;
use app\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;

class ProfileController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index', [
            'model' => $this->findModel(),
        ]);
    }

    /**
     * @return User the loaded model
     */
    private function findModel()
    {
        return User::findOne(Yii::$app->user->identity->getId());
    }

    public function actionUpdate()
    {
        $model = $this->findModel();
        $model2 = new ProfileChangeForm($model);

        $model->scenario = User::SCENARIO_PROFILE;


        if($model->load(Yii::$app->request->post()) &&  $model->save()) {
            return $this->redirect(['index']);
        }
        if ($model2->load(Yii::$app->request->post()) &&  $model2->changePassword()) {
            return $this->redirect(['index']);
        }
        return $this->render('update',['model'=>$model,'model2'=>$model2]);

    }
}