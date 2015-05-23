<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 * @var \yii\web\View $this
 * @var \app\models\OrderItem[] $models
 * @var \yii\widgets\ActiveForm $form
 */

$this->title = 'Add order';
?>

<script type="application/template" id="order-item-row-template">
    <div class="row order-item-row form-group">
        <div class="col-md-2">
            <?= \yii\helpers\Html::textInput('OrderItem[:counter:][price]',
                '', ['class' => 'form-control']) ?>
        </div>
        <div class="col-md-5">
            <?= \yii\helpers\Html::textInput('OrderItem[:counter:][description]',
                '', ['class' => 'form-control']) ?>
        </div>
        <div class="col-md-1">
            <?= \yii\helpers\Html::checkbox('OrderItem[:counter:][price]',
                false, ['class' => '']) ?>
        </div>
        <div class="col-md-2">
            <a href="#" class="j-order-item-add-row"><span class="glyphicon glyphicon-plus"></span></a>
            <a href="#" class="j-order-item-delete-row"><span class="glyphicon glyphicon-minus"></span></a>
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
        <div class="row order-item-row form-group">
            <div class="col-md-2">
                <?= \yii\helpers\Html::activeTextInput($model, "[$i]price", ['class' => 'form-control']) ?>
                <?= \yii\helpers\Html::error($model, "[$i]price")?>
            </div>
            <div class="col-md-5">
                <?= \yii\helpers\Html::activeTextInput($model, "[$i]description", ['class' => 'form-control']) ?>
                <?= \yii\helpers\Html::error($model, "[$i]description")?>
            </div>
            <div class="col-md-1">
                <?= \yii\helpers\Html::activeCheckbox($model, "[$i]available", ['label' => null])?>
                <?= \yii\helpers\Html::error($model, "[$i]available")?>
            </div>
            <div class="col-md-2">
                <a href="#" class="j-order-item-add-row"><span class="glyphicon glyphicon-plus"></span></a>
                <a href="#" class="j-order-item-delete-row"><span class="glyphicon glyphicon-minus"></span></a>
            </div>
        </div>
    <?php endforeach ?>
</div>

<div class="form-group">
    <?= \yii\helpers\Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>
<?php $form::end() ?>
