<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[OrderItems]].
 *
 * @see OrderItems
 */
class OrdersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OrderItems[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OrderItems|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
