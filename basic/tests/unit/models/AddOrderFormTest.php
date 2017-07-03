<?php
namespace tests\models;
use app\models\AddOrderForm;


class AddOrderFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \
     */
    protected $model;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // This function is to test the add new record script with the correct details
    public function testCorrectDetail()
    {
        $model= new AddOrderForm([ 
			'user' => 1,
            'product' => 1,
            'quantity' => 2
        ]);
        expect_that($model->add());
    }

    // Here we will try to add some wrong details, and single itration should not work in this function
    public function testWrongdetails()
    {
        // Quantity is non numeric
        $model= new AddOrderForm([ 
			'user' => 1,
            'product' => 1,
            'quantity' => 'asdf'
        ]);
        expect_not($model->add());
        
        // User Id is non numeric, This can not be done since we have a dropdown in HTML but still just in case
        $model= new AddOrderForm([ 
			'user' => 'abc',
            'product' => 1,
            'quantity' => 1
        ]);
        expect_not($model->add());

        // Product Id is non numeric, This can not be done since we have a dropdown in HTML but still just in case
        $model= new AddOrderForm([ 
			'user' => 1,
            'product' => 'xyz',
            'quantity' => 1
        ]);
        expect_not($model->add());

        // If both UserId and ProductId are non numeric
        $model= new AddOrderForm([ 
			'user' => 'abc',
            'product' => 'xyz',
            'quantity' => 1
        ]);
        expect_not($model->add());
        
        // Quantity is zero
        $model= new AddOrderForm([ 
			'user' => 1,
            'product' => 1,
            'quantity' => 0
        ]);
        expect_not($model->add());

        // Quantity is negative
        $model= new AddOrderForm([ 
			'user' => 1,
            'product' => 1,
            'quantity' => -1
        ]);
        expect_not($model->add());
    }
    
    // Test Edit function
    public function testEdit()
    {
        $model= new AddOrderForm([ 
			'user' => 1,
            'product' => 1,
            'quantity' => 2
        ]);
        expect_that($model->add(1));
    }
    
}
