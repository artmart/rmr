<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Account (Parameter) Reports'; // $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Params', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
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
            //'scope',
        ],
    ]);
 ?>    

    
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Bookings</th>
      <th scope="col">Payments</th>
      <th scope="col">Leads</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?= Html::a('Bookings', ['/bookings?BookingsSearch[param_id]='.$model->id], ['data-pjax' => 0]);?></td>
      <td><?= Html::a('Payments', ['/payments?PaymentsSearch[param_id]='.$model->id], ['data-pjax' => 0]); ?></td>
      <td><?= Html::a('Leads', ['/leads?LeadsSearch[param_id]='.$model->id], ['data-pjax' => 0]); ?></td>
    </tr>
    <tr>  
      <td><?= Html::a('Tax exempt bookings', ['/site/reports/tax-exempt-bookings?param_id='.$model->id], ['data-pjax' => 0]); ?></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td><?= Html::a('Tax collected total', ['/site/reports/tax-collected-total?param_id='.$model->id], ['data-pjax' => 0]); ?></td>
      <td><?= Html::a('Booking Results', ['/site/reports/booking-report-results?param_id='.$model->id], ['data-pjax' => 0]); ?>
      
      </td>
      <td></td>
    </tr>
  </tbody>
</table>    
    
    
    

</div>
