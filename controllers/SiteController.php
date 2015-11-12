<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\Post;


class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex($id = null)
    {
        if (!Yii::$app->user->isGuest) {
            $userID = Yii::$app->user->identity->getId();
            if ($id && ($user = User::findIdentity($id))) {
                $posts = Post::find()
                    ->where(['author_id' => $id])
                    ->orderBy('created_at DESC')
                    ->all();

                if ($id == $userID) {
                    $post = new Post();
                    $post->author_id = $id;

                    if ($post->load(Yii::$app->request->post()) && $post->save()) {
                        return $this->refresh();
                    }

                    return $this->render('userPage', ['posts' => $posts, 'post' => $post, 'user'=> $user]);
                } else {
                    return $this->render('anotherUserPage', ['posts' => $posts, 'user'=> $user]);
                }


            } else {
                return $this->redirect(Yii::$app->homeUrl . $userID);
            }
        }
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSay($message = 'привет мир')
    {
        return $this->render('say', ['message' => $message]);
    }

    public function actionSignup()
    {
        return $this->render('signup');
    }
}
