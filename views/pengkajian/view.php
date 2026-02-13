<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Pengkajian $model */

$this->title = 'Detail Pengkajian Keperawatan';

$registrasi = $model->registrasi;
?>

<div class="container mt-4">

    <div class="card shadow">
        <div class="card-header text-center bg-primary text-white">
            <h4 class="mb-0">
                PENGKAJIAN KEPERAWATAN<br>
                POLIKLINIK KEBIDANAN
            </h4>
        </div>

        <div class="card-body">

            <!-- ================= DATA PASIEN ================= -->
            <?php if ($registrasi): ?>
                <div class="row mb-3">
                    <div class="col-md-8">
                        <table style="width:100%;">
                            <tr>
                                <td width="25%"><strong>Nama Lengkap</strong></td>
                                <td width="2%">:</td>
                                <td><?= Html::encode($registrasi->nama ?? $registrasi->nama_pasien) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Lahir</strong></td>
                                <td>:</td>
                                <td>
                                    <?= Yii::$app->formatter->asDate(
                                        $registrasi->tanggal_lahir,
                                        'php:d F Y'
                                    ) ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>No. Rekam Medis</strong></td>
                                <td>:</td>
                                <td><?= $registrasi->no_rekam_medis ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <hr>
            <?php endif; ?>


            <!-- ================= INFORMASI UMUM ================= -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Tanggal Pengkajian :</strong><br>
                    <?= $model->tanggal_pengkajian ?>
                </div>
                <div class="col-md-4">
                    <strong>Jam Pengkajian :</strong><br>
                    <?= $model->jam_pengkajian ?>
                </div>
                <div class="col-md-4">
                    <strong>Poliklinik :</strong><br>
                    <?= $model->poliklinik ?>
                </div>
            </div>

            <hr>

            <!-- ================= CARA MASUK ================= -->
            <p><strong>1. Cara Masuk :</strong>
                <?= is_array($model->cara_masuk) ? implode(', ', $model->cara_masuk) : '-' ?>
            </p>

            <!-- ================= ANAMNESIS ================= -->
            <p><strong>2. Anamnesis :</strong> <?= $model->anamnesis ?></p>
            <p><strong>Diperoleh :</strong> <?= $model->diperoleh ?> |
               <strong>Hubungan :</strong> <?= $model->hubungan ?> |
               <strong>Alergi :</strong> <?= $model->alergi ?>
            </p>

            <!-- ================= KELUHAN ================= -->
            <p><strong>3. Keluhan :</strong> <?= $model->keluhan ?></p>

            <hr>

            <!-- ================= PEMERIKSAAN FISIK ================= -->
            <h5 class="bg-secondary text-white p-2">Pemeriksaan Fisik</h5>

            <p><strong>Keadaan Umum :</strong> <?= $model->keadaan_umum ?></p>
            <p><strong>Warna Kulit :</strong> <?= $model->warna_kulit ?></p>
            <p><strong>Kesadaran :</strong> <?= $model->kesadaran ?></p>

            <p><strong>Tanda Vital :</strong><br>
                TD : <?= $model->td ?> |
                Nadi : <?= $model->nadi ?> |
                RR : <?= $model->rr ?> |
                Suhu : <?= $model->suhu ?>
            </p>

            <p><strong>Antropometri :</strong><br>
                BB : <?= $model->berat_badan ?> Kg |
                TB : <?= $model->tinggi_badan ?> cm |
                IMT : <?= $model->imt ?>
            </p>

            <p><strong>Status Gizi :</strong> <?= $model->status_gizi ?></p>

            <hr>

            <!-- ================= RIWAYAT ================= -->
            <p><strong>Riwayat Penyakit Sekarang :</strong>
                <?= $model->riwayat_penyakit_sekarang ?>
            </p>

            <p><strong>Riwayat Penyakit Sebelumnya :</strong>
                <?= is_array($model->riwayat_penyakit_sebelumnya)
                    ? implode(', ', $model->riwayat_penyakit_sebelumnya)
                    : '-' ?>
            </p>

            <p><strong>Riwayat Operasi :</strong>
                <?= $model->riwayat_operasi ?>
                <?php if ($model->riwayat_operasi === 'ya'): ?>
                    <br>Operasi : <?= $model->operasi_apa ?>
                    <br>Kapan : <?= $model->kapan_di_operasi ?>
                <?php endif; ?>
            </p>

            <p><strong>Riwayat Pernah Dirawat :</strong>
                <?= $model->riwayat_pernah_dirawat_di_rs ?>
                <?php if ($model->riwayat_pernah_dirawat_di_rs === 'ya'): ?>
                    <br>Penyakit : <?= $model->penyakit_apa ?>
                    <br>Kapan : <?= $model->kapan_dirawat_di_rs ?>
                <?php endif; ?>
            </p>

            <hr>

            <!-- ================= RESIKO JATUH ================= -->
            <h5 class="bg-secondary text-white p-2">Pengkajian Resiko Jatuh</h5>

            <table class="table table-bordered table-sm">
                <tr>
                    <th>Total Skor</th>
                    <td><?= $model->total_resiko ?></td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td>
                        <?= ($model->total_resiko <= 24)
                            ? '<span class="badge bg-success">Tidak Beresiko</span>'
                            : '<span class="badge bg-danger">Beresiko Tinggi</span>' ?>
                    </td>
                </tr>
            </table>

            <div class="text-end mt-3">
                <?= Html::button('Print', [
                    'class' => 'btn btn-primary',
                    'onclick' => 'window.print()'
                ]) ?>

                <?= Html::a('Kembali', ['index'], ['class' => 'btn btn-secondary']) ?>
            </div>

        </div>
    </div>
</div>
