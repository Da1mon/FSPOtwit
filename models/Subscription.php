<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%subscription}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $subscription_user_id
 *
 * @property User $subscriptionUser
 * @property User $user
 */
class Subscription extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%subscription}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'subscription_user_id'], 'required'],
            [['user_id', 'subscription_user_id'], 'integer'],
            [['subscription_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['subscription_user_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'subscription_user_id' => 'Subscription User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubscriptionUser()
    {
        return $this->hasOne(User::className(), ['id' => 'subscription_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
