<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\Accounts;

$this->title = 'Account (Parameter) Reports'; // $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Params', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$account = Accounts::find()->where(['param_id' =>$model->id])->one();
$reports = '';

$reports .= Html::a('<span class="glyphicon glyphicon-folder-open"></span> Bookings', ['/bookings?BookingsSearch[param_id]='.$model->id], ['data-pjax' => 0]).'<br/>';
$reports .= Html::a('<span class="glyphicon glyphicon-folder-open"></span> Payments', ['/payments?PaymentsSearch[param_id]='.$model->id], ['data-pjax' => 0]).'<br/>';
$reports .= Html::a('<span class="glyphicon glyphicon-folder-open"></span> Leads', ['/leads?LeadsSearch[param_id]='.$model->id], ['data-pjax' => 0]).'<br/>';
$reports .= Html::a('<span class="glyphicon glyphicon-folder-open"></span> Tax exempt bookings', ['/site/reports/tax-exempt-bookings?param_id='.$model->id], ['data-pjax' => 0]).'<br/>';
$reports .= Html::a('<span class="glyphicon glyphicon-folder-open"></span> Tax collected total', ['/site/reports/tax-collected-total?param_id='.$model->id], ['data-pjax' => 0]).'<br/>';
$reports .= Html::a('<span class="glyphicon glyphicon-folder-open"></span> Booking Results', ['/site/reports/booking-report-results?param_id='.$model->id], ['data-pjax' => 0]).'<br/>';
$reports .= Html::a('<span class="glyphicon glyphicon-folder-open"></span> List/chart of payments via method', ['/site/reports/list-chart-of-payments-via-method?param_id='.$model->id], ['data-pjax' => 0]).'<br/>';


$reports .= Html::a('<span class="glyphicon glyphicon-folder-open"></span> Bookings With No Payments Made', ['/site/reports/bookings-with-no-payments-made?param_id='.$model->id], ['data-pjax' => 0]).'<br/>';

?>
<div class="params-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="pull-right" style="margin-top: -40px;">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => ['confirm' => 'Are you sure you want to delete this item?', 'method' => 'post'],
        ]) ?>
    </p>
<hr />
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'user_id',
            'url', //:url
            'key',
            'secret',
            ['attribute' => 'Business Name/Business Admin', 'value'=>function($model) use ($account){return  $account->business_name.'/'.$account->business_admin;}],
            ['attribute' => 'Business Website', 'value'=>function($model) use ($account){return  $account->business_website;}],
            ['attribute' => 'Business Address', 'value'=>function($model) use ($account){return  $account->business_address.', '.$account->business_postcode.', '.$account->business_country;}],
            ['attribute' => 'Business Timezone', 'value'=>function($model) use ($account){return  $account->business_timezone;}],
            ['attribute' => 'Currency/Plan/Is Paid', 'value'=>function($model) use ($account){return  $account->currency_code.'/'.$account->plan.'/'.$account->is_paid;}],
            
            ['attribute' => 'Reports', 'format' =>'html', 'value'=>function($model) use ($reports){return  $reports;}],
            //'scope',
        ],
    ]);
 ?>    
</div>