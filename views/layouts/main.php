<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?php
    $path = Yii::$app->homeUrl . 'img/Background.jpg';
    $options = [
        'class' => ['wrap', 'background-img' ],
        'style' => 'background-image:url('. $path .')',
    ];
    echo Html::beginTag('div', $options);
?>
    <?php
    NavBar::begin([
        'brandLabel' => 'FSPOtwit',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);

    $menuItems = [];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Регистрация', 'url' => ['/default/signup']];
        $menuItems[] = ['label' => 'Вход', 'url' => ['/default/login']];
    } else {
        if(Yii::$app->user->identity->admin == \app\models\User::STATUS_ADMIN) {
            $menuItems[] =['label' => 'Admin-панель', 'items' => [
                ['label' =>'Admin-панель', 'url' => ['/admin/default/index']],
                ['label' => 'Пользователи', 'url' => ['/admin/users/index']],
                ['label' => 'Публикации', 'url' => ['/admin/posts/index']],
                ['label' => 'Коментарии', 'url' => ['/admin/comments/index']],
            ]];
        }
        $menuItems[] = ['label' => 'Пользователи', 'url' => ['/site/users']];
        $menuItems[] = ['label' => 'Подписки', 'url' => ['/feed/index']];
        $menuItems[] = ['label' => 'Профиль', 'url' => ['/profile/index']];
        $menuItems[] = [
            'label' => 'Выход (' . Yii::$app->user->identity->username . ')',
            'url' => ['/default/logout'],
            'linkOptions' => ['data-method' => 'post']

        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);


    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
<?php echo Html::endTag('div') ?>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Fspotwit <?= date('Y') ?></p>


    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
