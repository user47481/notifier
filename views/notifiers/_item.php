<?php
/**
 * Created by PhpStorm.
 * User: filipp
 * Date: 31.10.17
 * Time: 11:47 AM
 */
use tuyakhov\materialize\Html;
use yii\helpers\Url;

?>

<div class="col-md-4">
    <!-- Widget: user widget style 1 -->
    <div class="box box-widget widget-user">

        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-aqua-active">
            <?php echo Html::a('<span class="fa fa-cogs"></span>',['update','id'=>$model->id],['style'=>'color:white;float:right']); ?>
            <h3 class="widget-user-username"><?php echo $model->label; ?></h3>
            <h5 class="widget-user-desc"><?php echo $model->sender->label; ?></h5>
        </div>
        <div class="box-footer">
            <div class="row">
                <div class="col-sm-6 border-right">
                    <div class="description-block">
                        <h5 class="description-header">3,200</h5>
                        <span class="description-text">Всего адресатов</span>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <div class="description-block">
                        <h5 class="description-header">3,160</h5>
                        <span class="description-text">Доставлено</span>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->

                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </div>
    <!-- /.widget-user -->
</div>
