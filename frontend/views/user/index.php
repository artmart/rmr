<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="pull-right">
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Add', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'firstname',
            'lastname',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            'phone_number',
            //'user_group',
            [
                'attribute' => 'user_group',
                'filter'=>['1' => 'Administrator', '2' => 'User'],
                 'format' => 'raw',
                'value'=>  function($data) {return ($data->user_group==1)?'Administrator':'User';}, 
            ],
            //'status',
            
            [
                'attribute' => 'status',
                'filter'=>['10' => 'Active', '9' => 'Inactive'],
                 'format' => 'raw',
                'value'=>  function($data) {return ($data->status==10)?'Active':'Inactive';}, 
            ],
            
            //'created_at',
            //'updated_at',
            //'verification_token',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
