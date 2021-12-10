<style>
.tb1 th {
    width: 15%;
}

.tb1 td {
    width: 85%;
}

.text-wrap{
white-space: -moz-pre-wrap !important;  /* Mozilla, since 1999 */
white-space: -pre-wrap;      /* Opera 4-6 */
white-space: -o-pre-wrap;    /* Opera 7 */
white-space: pre-wrap;       /* css-3 */
word-wrap: break-word;       /* Internet Explorer 5.5+ */
white-space: -webkit-pre-wrap; /* Newer versions of Chrome/Safari*/
word-break: break-all;
white-space: normal;
}
</style>

<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Booking: '. $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bookings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="bookings-view">

    <h1><?=Html::encode($this->title) ?></h1>

    <p>
        <?php /* Html::a('Update', ['update', 'id' => $model->booking_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->booking_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */ ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        //'contentOptions' => ['class' => 'table table-striped table-bordered tb1'],        
        'attributes' => [
            //'booking_id',
            //'param_id',
            'id',
            //'created',
            'created_iso',
            //'changed',
            'changed_iso',
            'status',
            'email:email',
            'phone',
            'customer:ntext',
            'staff:ntext',
            'rep:ntext',
            'vehicle:ntext',
            'assets:ntext',
            'packages:ntext',
            'extras:ntext',
            'event_name:ntext',
            'event:ntext',
            'venue:ntext',
            'price:ntext',
            'notes:ntext',
            'signature_required',
            'signature',
            'travel:ntext',
            'template:ntext',
            'taxjar:ntext',
            'ein:ntext',
            'tax_rate:ntext',
        ],
        //'options' => ['style' => 'width:150px'],
         'options' => ['class' => 'table table-striped table-bordered text-wrap tb1'] 
    ]) ?>
</div>
