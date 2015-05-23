<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 * @var $this \yii\web\View
 * @var $models \app\models\OrderItem[]
 */
$this->title = 'Order #' . $orderId;
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if (empty($models)): ?>
    <div class="alert alert-danger">No items found</div>
<?php else: ?>
    <?php $form = \yii\bootstrap\ActiveForm::begin([
        'fieldConfig' => [
            'template' => '{input}{error}{hint}',
        ]
    ]) ?>
    <div class="form-group row">
        <div class="col-md-2"><strong>Price</strong></div>
        <div class="col-md-2"><strong>Description</strong></div>
        <div class="col-md-2"><strong>Available</strong></div>
        <div class="col-md-1"><strong></strong></div>
    </div>

    <?php foreach ($models as $i => $model): ?>
        <div class="form-group row" <?= $model->isDeleted ? 'style="display: none"' : ''?>>
            <div class="col-md-2"><?= $form->field($model, "[$i]price"); ?></div>
            <div class="col-md-2"><?= $form->field($model, "[$i]description"); ?></div>
            <div class="col-md-2"><?= $form->field($model, "[$i]available")->checkbox(); ?></div>
            <div class="col-md-1">
                <?= \yii\helpers\Html::button('<i class="fa fa-trash"></i>', ['class' => 'btn btn-danger pull-right row-delete']) ?>
                <?= \yii\helpers\Html::activeHiddenInput($model, "[$i]isDeleted") ?>
            </div>
        </div>
    <?php endforeach; ?>
    <?= \yii\helpers\Html::submitButton('Save changes', ['class' => 'btn btn-primary']); ?>
    <?php \yii\bootstrap\ActiveForm::end(); ?>

<?php endif; ?>

<?php
$js = <<<JS
    $('body').on('click', '.row-delete', function() {
        var btn = $(this);
        btn.next().val(1);
        btn.closest('.row').hide();
    });
JS;
$this->registerJs($js);
