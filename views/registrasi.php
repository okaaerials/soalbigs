<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Registrasi $model */
/** @var ActiveForm $form */
?>
<div class="registrasi">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'no_registrasi') ?>
        <?= $form->field($model, 'no_rekam_medis') ?>
        <?= $form->field($model, 'nama_pasien') ?>
        <?= $form->field($model, 'tanggal_lahir') ?>
        <?= $form->field($model, 'nik') ?>
        <?= $form->field($model, 'create_by') ?>
        <?= $form->field($model, 'create_time_at') ?>
        <?= $form->field($model, 'update_by') ?>
        <?= $form->field($model, 'update_time_at') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- registrasi -->
