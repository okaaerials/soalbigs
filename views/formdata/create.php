<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap5\Modal;

Modal::begin([
    'title' => 'Input Form Data',
    'toggleButton' => ['label' => 'Tambah Data', 'class' => 'btn btn-success'],
]);

$form = ActiveForm::begin();
?>

<?= $form->field($model, 'id_form')->hiddenInput()->label(false) ?>

<div class="mb-3">
    <label>Keluhan</label>
    <input type="text" name="keluhan" class="form-control">
</div>

<div class="mb-3">
    <label>Anamnesis</label>
    <input type="text" name="anamnesis" class="form-control">
</div>

<div class="form-group">
    <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary']) ?>
</div>

<?php
ActiveForm::end();
Modal::end();
?>
