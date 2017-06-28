<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Orders;

/**
 * OrderSearch represents the model behind the search form about `app\models\Orders`.
 */
class OrderSearch extends Orders
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'User_id', 'Product_id', 'Quantity', 'Is_cancel'], 'integer'],
            [['Price', 'Total'], 'number'],
            [['Created_date', 'user.displayname', 'product.Product'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    
    public function attributes()
    {
        return array_merge(parent::attributes(), ['user.displayname', 'product.Product']);
    }

    /**
     * Creates data provider instance with search query applied
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = orders::find()->joinWith('product')->joinWith('user')->where(['Is_cancel'=>0]);

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ]
        ]);
        
        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(['LIKE', 'Products.Product', $this->getAttribute('product.Product')])
            ->andFilterWhere(['or',
                ['LIKE', 'Users.First_name', $this->getAttribute('user.displayname')],
                ['LIKE', 'Users.Last_name', $this->getAttribute('user.displayname')]
            ]);
            
            
            switch($this->Created_date){
                case 2:
                    $query->andFilterWhere(['>=', 'Orders.Created_date', date('Y-m-d', strtotime('-7 days'))]);
                    break;
                case 3:
                    $query->andFilterWhere(['>=', 'Orders.Created_date', date('Y-m-d')]);
                    break;
                default:
            }

        return $dataProvider;
    }
}
