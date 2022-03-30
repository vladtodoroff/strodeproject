<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shippers".
 *
 * @property int $shipper_id
 * @property string $name
 *
 * @property Orders[] $orders
 */
class Shippers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shippers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'shipper_id' => 'Shipper ID',
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
        return $this->hasMany(Orders::className(), ['shipper_id' => 'shipper_id']);
    }
}
