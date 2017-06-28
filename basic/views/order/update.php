<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Edit order';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-12">
                <?php if(isset($message) && $message!=''){ ?>
                    <div class="alert alert-success">
                        <strong><?= $message?></strong>
                    </div>
                <?php } ?>
                <h2><?= Html::encode($this->title) ?></h2>
                <?php $form = ActiveForm::begin([
                        'id' => 'add-form',
                        'layout' => 'horizontal',
                        'fieldConfig' => [
                            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                            'labelOptions' => ['class' => 'col-lg-1 control-label'],
                        ],
                ]); ?>
                    <?= $form->field($model, 'user')->dropDownList($userlist, ['prompt'=>'Select Username']); ?>
                    <?= $form->field($model, 'product')->dropDownList($productlist,['prompt'=>'Select Product']); ?>
                    <?= $form->field($model, 'quantity')->textInput() ?>
                    <?= Html::submitButton('Edit Order', ['class' => 'btn btn-primary', 'name' => 'edit-button']) ?>
                    <?= Html::a('Cancel', ['/order/list'], ['class'=>'btn btn-primary']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
