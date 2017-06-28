<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Orders".
 *
 * @property integer $Id
 * @property integer $User_id
 * @property integer $Product_id
 * @property double $Price
 * @property integer $Quantity
 * @property double $Total
 * @property integer $Is_cancel
 * @property string $Created_date
 *
 * @property Products $product
 * @property Users $user
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['User_id', 'Product_id', 'Quantity'], 'required'],
            [['User_id', 'Product_id', 'Quantity', 'Is_cancel'], 'integer'],
            [['Price', 'Total'], 'number'],
            [['Created_date'], 'safe'],
            [['Product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['Product_id' => 'Id']],
            [['User_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['User_id' => 'Id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'User_id' => 'User ID',
            'Product_id' => 'Product ID',
            'Price' => 'Price',
            'Quantity' => 'Quantity',
            'Total' => 'Total',
            'Is_cancel' => 'Is Cancel',
            'Created_date' => 'Created Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['Id' => 'Product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['Id' => 'User_id']);
    }
    
    public function getDisplayPrice()
    {
		return $this->Price." EUR";
	}
    
    public function getDisplayTotal()
    {
		return $this->Total." EUR";
	}
    
    public function getDisplayCreatedate()
    {
		return date('d M Y, g:i a', strtotime($this->Created_date));
	}
}
