<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Bookings */

$this->title = 'Update Bookings: ' . $model->booking_id;
$this->params['breadcrumbs'][] = ['label' => 'Bookings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->booking_id, 'url' => ['view', 'id' => $model->booking_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bookings-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
