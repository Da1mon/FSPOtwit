<?php
/**
 * Created by PhpStorm.
 * User: Ilya
 * Date: 08.10.2015
 * Time: 18:24
 */

namespace app\controllers;

use app\models\PasswordChangeForm;
use app\models\User;
use app\models\UserUploadAvatarForm;
use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;
use yii\web\UploadedFile;

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
        $model->scenario = User::SCENARIO_PROFILE;

        $model2 = new PasswordChangeForm($model);

        $model3 = new UserUploadAvatarForm();

        if($model->load(Yii::$app->request->post()) &&  $model->save()) {
            Yii::$app->getSession()->setFlash('success', 'Параметры успешно изменены.');
            return $this->redirect(['index']);
        }
        if ($model2->load(Yii::$app->request->post()) &&  $model2->changePassword()) {
            Yii::$app->getSession()->setFlash('success', 'Пароль успешно изменен.');
            return $this->redirect(['index']);
        }
        if(Yii::$app->request->isPost) {
            $model3->file = UploadedFile::getInstance($model3, 'file');

            if ($model3->file && $model3->validate()) {
                $model3->file->saveAs('uploads/' . $model3->file->baseName . '.' . $model3->file->extension);
                return $this->redirect(['index']);
            }
        }
        return $this->render('update',['model'=>$model,'model2'=>$model2, 'model3'=>$model3]);

    }
}