<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Discounts".
 *
 * @property integer $Id
 * @property integer $Product_id
 * @property integer $Minimum_items
 * @property integer $Discount_percentage
 * @property string $Created_date
 */
class Discounts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Discounts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Product_id', 'Minimum_items', 'Discount_percentage'], 'required'],
            [['Product_id', 'Minimum_items', 'Discount_percentage'], 'integer'],
            [['Created_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Product_id' => 'Product ID',
            'Minimum_items' => 'Minimum Items',
            'Discount_percentage' => 'Discount Percentage',
            'Created_date' => 'Created Date',
        ];
    }
}
