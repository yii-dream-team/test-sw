<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%order_item}}".
 *
 * @property integer $id
 * @property integer $order_id
 * @property string $price
 * @property string $description
 * @property integer $available
 */
class OrderItem extends ActiveRecord
{
    public $isDeleted = false;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'price', 'description'], 'required', 'when' => function($model) {
                return $model->isDeleted == false;
            }],
            [['order_id', 'available'], 'integer'],
            [['price'], 'number', 'min' => 0],
            [['description'], 'string', 'max' => 255],
            [['available', 'isDeleted'], 'boolean'],
        ];
    }

    public function scenarios()
    {
        return [
            static::SCENARIO_DEFAULT => ['price', 'description', 'available', 'isDeleted']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'price' => 'Price',
            'description' => 'Description',
            'available' => 'Available',
        ];
    }

    /**
     * Generate order_id
     * @return int
     */
    public static function generateOrderId()
    {
        return (int)static::find()->max('order_id') + 1;
    }
}
