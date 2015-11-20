<?php
/* @var $this yii\web\View */
use yii\widgets\Pjax;
use yii\widgets\ListView;
use yii\helpers\Html;
$this->registerJsFile(
    Yii::$app->homeUrl.'scripts/comment.js',
    ['depends'=>'app\assets\AppAsset']
);

?>
<div class="row">
    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
        <?=  Html::a('Изменить', ['feed/change'], [
            'class' => 'btn btn-default btn-lg btn-block opacity',
            'format' => 'raw',
            'data-pjax'=> 0,
        ]); ?>
    </div>
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <div id="posts">
            <?php Pjax::begin(['id' => 'notes','enablePushState' => false]) ?>
            <?= ListView::widget([
                'dataProvider' => $listDataProvider,
                'layout' => "{items}",
                'itemView' => function ($model, $key, $index, $widget) {
                    return $this->render('_post',['model' => $model]);
                },
            ]);
            ?>
            <?php Pjax::end() ?>
        </div>
    </div>
</div>