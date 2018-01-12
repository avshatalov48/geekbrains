<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "session".
 *
 * @property string $sid
 * @property int $user_id
 * @property string $last_update
 * @property string $create_date
 *
 * @property User $user
 */
class Session extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'session';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sid'], 'required'],
            [['user_id'], 'integer'],
            [['last_update', 'create_date'], 'safe'],
            [['sid'], 'string', 'max' => 64],
            [['sid'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sid' => 'Sid',
            'user_id' => 'User ID',
            'last_update' => 'Last Update',
            'create_date' => 'Create Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return SessionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SessionQuery(get_called_class());
    }
}
