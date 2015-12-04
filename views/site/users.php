<?php
/**
 *
 * @var \yii\data\ActiveDataProvider $listDataProvider
 */

use yii\widgets\ListView;
$this->registerJsFile(
    Yii::$app->homeUrl.'scripts/changeSubscription.js',
    ['depends'=>'app\assets\AppAsset']
);
$this->title = 'Пользователи';
?>
<div class="row">
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2">
        <div class="row" id="subscriptions">
            <?= ListView::widget([
                'dataProvider' => $listDataProvider,
                'layout' => "{items}",
                'itemView' => function ($model, $key, $index, $widget) {
                    return $this->render('_itemUser',['model' => $model]);
                },
            ]);
            ?>
        </div>
    </div>
</div>