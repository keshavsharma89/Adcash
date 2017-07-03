<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Products".
 *
 * @property integer $Id
 * @property string $Product
 * @property double $Price
 * @property string $Created_date
 *
 * @property Orders[] $orders
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Product', 'Price'], 'required'],
            [['Price'], 'number'],
            [['Created_date'], 'safe'],
            [['Product'], 'string', 'max' => 225],
            [['Product'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Product' => 'Product',
            'Price' => 'Price',
            'Created_date' => 'Created Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['Product_id' => 'Id']);
    }
}
