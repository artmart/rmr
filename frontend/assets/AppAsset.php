<?php
namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
       // "vendor/bootstrap/css/bootstrap.min.css",
        "vendor/font-awesome/css/font-awesome.min.css",

        'vendor/datatables.net-bs/css/dataTables.bootstrap.min.css',
        'vendor/datatables.net-buttons-bs/css/buttons.bootstrap.min.css',
        'vendor/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css',
        'vendor/datatables.net-responsive-bs/css/responsive.bootstrap.min.css',
        //'vendor/datatables.net-scroller-bs/css/scroller.bootstrap.min.css',   
        //'vendor/bootstrap-select/css/bootstrap-select.min.css',     
        'vendor/bootstrap-daterangepicker/daterangepicker.css',
        'css/site.css',
    ];
    public $js = [
        //"vendor/jquery/jquery.min.js", 
        //"vendor/bootstrap/js/bootstrap.min.js",
        //"vendor/jquery/jquery.maskMoney.min.js",
        'vendor/moment/min/moment.min.js',
        'vendor/datatables.net/js/jquery.dataTables.min.js',
        'vendor/datatables.net-bs/js/dataTables.bootstrap.min.js',
        'vendor/datatables.net-buttons/js/dataTables.buttons.min.js',
        'vendor/datatables.net-buttons-bs/js/buttons.bootstrap.min.js',
        'vendor/datatables.net-buttons/js/buttons.flash.min.js',
        'vendor/datatables.net-buttons/js/buttons.html5.min.js',
        'vendor/datatables.net-buttons/js/buttons.print.min.js',
        'vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js',
        'vendor/datatables.net-keytable/js/dataTables.keyTable.min.js',
        'vendor/datatables.net-responsive/js/dataTables.responsive.min.js',
        'vendor/datatables.net-responsive-bs/js/responsive.bootstrap.js',
        //'vendors/datatables.net-scroller/js/datatables.scroller.min.js',
        //'vendor/bootstrap-select/js/bootstrap-select.min.js',
        'vendor/bootstrap-daterangepicker/daterangepicker.js',
        
        'vendor/highcharts/highcharts.js',
        'vendor/highcharts/exporting.js',
        'vendor/highcharts/export-data.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    public $jsOptions = [ 'position' => \yii\web\View::POS_HEAD ];
}