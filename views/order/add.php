<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 * @var \yii\web\View $this
 * @var \app\models\OrderItem[] $models
 * @var \yii\widgets\ActiveForm $form
 */
$this->title = 'Add order';
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

<?php $form = \yii\widgets\ActiveForm::begin([
    'fieldConfig' => [
        'template' => "{input}\n{error}"
    ]
])?>
<?= $form->errorSummary($models) ?>
<div id="order-item-rows">
    <div class="row order-item-row-labels form-group">
        <div class="col-md-2">Price</div>
        <div class="col-md-5">Description</div>
        <div class="col-md-1">Available</div>
        <div class="col-md-2">Controls</div>
    </div>
    <?php foreach ($models as $i => $model): ?>
        <div class="row order-item-row form-group" <?= $model->isDeleted ? 'style="display: none"' : ''?>>
            <div class="col-md-2">
                <?= \yii\helpers\Html::activeTextInput($model, "[$i]price", ['class' => 'form-control']) ?>
                <?= \yii\helpers\Html::error($model, "[$i]price")?>
            </div>
            <div class="col-md-4">
                <?= \yii\helpers\Html::activeTextInput($model, "[$i]description", ['class' => 'form-control']) ?>
                <?= \yii\helpers\Html::error($model, "[$i]description")?>
            </div>
            <div class="col-md-2">
                <?= \yii\helpers\Html::activeCheckbox($model, "[$i]available", ['label' => null])?>
                <?= \yii\helpers\Html::error($model, "[$i]available")?>
            </div>
            <div class="col-md-2">
                <?= \yii\helpers\Html::button('<i class="fa fa-trash"></i>', ['class' => 'btn btn-danger j-order-item-delete-row']) ?>
                <?= \yii\helpers\Html::activeHiddenInput($model, "[$i]isDeleted") ?>
            </div>
        </div>
    <?php endforeach ?>
</div>
<div class="row">
    <div class="col-md-2 col-md-offset-8">
        <?= \yii\helpers\Html::button('<i class="fa fa-plus"></i>', ['class' => 'btn btn-success j-order-item-add-row']) ?>
    </div>
</div>
<div class="form-group">
    <?= \yii\helpers\Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>
<?php $form::end() ?>
