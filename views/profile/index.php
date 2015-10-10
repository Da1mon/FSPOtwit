<?php
/**
 * Created by PhpStorm.
 * User: Ilya
 * Date: 09.10.2015
 * Time: 15:06
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile">

   <div class="row">
       <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
           <?= DetailView::widget([
               'model' => $model,
               'attributes' => [
                   'username',
                   'email',
               ],
           ]) ?>
       </div>
   </div>
    <p>
        <?= Html::a('Редактировать', ['update'], ['class' => 'btn btn-primary']) ?>
    </p>
</div>
