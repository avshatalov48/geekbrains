<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "user_subscription".
 *
 * @property int $id
 * @property int $user_id
 * @property string $email
 * @property int $created_at
 * @property int $updated_at
 */
class UserSubscription extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_subscription';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'email'], 'required'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['email'], 'string', 'max' => 64],
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
            'email' => 'Email',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @inheritdoc
     * @return UserSubscriptionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserSubscriptionQuery(get_called_class());
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }


}
