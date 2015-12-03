<?php

namespace app\controllers;
use yii\data\ActiveDataProvider;
use app\models\Post;
use app\models\Subscription;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use app\models\Comment;
use app\models\LikePost;
use yii\helpers\Url;

class FeedController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $subs = Subscription::findBySql('SELECT subscription_user_id FROM ft_subscription WHERE user_id ='. Yii::$app->user->getId())->asArray()
            ->all();

        $ids = ArrayHelper::getColumn($subs, 'subscription_user_id');
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->where(['author_id' =>$ids]) ->with(['author','comments','likes' => function ($query) {
                $query->andWhere(['user_id' => Yii::$app->user->identity->getId()]);
            },
            ])
                ->orderBy('created_at DESC'),
        ]);
        return $this->render('index',['listDataProvider' => $dataProvider]);
    }

    public function actionComment(){
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $postId = (int)$_POST['postId'];
            $comment = new Comment();
            $comment->post_id = $postId;
            $html = $this->renderPartial('_commentForm', [
                'comment' => $comment,
                'postId' => $postId,
            ]);
            return array(
                'id' => $postId,
                'html' => $html,
            );
        }
        return $this->goHome();
    }

    public function actionSendComment(){

        $model = new  Comment();
        $model->author_id = Yii::$app->user->getId();
        $model->post_id = (int)$model->post_id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $subs = Subscription::findBySql('SELECT subscription_user_id FROM ft_subscription WHERE user_id ='. Yii::$app->user->getId())->asArray()
                ->all();
            $ids = ArrayHelper::getColumn($subs, 'subscription_user_id');
            $dataProvider = new ActiveDataProvider([
                'query' => Post::find()->where(['author_id' =>$ids]) ->with(['author','comments','likes' => function ($query) {
                        $query->andWhere(['user_id' => Yii::$app->user->identity->getId()]);
                    },
                ])
                ->orderBy('created_at DESC'),
            ]);
            return $this->render('index',['listDataProvider' => $dataProvider]);
        }
        return $this->goHome();
    }

    public function actionEditCommentForm($id){
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model = Comment::findOne($id);
            $html = $this->renderPartial('_editCommentForm', ['model' => $model]);
            return array(
                'id' => $id,
                'html' => $html,
            );
        }
        return false;
    }
    public function actionEditComment($id){
        $model = Comment::findOne($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $subs = Subscription::findBySql('SELECT subscription_user_id FROM ft_subscription WHERE user_id ='. Yii::$app->user->getId())->asArray()
                ->all();
            $ids = ArrayHelper::getColumn($subs, 'subscription_user_id');
            $dataProvider = new ActiveDataProvider([
                'query' => Post::find()->where(['author_id' =>$ids]) ->with(['author','comments','likes' => function ($query) {
                    $query->andWhere(['user_id' => Yii::$app->user->identity->getId()]);
                    },
                ])
                ->orderBy('created_at DESC'),
            ]);
            return $this->render('index',['listDataProvider' => $dataProvider]);
        }
        return $this->goHome();
    }

    public function actionDeleteComment($id){
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $post = Comment::findOne($id);
            $post->delete();
            return $id;
        }
        return false;
    }

    public function actionChange() {
        $dataProvider = new ActiveDataProvider([
            'query' => Subscription::find()->where(['user_id'=>Yii::$app->user->getId()])->with('subscriptionUser'),
        ]);
        return $this->render('changeSubscription',['listDataProvider' => $dataProvider]);
    }

    public function actionUnsubscribe($id) {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $subscription = Subscription::findOne($id);
            $subscription->delete();
            return $id;
        }
        return false;
    }

    public function actionLike($id){
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $like = new LikePost();
            $like->user_id = Yii::$app->user->getId();
            $like->post_id = $id;
            $like->save();
            return array(
                'id' => $id,
                'counter' => $like->post->like_counter,
                'href' => Url::to(['feed/dislike', 'id' =>  $id]),
            );
        }
        return false;
    }

    public function actionDislike($id){
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $like = LikePost::find()->where(['user_id'=> Yii::$app->user->getId(), 'post_id' => $id])->one();
            $like->delete();
            return array(
                'id' => $id,
                'counter' => $like->post->like_counter,
                'href' => Url::to(['feed/like', 'id' =>  $id]),
            );
        }
        return false;
    }

}
