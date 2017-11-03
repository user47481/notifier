<?php
/**
 * Created by PhpStorm.
 * User: filipp
 * Date: 29.10.17
 * Time: 11:52 AM
 */
use yii\helpers\Html;
use yii\widgets\ListView;

?>
<div class="col-md-3">
    <?php echo Html::a('Добавить новый шаблон','notifiers/create',['class'=>'btn btn-info']); ?>
</div>
<div class="clearfix"></div>
<hr>
<?php echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_item',
    'summary' => false
]); ?>

