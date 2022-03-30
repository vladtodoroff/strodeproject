<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $order_id
 * @property int $customer_id
 * @property string $order_date
 * @property int $status
 * @property string|null $comments
 * @property string|null $shipped_date
 * @property int|null $shipper_id
 * @property int $is_deleted2
 * @property int $is_deleted
 *
 * @property Customers $customer
 * @property OrderItems[] $orderItems
 * @property Products[] $products
 * @property Shippers $shipper
 * @property OrderStatuses $status0
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'order_date'], 'required'],
            [['customer_id', 'status', 'shipper_id', 'is_deleted2', 'is_deleted'], 'integer'],
            [['order_date', 'shipped_date'], 'safe'],
            [['comments'], 'string', 'max' => 2000],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => OrderStatuses::className(), 'targetAttribute' => ['status' => 'order_status_id']],
            [['shipper_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shippers::className(), 'targetAttribute' => ['shipper_id' => 'shipper_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'customer_id' => 'Customer ID',
            'order_date' => 'Order Date',
            'status' => 'Status',
            'comments' => 'Comments',
            'shipped_date' => 'Shipped Date',
            'shipper_id' => 'Shipper ID',
            'is_deleted2' => 'Is Deleted2',
            'is_deleted' => 'Is Deleted',
        ];
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery|CustomersQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customers::className(), ['customer_id' => 'customer_id']);
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery|OrderItemsQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['order_id' => 'order_id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['id' => 'product_id'])->viaTable('order_items', ['order_id' => 'order_id']);
    }

    /**
     * Gets query for [[Shipper]].
     *
     * @return \yii\db\ActiveQuery|ShippersQuery
     */
    public function getShipper()
    {
        return $this->hasOne(Shippers::className(), ['shipper_id' => 'shipper_id']);
    }

    /**
     * Gets query for [[Status0]].
     *
     * @return \yii\db\ActiveQuery|OrderStatusesQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(OrderStatuses::className(), ['order_status_id' => 'status']);
    }

    /**
     * {@inheritdoc}
     * @return OrdersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrdersQuery(get_called_class());
    }
}
