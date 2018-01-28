<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[UserSubscription]].
 *
 * @see UserSubscription
 */
class UserSubscriptionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return UserSubscription[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UserSubscription|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
