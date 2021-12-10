<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Leads';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leads-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php // Html::a('Create Leads', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
<div class="well well-lg">
<div class="row">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
</div>
</div>
<div class="yscroll">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'lead_id',
            //'param_id',
            'id',
            //'created',
            'created_iso',
            //'changed',
            'changed_iso',
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
            'status',
            'activity:ntext',
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
            'converted_bookings:ntext',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
        ],
    ]); ?>
</div>
    <?php Pjax::end(); ?>

</div>
