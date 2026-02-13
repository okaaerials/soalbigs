<?php
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Registrasi[] $data */

$this->title = 'Data Registrasi';
?>

<div class="container mt-4" style="height: 70vh;">

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= Yii::$app->session->getFlash('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow">
        <div class="card-header">
            <strong>List Registrasi</strong>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover align-middle">
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

                                    <td>
                                        <?= Html::encode(str_pad($item->no_registrasi, 8, '0', STR_PAD_LEFT)) ?>
                                    </td>

                                    <td>
                                        <?= Html::encode(
                                            implode('-', str_split(str_pad($item->no_rekam_medis ?? 0, 8, '0', STR_PAD_LEFT), 2))
                                        ) ?>
                                    </td>

                                    <td><?= Html::encode($item->nama_pasien) ?></td>

                                    <td>
                                        <?= Yii::$app->formatter->asDate($item->tanggal_lahir, 'php:d-m-Y') ?>
                                    </td>

                                    <td><?= Html::encode($item->nik) ?></td>

                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">

                                            <?= Html::a('Input', 
                                                ['/pengkajian/create', 'id_registrasi' => $item->id_registrasi], 
                                                ['class' => 'btn btn-info btn-sm']
                                            ) ?>

                                            <?= Html::a('Edit', 
                                                ['update', 'id_registrasi' => $item->id_registrasi], 
                                                ['class' => 'btn btn-warning btn-sm']
                                            ) ?>

                                            <?= Html::beginForm(
                                                ['delete', 'id_registrasi' => $item->id_registrasi],
                                                'post',
                                                ['class' => 'd-inline delete-form']
                                            ) ?>

                                            <?= Html::submitButton('Delete', [
                                                'class' => 'btn btn-danger btn-sm btn-delete'
                                            ]) ?>

                                            <?= Html::endForm() ?>

                                        </div>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted">
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

<?php
// Register SweetAlert
$this->registerJsFile(
    'https://cdn.jsdelivr.net/npm/sweetalert2@11',
    ['depends' => [\yii\web\JqueryAsset::class]]
);

// SweetAlert Delete Confirmation
$this->registerJs("
$(document).on('click', '.btn-delete', function(e) {
    e.preventDefault();
    let form = $(this).closest('form');

    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: 'Data yang dihapus tidak dapat dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});
");
?>
