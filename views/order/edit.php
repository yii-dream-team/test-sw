<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 * @var $this \yii\web\View
 * @var $models \app\models\OrderItem[]
 */
$this->title = 'Order #' . $orderId;
$this->params['breadcrumbs'][] = $this->title;
?>

<script type="application/template" id="order-item-row-template">
    <div class="row order-item-row form-group">
        <div class="col-md-2">
            <?= \yii\helpers\Html::textInput('OrderItem[:counter:][price]',
                '', ['class' => 'form-control']) ?>
        </div>
        <div class="col-md-4">
            <?= \yii\helpers\Html::textInput('OrderItem[:counter:][description]',
                '', ['class' => 'form-control']) ?>
        </div>
        <div class="col-md-2">
            <?= \yii\helpers\Html::checkbox('OrderItem[:counter:][available]',
                false, ['class' => '']) ?>
        </div>
        <div class="col-md-2">
            <?= \yii\helpers\Html::button('<i class="fa fa-trash"></i>', ['class' => 'btn btn-danger j-order-item-delete-row']) ?>
            <?= \yii\helpers\Html::hiddenInput('OrderItem[:counter:][isDeleted]', 0) ?>
        </div>
    </div>
</script>

<?php if (empty($models)): ?>
    <div class="alert alert-danger">No items found</div>
<?php else: ?>
    <?php $form = \yii\bootstrap\ActiveForm::begin([
        'enableClientValidation' => false,
        'fieldConfig' => [
            'template' => '{input}{error}{hint}',
        ]
    ]) ?>
    <div id="order-item-rows">

        <div class="form-group row">
            <div class="col-md-2"><strong>Price</strong></div>
            <div class="col-md-4"><strong>Description</strong></div>
            <div class="col-md-2"><strong>Available</strong></div>
            <div class="col-md-2"><strong></strong></div>
        </div>

        <?php foreach ($models as $i => $model): ?>
            <div class="form-group row order-item-row" <?= $model->isDeleted ? 'style="display: none"' : '' ?>>
                <div class="col-md-2"><?= $form->field($model, "[$i]price"); ?></div>
                <div class="col-md-4"><?= $form->field($model, "[$i]description"); ?></div>
                <div class="col-md-2"><?= $form->field($model, "[$i]available")->checkbox(); ?></div>
                <div class="col-md-2">
                    <?= \yii\helpers\Html::button('<i class="fa fa-trash"></i>', ['class' => 'btn btn-danger j-order-item-delete-row']) ?>
                    <?= \yii\helpers\Html::activeHiddenInput($model, "[$i]isDeleted") ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="row">
        <div class="col-md-2 col-md-offset-8">
            <?= \yii\helpers\Html::button('<i class="fa fa-plus"></i>', ['class' => 'btn btn-success j-order-item-add-row']) ?>
        </div>
    </div>

    <div class="form-group">
        <?= \yii\helpers\Html::submitButton('Save changes', ['class' => 'btn btn-primary']); ?>
    </div>

    <?php \yii\bootstrap\ActiveForm::end(); ?>

<?php endif; ?>
