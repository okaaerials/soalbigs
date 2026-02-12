<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Registrasi $model */

$this->title = 'Tambah Registrasi';
?>

<div class="container mt-4">

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Form Registrasi</h5>
        </div>

        <div class="card-body">

            <?php if (Yii::$app->session->hasFlash('success')): ?>
                <div class="alert alert-success">
                    <?= Yii::$app->session->getFlash('success') ?>
                </div>
            <?php endif; ?>

            <?php $form = ActiveForm::begin([
                'id' => 'registrasi-form',
                'options' => ['class' => 'needs-validation', 'novalidate' => true],
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'form-label'],
                    'inputOptions' => ['class' => 'form-control'],
                    'errorOptions' => ['class' => 'invalid-feedback d-block'],
                ],
            ]); ?>

            <div class="mb-3">
                <?= $form->field($model, 'no_registrasi')
                    ->textInput([
                        'maxlength' => 8,
                        'placeholder' => 'Masukkan Nomor Registrasi',
                        'class' => 'form-control w-25',
                        'oninput' => 'this.value=this.value.replace(/[^0-9]/g,"")'
                    ]) ?>
            </div>


            <div class="mb-3">
                <?= $form->field($model, 'no_rekam_medis')
                    ->textInput([
                        'maxlength' => 8,
                        'placeholder' => 'Masukkan Nomor Rekam Medis Pasien',
                        'class' => 'form-control w-25',
                        'type' => 'text',
                        'oninput' => 'this.value=this.value.replace(/[^0-9]/g,"")'
                    ]) ?>
            </div>

            <div class="mb-3">
                <?= $form->field($model, 'nama_pasien')
                    ->textInput([
                        'maxlength' => true,
                        'placeholder' => 'Masukkan Nama Pasien'
                    ]) ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <div class="input-group" style="width:250px;">
                    <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                    </span>
                    <?= Html::activeInput('date', $model, 'tanggal_lahir', [
                        'class' => 'form-control',
                        'max' => date('Y-m-d')
                    ]) ?>
                </div>
            </div>

            <div class="mb-3">
                <?= $form->field($model, 'nik')
                    ->textInput([
                        'maxlength' => 16,
                        'placeholder' => 'Masukkan NIK Pasien',
                        'class' => 'form-control w-25',
                        'type' => 'text',
                        'oninput' => 'this.value=this.value.replace(/[^0-9]/g,"")'
                    ]) ?>
            </div>
   

            <div class="d-flex justify-content-between">
                <?= Html::a('Kembali', ['index'], ['class' => 'btn btn-secondary']) ?>

                <?= Html::submitButton('Simpan', [
                    'class' => 'btn btn-success'
                ]) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>

<?php
// JS Bootstrap validation
$this->registerJs("
(function () {
    'use strict'
    const form = document.getElementById('registrasi-form');
    form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    }, false);
})();
");
?>
