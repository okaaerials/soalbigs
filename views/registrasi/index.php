<?php
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Registrasi[] $data */

$this->title = 'Data Registrasi';
?>

<div class="container mt-4" style="height: 70vh;">

   

    <div class="card">
        <div class="card-header">
            <strong>List Registrasi</strong>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th width="5%">No</th>
                            <th>No Registrasi</th>
                            <th>Nomor Rekam Medis</th>
                            <th>Nama Pasien</th>
                            <th>Tanggal Lahir</th>
                            <th>NIK</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data)): ?>
                            <?php $no = 1; ?>
                            <?php foreach ($data as $item): ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td><?= Html::encode(str_pad($item->no_registrasi, 8, '0', STR_PAD_LEFT)) ?></td>
                                    <td><?= implode('-', str_split(str_pad($item->no_rekam_medis,8,'0',STR_PAD_LEFT),2)) ?></td>
                                    <td><?= Html::encode($item->nama_pasien) ?></td>
                                    <td><?= Html::encode($item->tanggal_lahir) ?></td>
                                    <td><?= Html::encode($item->nik) ?></td>
                                    <td class="text-center">

                                    <?= Html::a('Input', 
                                        ['/pengkajian/create', 'id_registrasi' => $item->id_registrasi], 
                                        ['class' => 'btn btn-info btn-sm']
                                    ) ?>

                                        <?= Html::a('Edit', ['update', 'id' => $item->id_registrasi], [
                                            'class' => 'btn btn-warning btn-sm'
                                        ]) ?>

                                        <?= Html::a('Delete', ['delete', 'id' => $item->id_registrasi], [
                                            'class' => 'btn btn-danger btn-sm',
                                            'data' => [
                                                'confirm' => 'Apakah Anda yakin ingin menghapus data ini?',
                                                'method' => 'post',
                                            ],
                                        ]) ?>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">
                                    Data belum tersedia
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
