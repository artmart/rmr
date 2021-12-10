<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Account Parameters';
$this->params['breadcrumbs'][] = $this->title;

//$accounts = Accounts::find()->asArray()->all();
?>
<div class="params-index">

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
            //'user_id',
          /*  ['attribute' => 'asin', 'format' =>'raw',
                'value'=>function($model) use ($marketplacies){$amazon_mws_endpoint_array = ArrayHelper::map($marketplacies, 'country_code', 'amazon_mws_endpoint');
                            return  $asin = '<a href="'.$amazon_mws_endpoint_array[$model->amazon_marketplace].'/dp/'.$model->asin.'" target="_blank">'.$model->asin.'</a>';                 
                        }
            ],
            */
            'url', //:url
            'key',
            'secret',
            //'scope',
            /*
            [
                'attribute' => 'id',
                'label' =>'Bookings',
                'value' => function ($model) {
                        return Html::a('<span class="glyphicon glyphicon-log-in"></span>', ['/bookings?BookingsSearch[param_id]='.$model->id], ['data-pjax' => 0]);
                },
                'format' => 'raw',
                'filter'=>false,
                //'filter' => Category::getCategories(),
                //'filterInputOptions' => ['class' => 'form-control', 'encodeSpaces' => true],
            ],
            [
                'attribute' => 'id',
                'label' =>'Payments',
                'value' => function ($model) {
                        return Html::a('<span class="glyphicon glyphicon-log-in"></span>', ['/payments?PaymentsSearch[param_id]='.$model->id], ['data-pjax' => 0]);
                },
                'format' => 'raw',
                'filter'=>false,
                //'filter' => Category::getCategories(),
                //'filterInputOptions' => ['class' => 'form-control', 'encodeSpaces' => true],
            ],
            [
                'attribute' => 'id',
                'label' =>'Leads',
                'value' => function ($model) {
                        return Html::a('<span class="glyphicon glyphicon-log-in"></span>', ['/leads?LeadsSearch[param_id]='.$model->id], ['data-pjax' => 0]);
                },
                'format' => 'raw',
                'filter'=>false,
                //'filter' => Category::getCategories(),
                //'filterInputOptions' => ['class' => 'form-control', 'encodeSpaces' => true],
            ],
            
            
            [
                'attribute' => 'id',
                'label' =>'Reports',
                'value' => function ($model) {
                        $links = '<select><option>-Select-</option>';
                
                         $links .= '<option>'.Html::a('Tax exempt bookings', ['/site/reports/tax-exempt-bookings?param_id='.$model->id], ['data-pjax' => 0]).'</option>';
                                
                $links .= '</select>';
                        
                        
                        ;lk
                    
                    
                        return $links;
                        
                        
                        
                      //  Html::a('<span class="glyphicon glyphicon-log-in"></span>', ['/site/reports/tax-exempt-bookings?param_id='.$model->id], ['data-pjax' => 0]);
                },
                'format' => 'raw',
                'filter'=>false,
                //'filter' => Category::getCategories(),
                //'filterInputOptions' => ['class' => 'form-control', 'encodeSpaces' => true],
            ], */
            
            
    
            
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
