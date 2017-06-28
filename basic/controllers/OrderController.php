<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

use app\models\AddOrderForm;
use app\models\Users;
use app\models\Products;
use app\models\Orders;
use app\models\OrderSearch;


use yii\grid\GridView;
use yii\data\ActiveDataProvider;

class OrderController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    
    /*
     * This function will return the array for all available user 
     * */
    public function userDropdown()
    {
        // we will fetch all the user firstname and last name combine then and use Id as the key to our dropdown
        $userlist= Users::find()->select(['Id', 'First_name', 'Last_name'])->asArray()->all();
        foreach($userlist as $user){
            $users[$user['Id']]=$user['First_name']." ".$user['Last_name'];
        }
        return $users;
    }
    
    /*
     * This function will return the array for all available user 
     * */
    public function productDropdown()
    {
        // Similarly we will the same with products what we did with users, to create perfect array that we need for product dropdown
        $productlist= Products::find()->select(['Id', 'Product'])->asArray()->all();
        foreach($productlist as $product){
            $products[$product['Id']]=$product['Product'];
        }
        return $products;
    }
    
    
    /**
     * Displays page for add new order.
     * AddOrderForm is custom model create specialy to add new orders to the database
     * @return string
     */
    public function actionAdd()
    {
        $model =new AddOrderForm();
        $users=$this->userDropdown();
        $products=$this->productDropdown();
        
        $message= '';
        /*
         * On submit we will save order to database using add function and show success message when done.
         * add is defined in model AddOrderForm
         * */ 
        if($model->load(Yii::$app->request->post()) && $model->add()){
            $message= "Order saved successfully";
        }
        
        return $this->render('add', [
            'model' => $model,
            'userlist' =>$users,
            'productlist' =>$products,
            'message' =>$message,
        ]);
    }
    
    
    /**
     * Displays page for add new order.
     * AddOrderForm is custom model create specialy to add new orders to the database
     * @return string
     */
    public function actionUpdate($id)
    {
        $model= new AddOrderForm;
        $model->findOrder($id);
        
        //$model = Orders::find()->where(['Id'=>$id])->one();
        $users=$this->userDropdown();
        $products=$this->productDropdown();
        $message= '';
        // on submit we will save order to database using add function and show success message when done.
        if($model->load(Yii::$app->request->post()) && $model->add($id)){ 
            $message= "Order edited successfully";
        }
        
        return $this->render('update', [
            'model' => $model,
            'userlist' =>$users,
            'productlist' =>$products,
            'message' =>$message,
        ]);
    }
    
    /*
     * This function is used to delete the orders.
     * we do not actully delete the record form table,
     * but we use logical delition, we use flag Is_cancel for that
     * */
    public function actionDelete($id)
    {
        $model=orders::findone($id);
        $model->Is_cancel=1;
        $model->save();
        /*
         * Once the deletion is done we will redirect back to the main list
         * from where we got the trigure to delete in the first place.
         * */
        return $this->redirect(['list']);
    }
    
    /*
     * This fucntion is used to show the complete listing of the orders
     * */
    public function actionList()
    {
        $ordersearch= new ordersearch();
        $dataProvider = $ordersearch->search(Yii::$app->request->get());
        
        return $this->render('list', [
            'dataProvider' => $dataProvider,
            'searchmodel' => $ordersearch
        ]);
    }
}
