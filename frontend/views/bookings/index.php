<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Bookings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bookings-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p><?php // Html::a('Create Bookings', ['create'], ['class' => 'btn btn-success']) ?></p>

    <?php Pjax::begin(); ?>
<div class="well well-lg">
<div class="row">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
</div>
</div>
<div class="yscroll">
    <?php 
           $columns = [
            //['class' => 'yii\grid\SerialColumn'],
            //'booking_id',
            //'param_id',
            'id',
            //'created',
            'created_iso',
            //'changed',
            'changed_iso',
            'status',
            'email', //:email
            'phone',
            //'customer:ntext',
            ['attribute' => 'customer', 'format' =>'html',
                'value' => function($model){
                    $customer_data = json_decode($model->customer);
                        $ret = $customer_data->first_name.' '.$customer_data->last_name;
                        //if($event_data->event_time_start_formatted & $event_data->event_time_end_formatted){
                        //    $ret .=  ' ('.$event_data->event_time_start_formatted.'-'.$event_data->event_time_end_formatted.')';
                        //}
                        return $ret;
                    },
            ],
            //'staff:ntext',
            //'rep:ntext',
            //'vehicle:ntext',
            //'assets:ntext',
            'packages:ntext',
            'extras:ntext',
            'event_name:ntext',
            //'event:ntext',
            ['attribute' => 'event', 'format' =>'html',
                'value' => function($model) {
                    $event_data = json_decode($model->event);
                        $ret = $event_data->event_date_us;
                        if($event_data->event_time_start_formatted & $event_data->event_time_end_formatted){
                            $ret .=  ' ('.$event_data->event_time_start_formatted.'-'.$event_data->event_time_end_formatted.')';
                        }
                        return $ret;
                    },
            ],
            
            //'venue:ntext',
            //'price:ntext',
            //'notes:ntext',
            //'signature_required',
            //'signature',
            //'travel:ntext',
            //'template:ntext',
            //'taxjar:ntext',
            //'ein:ntext',
            //'tax_rate:ntext',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
        ];
    
    
    
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => $columns,
    ]); ?>
</div>
    <?php Pjax::end(); ?>

</div>
