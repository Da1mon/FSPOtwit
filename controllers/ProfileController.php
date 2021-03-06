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
use yii\imagine\Image;

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
        $model = $this->findModel();
        $pathToUserImg = Yii::$app->homeUrl . 'uploads';
        $pathToDefaultImg = Yii::$app->homeUrl . 'img/avatars';
        return $this->render('index', [
            'model' => $model,
            'pathToUserImg' => $pathToUserImg,
            'pathToDefaultImg' => $pathToDefaultImg,
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

        $model3 = new UserUploadAvatarForm($model);

        if($model->load(Yii::$app->request->post()) &&  $model->save()) {
            Yii::$app->getSession()->setFlash('success', 'Параметры успешно изменены.');
            return $this->redirect(['index']);
        }
        if ($model2->load(Yii::$app->request->post()) &&  $model2->changePassword()) {
            Yii::$app->getSession()->setFlash('success', 'Пароль успешно изменен.');
            return $this->redirect(['index']);
        }

        if ($model3->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstance($model3, 'file');
            if (!is_null($image)) {
                // save with image
                // store the source file name
                $model3->filename = $image->name;
                $ext = end(explode(".", $image->name));
                // generate a unique file name to prevent duplicate filenames
                $model3->avatar = Yii::$app->security->generateRandomString().".{$ext}";
                // the path to save file, you can set an uploadPath
                // in Yii::$app->params (as used in example below)
                Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/';
                $path = Yii::$app->params['uploadPath']  . $model3->avatar;
                //$model->user_id = Yii::$app->user->getId();
                //if($model->update()){
                $image->saveAs($path);
                Image::thumbnail(Yii::$app->params['uploadPath'].$model3->avatar, 222, 222)
                    ->save(Yii::$app->params['uploadPath'].'sqr_'.$model3->avatar, ['quality' => 100]);
                Image::thumbnail(Yii::$app->params['uploadPath'].$model3->avatar, 50, 50)
                    ->save(Yii::$app->params['uploadPath'].'sm_'.$model3->avatar, ['quality' => 100]);
                $model3->updateUser();

            }
        }
        return $this->render('update',['model'=>$model,'model2'=>$model2, 'model3'=>$model3]);

    }
}