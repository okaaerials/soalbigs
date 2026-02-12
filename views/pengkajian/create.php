<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Pengkajian $model */

$this->title = 'Pengkajian Keperawatan';

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
            <?php
                $registrasi = $model->registrasi;
                ?>

                <?php if ($registrasi): ?>
                <div class="row mb-3">
                    <div class="col-md-8"></div>

                    <div class="col-md-8">
                        <table style="width:100%; border-collapse:collapse;">
                            <tr>
                                <td style="width:25%; padding:2px 0;"><strong>Nama Lengkap</strong></td>
                                <td style="width:2%;">:</td>
                                <td><?= Html::encode($registrasi->nama ?? $registrasi->nama_pasien) ?></td>
                            </tr>
                            <tr>
                                <td style="padding:2px 0;"><strong>Tanggal Lahir</strong></td>
                                <td>:</td>
                                <td>
                                    <?= Yii::$app->formatter->asDate(
                                        $registrasi->tanggal_lahir,
                                        'php:d F Y'
                                    ) ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:2px 0;"><strong>No. Rekam Medis</strong></td>
                                <td>:</td>
                                <td><?= implode('-', str_split(str_pad($registrasi->no_rekam_medis,8,'0',STR_PAD_LEFT),2))  ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <hr>
                <?php endif; ?>


            <?php $form = ActiveForm::begin(); ?>

            <!-- ================= INFORMASI UMUM ================= -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <?= $form->field($model, 'tanggal_pengkajian')
                        ->input('date') ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'jam_pengkajian')
                        ->input('time') ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'poliklinik')
                        ->textInput(['value' => 'KLINIK OBGYN']) ?>
                </div>
            </div>

            <hr>

            <h5 class="bg-secondary text-white p-2">
                Pengkajian saat datang (diisi oleh perawat)
            </h5>

            <!-- ================= CARA MASUK ================= -->
            <div class="mb-3" style="font-size:14px;">
                <label style="margin-right:10px;">
                    <strong>1. Cara Masuk</strong>
                </label>
                <label style="margin-right:15px;">
                    <?= $form->field($model, 'cara_masuk')
                        ->checkboxList([
                            'jalan' => 'Jalan tanpa bantuan',
                            'kursi' => 'Kursi roda',
                            'tempat_tidur' => 'Tempat tidur dorong',
                            'lain' => 'Lain-lain',
                        ])->label(false) ?>
                </label>
            </div>

            <div class="mb-3" style="font-size:14px;">
                <div class="d-flex align-items-center flex-wrap">

                    <strong class="me-3">2. Anamnesis</strong>

                    <!-- Radio -->
                    <?= $form->field($model, 'anamnesis', [
                            'template' => '{input}',
                            'options' => ['class' => 'mb-0 me-4']
                        ])->radioList([
                            'auto' => 'Autoanamnesis',
                            'allo' => 'Alloanamnesis',
                        ], [
                            'itemOptions' => [
                                'labelOptions' => ['class' => 'me-3 mb-0']
                            ],
                            'class' => 'd-flex'
                        ]) ?>

                    <!-- Diperoleh -->
                    <span class="me-2">Diperoleh :</span>
                    <?= $form->field($model, 'diperoleh', [
                            'template' => '{input}',
                            'options' => ['class' => 'mb-0 me-3']
                        ])->textInput([
                            'class' => 'form-control form-control-sm',
                            'style' => 'width:120px;'
                        ]) ?>

                    <!-- Hubungan -->
                    <span class="me-2">Hubungan :</span>
                    <?= $form->field($model, 'hubungan', [
                            'template' => '{input}',
                            'options' => ['class' => 'mb-0 me-3']
                        ])->textInput([
                            'class' => 'form-control form-control-sm',
                            'style' => 'width:120px;'
                        ]) ?>

                    <!-- Alergi -->
                    <span class="me-2">Alergi :</span>
                    <?= $form->field($model, 'alergi', [
                            'template' => '{input}',
                            'options' => ['class' => 'mb-0']
                        ])->textInput([
                            'class' => 'form-control form-control-sm',
                            'style' => 'width:120px;'
                        ]) ?>

                </div>

                </div>


           

           <!-- ================= KELUHAN ================= -->
            <div class="mb-3" style="font-size:14px;">

                <div class="d-flex align-items-center">

                    <strong class="me-3">3. Keluhan Utama pada saat ini</strong>

                    <?= $form->field($model, 'keluhan', [
                            'template' => '{input}',
                            'options' => ['class' => 'mb-0 flex-grow-1']
                        ])->textInput([
                            'class' => 'form-control form-control-sm',
                            'style' => 'width:80%;'
                        ]) ?>

                </div>

            </div>


            <!-- ================= Pemeriksaan Fisik ================= -->
            <div class="mb-3">
                <label style="margin-right:10px;">
                    <strong>4. Pemeriksaan Fisik</strong>
                </label>
            </div>
            <div class="ms-3 d-flex align-items-center mb-2">
                <label style="width:200px; margin-bottom:0;">
                    <strong>a. Keadaan Umum</strong>
                </label>

                <?= $form->field($model, 'keadaan_umum', [
                        'template' => "{input}\n{error}",
                        'options' => ['class' => 'mb-0']
                    ])
                    ->radioList([
                        'tidak_sakit' => 'Tidak tampak sakit',
                        'ringan' => 'Sakit ringan',
                        'sedang' => 'Sedang',
                        'berat' => 'Berat',
                    ], [
                        'itemOptions' => [
                            'labelOptions' => [
                                'style' => 'margin-right:20px; margin-bottom:0;'
                            ]
                        ],
                        'class' => 'd-flex'
                    ]) ?>
                </div>


            <div class="ms-3 d-flex align-items-center mb-2">
                <label style="width:200px; margin-bottom:0;">
                    <strong>b. Warna Kulit</strong>
                </label>

                <?= $form->field($model, 'warna_kulit', [
                        'template' => "{input}\n{error}",
                        'options' => ['class' => 'mb-0']
                    ])
                    ->radioList([
                        'normal' => 'Normal',
                        'sianosis' => 'Sianosis',
                        'pucat' => 'Pucat',
                        'kemerahan' => 'Kemerahan',
                    ])->label(false) ?> 
            </div>
            <div class="ms-3 mb-2">
                <div class="row">

                    <div class="col-md-3">
                        <label><strong>Kesadaran :</strong></label>

                        <?= $form->field($model, 'kesadaran', [
                                'template' => "{input}\n{error}",
                                'options' => ['class' => 'mb-0']
                            ])
                            ->checkboxList([
                                'jalan' => 'Jalan tanpa bantuan',
                                'kursi' => 'Kursi roda',
                                'tempat_tidur' => 'Tempat tidur dorong',
                                'lain' => 'Lain-lain',
                            ], [
                                'itemOptions' => [
                                    'labelOptions' => [
                                        'style' => 'display:block; margin-bottom:5px;'
                                    ]
                                ]
                            ]) ?>
                    </div>

                    <div class="col-md-3">
                        <label><strong>Tanda Vital :</strong></label>

                        <?= $form->field($model, 'td', [
                            'template' => '<div class="d-flex align-items-center mb-2">
                                            <label style="width:80px;">TD</label>
                                            {input}
                                        </div>{error}',
                            'options' => ['class' => 'mb-0']
                        ])->textInput(['placeholder'=>'mmHg', 'class'=>'form-control form-control-sm']) ?>

                        <?= $form->field($model, 'nadi', [
                            'template' => '<div class="d-flex align-items-center mb-2">
                                            <label style="width:80px;">Nadi</label>
                                            {input}
                                        </div>{error}',
                            'options' => ['class' => 'mb-0']
                        ])->textInput(['placeholder'=>'/menit', 'class'=>'form-control form-control-sm']) ?>

                        <?= $form->field($model, 'rr', [
                            'template' => '<div class="d-flex align-items-center mb-2">
                                            <label style="width:80px;">RR</label>
                                            {input}
                                        </div>{error}',
                            'options' => ['class' => 'mb-0']
                        ])->textInput(['placeholder'=>'/menit', 'class'=>'form-control form-control-sm']) ?>

                        <?= $form->field($model, 'suhu', [
                            'template' => '<div class="d-flex align-items-center mb-2">
                                            <label style="width:80px;">Suhu</label>
                                            {input}
                                        </div>{error}',
                            'options' => ['class' => 'mb-0']
                        ])->textInput(['placeholder'=>'°C', 'class'=>'form-control form-control-sm']) ?>
                    </div>

                    <div class="col-md-3">
                        <label><strong>Fungsional</strong></label>
                        <?= $form->field($model, 'alatbantu', [
                            'template' => '<div class="d-flex align-items-center mb-2">
                                            <label style="width:180px;">1. Alat Bantu</label>
                                            {input}
                                        </div>{error}',
                            'options' => ['class' => 'mb-0']
                        ])->textInput(['class'=>'form-control form-control-sm']) ?>

                        <?= $form->field($model, 'prothesa', [
                            'template' => '<div class="d-flex align-items-center mb-2">
                                            <label style="width:180px;">2. Prothesa</label>
                                            {input}
                                        </div>{error}',
                            'options' => ['class' => 'mb-0']
                        ])->textInput(['class'=>'form-control form-control-sm']) ?>

                        <?= $form->field($model, 'cacattubuh', [
                            'template' => '<div class="d-flex align-items-center mb-2">
                                            <label style="width:180px;">3. Cacat Tubuh</label>
                                            {input}
                                        </div>{error}',
                            'options' => ['class' => 'mb-0']
                        ])->textInput(['class'=>'form-control form-control-sm']) ?>

                        <?= $form->field($model, 'adl', [
                            'template' => '<div class="d-flex align-items-center mb-2">
                                            <label style="width:180px;">4. ADL</label>
                                            {input}
                                        </div>{error}',
                            'options' => ['class' => 'mb-0']
                        ])->textInput(['class'=>'form-control form-control-sm']) ?>
                    </div>

                    <div class="col-md-3">
                        <label><strong>Antrapometri</strong></label>
                        <?= $form->field($model, 'berat_badan', [
                            'template' => '<div class="d-flex align-items-center mb-2">
                                            <label style="width:180px;">Berat Badan</label>
                                            {input}
                                        </div>{error}',
                            'options' => ['class' => 'mb-0']
                        ])->textInput(['placeholder'=>'Kg'],['class'=>'form-control form-control-sm']) ?>

                        <?= $form->field($model, 'tinggi_badan', [
                            'template' => '<div class="d-flex align-items-center mb-2">
                                            <label style="width:180px;">Tinggi Badan</label>
                                            {input}
                                        </div>{error}',
                            'options' => ['class' => 'mb-0']
                        ])->textInput(['placeholder'=>'cm'],['class'=>'form-control form-control-sm']) ?>

                        <?= $form->field($model, 'panjang_badan', [
                            'template' => '<div class="d-flex align-items-center mb-2">
                                            <label style="width:180px;">Panjang Badan (PB)</label>
                                            {input}
                                        </div>{error}',
                            'options' => ['class' => 'mb-0']
                        ])->textInput(['placeholder'=>'cm'],['class'=>'form-control form-control-sm']) ?>
                        
                        <?= $form->field($model, 'lingkar_kepala', [
                            'template' => '<div class="d-flex align-items-center mb-2">
                                            <label style="width:180px;">Lingkar Kepala (LK)</label>
                                            {input}
                                        </div>{error}',
                            'options' => ['class' => 'mb-0']
                        ])->textInput(['placeholder'=>'cm'],['class'=>'form-control form-control-sm']) ?>

                        <?= $form->field($model, 'imt', [
                            'template' => '<div class="d-flex align-items-center mb-2">
                                            <label style="width:180px;">IMT</label>
                                            {input}
                                        </div>{error}',
                            'options' => ['class' => 'mb-0']
                        ])->textInput(['class'=>'form-control form-control-sm']) ?>
                        <label><strong>Catatan :</strong></label>
                        <p>PB dan LK khusus Pediatri</p>
                    </div>

                </div>
            </div>
            <div class="ms-3 d-flex align-items-center mb-2">
                <label style="width:200px; margin-bottom:0;">
                    <strong>c. Status Gizi</strong>
                </label>

                <?= $form->field($model, 'status_gizi', [
                        'template' => "{input}\n{error}",
                        'options' => ['class' => 'mb-0']
                    ])
                    ->radioList([
                        'ideal' => 'Ideal',
                        'kurang' => 'Kurang',
                        'obesitas' => 'Obesitas/Overweight',
                    ])->label(false) ?> 
            </div>

            <!-- ================= RIWAYAT ================= -->
            <div class="mb-3" style="font-size:14px;">

                <label style="margin-right:10px;">
                    <strong>5. Riwayat Penyakit Sekarang</strong>
                </label>

                <?= Html::textInput('Pengkajian[riwayat_penyakit_sekarang]', null, [
                    'style' => 'width:80%; display:inline-block; margin-left:5px;'
                ]) ?>
            </div>

            <div class="mb-3" style="font-size:14px;">
                <label style="margin-right:10px;">
                    <strong>6. Riwayat Penyakit Sebelumnya</strong>
                </label>
                <label style="margin-right:15px;">
                    <?= $form->field($model, 'riwayat_penyakit_sebelumnya')
                        ->checkboxList([
                            'dm' => 'DM',
                            'hipertensi' => 'Hipertensi',
                            'jantung' => 'Jantung',
                            'lain' => 'Lain-lain',
                        ])->label(false) ?>
                </label>
            </div>

            <div class="mb-3" style="font-size:14px;">

                <label style="margin-right:10px;">
                    <strong>7. Riwayat Penyakit</strong>
                </label>

                <label style="margin-right:15px;">
                    <?= Html::radio('Pengkajian[riwayat_penyakit]', false, [
                        'value' => 'ya',
                        'id' => 'ya'
                    ]) ?>
                    Ya
                </label>

                <label style="margin-right:10px;">
                    <?= Html::radio('Pengkajian[riwayat_penyakit]', false, [
                        'value' => 'tidak',
                        'id' => 'tidak'
                    ]) ?>
                    Tidak
                </label>

            </div>

            <div class="mb-3" style="font-size:14px;">

                <label style="margin-right:10px;">
                    <strong>8. Riwayat Penyakit Keluarga</strong>
                </label>

                <?= Html::textInput('Pengkajian[riwayat_penyakit_keluarga]', null, [
                    'style' => 'width:80%; display:inline-block; margin-left:5px;'
                ]) ?>
            </div>

            <div class="mb-3" style="font-size:14px;">

                <label style="margin-right:10px;">
                    <strong>9. Riwayat Operasi</strong>
                </label>

                <label style="margin-right:15px;">
                    <?= Html::radio('Pengkajian[riwayat_operasi]', false, [
                        'value' => 'ya',
                        'id' => 'ya'
                    ]) ?>
                    Ya
                </label>

                <label style="margin-right:10px;">
                    <?= Html::radio('Pengkajian[riwayat_operasi]', false, [
                        'value' => 'tidak',
                        'id' => 'tidak'
                    ]) ?>
                    Tidak
                </label>
                <span style="margin-left:10px;">Operasi apa ? :</span>
                <?= Html::textInput('Pengkajian[operasi_apa]', null, [
                    'style' => 'width:120px; display:inline-block; margin-left:5px;'
                ]) ?>

                <span style="margin-left:10px;">Kapan di Operasi ? :</span>
                <?= Html::textInput('Pengkajian[kapan_di_operasi]', null, [
                    'style' => 'width:120px; display:inline-block; margin-left:5px;'
                ]) ?>

            </div>

            <div class="mb-3" style="font-size:14px;">

                <label style="margin-right:10px;">
                    <strong>10. Riwayat Pernah dirawat di RS</strong>
                </label>

                <label style="margin-right:15px;">
                    <?= Html::radio('Pengkajian[riwayat_pernah_dirawat_di_rs]', false, [
                        'value' => 'ya',
                        'id' => 'ya'
                    ]) ?>
                    Ya
                </label>

                <label style="margin-right:10px;">
                    <?= Html::radio('Pengkajian[Pengkajian[riwayat_pernah_dirawat_di_rs]', false, [
                        'value' => 'tidak',
                        'id' => 'tidak'
                    ]) ?>
                    Tidak
                </label>

                <span style="margin-left:10px;">Penyakit apa ? :</span>
                <?= Html::textInput('Pengkajian[penyakit_apa]', null, [
                    'style' => 'width:120px; display:inline-block; margin-left:5px;'
                ]) ?>

                <span style="margin-left:10px;">Kapan dirawat di RS ? :</span>
                <?= Html::textInput('Pengkajian[kapan_dirawat_di_rs]', null, [
                    'style' => 'width:120px; display:inline-block; margin-left:5px;'
                ]) ?>

            </div>

            <div class="mb-3" style="font-size:14px;">
                <label style="margin-right:10px;">
                    <strong>11. Pengkajian Resiko Jatuh</strong>
                </label>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered table-sm" style="font-size:13px;">
                        <thead class="table-light text-center">
                            <tr>
                                <th style="width:5%">No</th>
                                <th>Resiko</th>
                                <th style="width:15%">Skala</th>
                                <th style="width:10%">Hasil</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- 1 -->
                            <tr>
                                <td class="text-center">1</td>
                                <td>Riwayat jatuh dalam 3 bulan terakhir</td>
                                <td>
                                    Tidak = 0 <br>
                                    Ya = 25
                                </td>
                                <td>
                                    <?= Html::textInput('Pengkajian[resiko1]', null, [
                                        'class' => 'form-control form-control-sm text-center'
                                    ]) ?>
                                </td>
                            </tr>

                            <!-- 2 -->
                            <tr>
                                <td class="text-center">2</td>
                                <td>Diagnosa medis sekunder &gt; 1</td>
                                <td>
                                    Tidak = 0 <br>
                                    Ya = 15
                                </td>
                                <td>
                                    <?= Html::textInput('Pengkajian[resiko2]', null, [
                                        'class' => 'form-control form-control-sm text-center'
                                    ]) ?>
                                </td>
                            </tr>

                            <!-- 3 -->
                            <tr>
                                <td class="text-center">3</td>
                                <td>
                                    Alat bantu jalan:
                                    <ul style="margin-bottom:0;">
                                        <li>Mandiri / dibantu perawat / kursi roda = 0</li>
                                        <li>Penopang / tongkat / walker = 15</li>
                                        <li>Mencengkeram furniture = 15</li>
                                    </ul>
                                </td>
                                <td>-</td>
                                <td>
                                    <?= Html::textInput('Pengkajian[resiko3]', null, [
                                        'class' => 'form-control form-control-sm text-center'
                                    ]) ?>
                                </td>
                            </tr>

                            <!-- 4 -->
                            <tr>
                                <td class="text-center">4</td>
                                <td>Ad akses IV / terapi heparin lock</td>
                                <td>
                                    Tidak = 0 <br>
                                    Ya = 20
                                </td>
                                <td>
                                    <?= Html::textInput('Pengkajian[resiko4]', null, [
                                        'class' => 'form-control form-control-sm text-center'
                                    ]) ?>
                                </td>
                            </tr>

                            <!-- 5 -->
                            <tr>
                                <td class="text-center">5</td>
                                <td>
                                    Cara berjalan / berpindah:
                                    <ul style="margin-bottom:0;">
                                        <li>Normal = 0</li>
                                        <li>Lemah / langkah diseret = 10</li>
                                        <li>Terganggu / perlu bantuan = 20</li>
                                    </ul>
                                </td>
                                <td>-</td>
                                <td>
                                    <?= Html::textInput('Pengkajian[resiko5]', null, [
                                        'class' => 'form-control form-control-sm text-center'
                                    ]) ?>
                                </td>
                            </tr>

                            <!-- 6 -->
                            <tr>
                                <td class="text-center">6</td>
                                <td>
                                    Status mental:
                                    <ul style="margin-bottom:0;">
                                        <li>Orientasi baik = 0</li>
                                        <li>Lupa keterbatasan diri = 15</li>
                                    </ul>
                                </td>
                                <td>-</td>
                                <td>
                                    <?= Html::textInput('Pengkajian[resiko6]', null, [
                                        'class' => 'form-control form-control-sm text-center'
                                    ]) ?>
                                </td>
                            </tr>

                            <!-- TOTAL -->
                            <tr class="table-secondary">
                                <td colspan="3" class="text-end"><strong>Nilai Total</strong></td>
                                <td>
                                    <?= Html::textInput('Pengkajian[total_resiko]', null, [
                                        'class' => 'form-control form-control-sm text-center',
                                        'readonly' => true,
                                        'id' => 'totalResiko'
                                    ]) ?>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

            </div>

            <div class="text-end">
                <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
                <?= Html::a('Kembali', ['index'], ['class' => 'btn btn-secondary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>

<?php
$js = <<<JS
function hitungIMT(){
    let bb = parseFloat($('#bb').val());
    let tb = parseFloat($('#tb').val());
    if(bb>0 && tb>0){
        let imt = bb / Math.pow(tb/100,2);
        $('#imt').val(imt.toFixed(2));
    }
}

$('#bb,#tb').on('keyup change',hitungIMT);

$('.resiko').on('keyup change',function(){
    let total = 0;
    $('.resiko').each(function(){
        total += parseInt($(this).val()) || 0;
    });
    $('#totalResiko').val(total);
});
JS;
$this->registerJs($js);
?>

