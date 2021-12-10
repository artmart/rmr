<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Payments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payments-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?php // Html::a('Create Payments', ['create'], ['class' => 'btn btn-success']) ?>
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
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'payment_id',
            //'param_id',
            'id',
            'transaction_id',
            'label',
            //'parts:ntext',
            //'created',
            'created_iso',
            'original_amount',
            'refunded_amount',
            'amount',
            'gratuity',
            //'booking_id',
            'source:ntext',
            'submitter:ntext',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
        ],
    ]); ?>
</div>
    <?php Pjax::end(); ?>

</div>
