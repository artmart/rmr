<style>
.tb1 th {
    width: 15%;
}

.tb1 td {
    width: 85%;
}
</style>

<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->label;
$this->params['breadcrumbs'][] = ['label' => 'Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="payments-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php // Html::a('Update', ['update', 'id' => $model->payment_id], ['class' => 'btn btn-primary']) ?>
        <?php /* Html::a('Delete', ['delete', 'id' => $model->payment_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */ ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'payment_id',
            //'param_id',
            'id',
            'transaction_id',
            'label',
            'parts:ntext',
            
            
            'created',
            'created_iso',
            'original_amount',
            'refunded_amount',
            'amount',
            'gratuity',
            'booking_id',
            'source:ntext',
            'submitter:ntext',
        ],
        'options' => ['class' => 'table table-striped table-bordered text-wrap tb1'] 
    ]) ?>

</div>
