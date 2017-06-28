<?php
use yii\helpers\Html;
use yii\grid\GridView;
$this->title = 'List of orders';
$this->params['breadcrumbs'][] = '';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-12">
                <h2><?= $this->title; ?> <?= Html::a('Add new order', ['/order/add'], ['class'=>'btn btn-primary ']) ?></h2>
                   <?php
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchmodel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'user.displayname:text:User Name',
                            'product.Product:text:Product Name',
                            [
                                'attribute'=>'Quantity',
                                'filter'=>false,
                            ],
                            [
                                'attribute'=>'DisplayPrice',
                                'label'=> 'Price',
                                'filter'=>false,
                            ],
                            [
                                'attribute'=>'DisplayTotal',
                                'label'=>'Total',
                                'filter'=>false,
                            ],
                            [
                                'attribute'=>'Created_date',
                                'filter'=>array("1"=>"All time","2"=>"Last 7 days","3"=>"Today"),
                            ],
                            ['class' => 'yii\grid\ActionColumn','template'=>'{update}{delete}'],
                        ]
                    ]);
                ?>
            </div>
        </div>
    </div>
</div>
