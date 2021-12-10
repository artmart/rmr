<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Leads */

$this->title = 'Update Leads: ' . $model->lead_id;
$this->params['breadcrumbs'][] = ['label' => 'Leads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->lead_id, 'url' => ['view', 'id' => $model->lead_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="leads-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
