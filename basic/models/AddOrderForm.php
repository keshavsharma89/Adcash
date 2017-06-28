<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class AddOrderForm extends Model
{
    public $user;
    public $product;
    public $quantity;



    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // all the 3 feilds are required
            [['user', 'product', 'quantity'], 'required'],
            [['quantity'], 'integer'],
        ];
    }

    /**
     * This function will insert new order to the order table 
     * and at the same time we can edit them too.
     * $id will contain the Order Id if we need to edit any
     * incase of no id we will create a new record in the table
     */
    public function add($id=0)
    {
        if ($this->validate()) {
            if($id==0){
				//$id is zero, that means we will need to create a new entry in the database
				$order= new Orders;
			}else{
				// selecting the correct orderid which we need to update
				$order= Orders::find()->where(['Id'=>$id])->one();
			}
            
            $order->User_id=$this->user;
            $order->Product_id=$this->product;
            /*
             * getPrice function will get the current product price,
             * we are saving the current price in order table, because it is possible that we may change product price
             * */
            $order->Price=$this->getPrice();
            $order->Quantity=$this->quantity;
            /*
             * We will use getTotal function to find the exact total amount need to be paid,
             * We will also check if there is any discouct that apply to this order 
             * This function will return floating point number after all the calculations
             * */ 
            $order->Total=$this->getTotal();
            return $order->save();
        }
        return false;
    }
    
    /*
     * We will use this function to find the current values in the table while we try to update any order
     * */
    public function findOrder($id)
    {
        $order=Orders::find()->where(['Id'=>$id])->one();
        $this->user=$order->User_id;
        $this->product=$order->Product_id;
        $this->quantity=$order->Quantity;
        return true;
    }

    /**
     * This function will do all the calculations
     * we will mutiple the number of item with price
     * apply discount if applicable
     * then return the total amount for the order
     */
    public function getTotal()
    {
        $price=$this->getPrice();
        $subtotal=$price*$this->quantity;
        
        // we will see if a dicount is available for this product with this quantity
        $discount = Discounts::find()->select(['Discount_percentage'])->where("Product_id = $this->product and Minimum_items <=  $this->quantity")->orderBy(['Minimum_items'=> SORT_DESC])->asArray()->one();
        if(isset($discount['Discount_percentage']) && $discount['Discount_percentage']!=''){
            $percentage=$discount['Discount_percentage'];        
            $total=$subtotal-($subtotal*$percentage/100);
            return $total;
        }else{
            return $subtotal;
        }
    }

    /**
     * Find Current Price of the selected ProductID
     * @return number
     */
    public function getPrice()
    {
        $price = Products::find()->select(['Price'])->where(['Id'=>$this->product])->asArray()->one();
        return $price['Price'];
    }
}
