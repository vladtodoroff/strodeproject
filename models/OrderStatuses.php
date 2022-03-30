<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_statuses".
 *
 * @property int $order_status_id
 * @property string $name
 *
 * @property Orders[] $orders
 */
class OrderStatuses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_statuses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_status_id', 'name'], 'required'],
            [['order_status_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['order_status_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_status_id' => 'Order Status ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['status' => 'order_status_id']);
    }
}
