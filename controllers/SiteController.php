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
use app\models\Comment;
use yii\web\Response;
use yii\data\ActiveDataProvider;
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

                $dataProvider = new ActiveDataProvider([
                    'query' => Post::find()
                        ->where(['author_id' => $id])
                        ->with('author','comments')
                        ->orderBy('id DESC'),
                ]);

                $addPostFlag = false;
                $post = new Post();

                if ($id == $userID) {

                    $post->author_id =  $userID;
                    $addPostFlag = true;
                    if ($post->load(Yii::$app->request->post()) && $post->save()) {
                        $post = new Post();
                    }
                }

                return $this->render('userPage', ['listDataProvider' => $dataProvider, 'post' => $post, 'addPostFlag' => $addPostFlag]);
            } else {
                return $this->redirect(Yii::$app->homeUrl . $userID);
            }
        }
        return $this->render('index');
    }

    public function actionComment(){
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $postId = (int)$_POST['postId'];
            $authorId = (int)$_POST['authorId'];
            $comment = new Comment();
            $comment->post_id = $postId;
            $html = $this->renderPartial('_commentForm', [
                'comment' => $comment,
                'postId' => $postId,
                'authorId' =>  $authorId,
            ]);
            return array(
                'id' => $postId,
                'html' => $html,
            );
        }
        return $this->goHome();
    }

    public function actionSendComment($id = null){

        $model = new  Comment();
        $model->load(Yii::$app->request->get());
        $model->author_id = Yii::$app->user->getId();
        $model->post_id = (int)$model->post_id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $post = new Post();
            $dataProvider = new ActiveDataProvider([
                'query' => Post::find()->where(['author_id' =>$id])->with('author','comments')->orderBy('id DESC'),
            ]);
            return $this->render('userPage', ['listDataProvider' => $dataProvider, 'post' => $post,'addPostFlag' => true]);
        }
        $this->goHome();
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
