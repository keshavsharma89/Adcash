<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Users".
 *
 * @property integer $Id
 * @property string $First_name
 * @property string $Last_name
 * @property string $Email
 * @property string $Created_date
 *
 * @property Orders[] $orders
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['First_name', 'Last_name', 'Email'], 'required'],
            [['Created_date'], 'safe'],
            [['First_name', 'Last_name', 'Email'], 'string', 'max' => 225],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'First_name' => 'First Name',
            'Last_name' => 'Last Name',
            'Email' => 'Email',
            'Created_date' => 'Created Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['User_id' => 'Id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisplayName()
    {
        return $this->First_name." ".$this->Last_name;
    }
}
