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
        </div>
        <div class="widget-user-image">
            <?php if($model->label == 'MailChimp'){ ?>
                <img class="" style="margin-top: -12px;border: none;" src="/backend/web/img/mailchimp-alternatives.png" alt="Sender Logo">
            <?php }else{; ?>
                <img class="img-circle" src="/backend/web/img/logo-top.png" alt="Sender Logo">
            <?php }; ?>
        </div>
        <div class="box-footer">
            <div class="row">
                <div class="col-sm-3 border-right">
                    <div class="description-block">
                        <span class="description-text">
                            <button type="submit" class="btn btn-success btn-flat disabled">Установлено</button>
                        </span>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-5 border-right">
                    <div class="description-block">
                        <h5 class="description-header">1,000</h5>
                        <span class="description-text">скачиваний</span>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                    <div class="description-block">
                        <h5 class="description-header">43</h5>
                        <span class="description-text">Рейтинг</span>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </div>
    <!-- /.widget-user -->
</div>
