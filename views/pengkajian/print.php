<?php
use yii\helpers\Html;

$registrasi = $model->registrasi;
?>

<html>
<head>
    <title>Print Pengkajian</title>
    <style>
        body { font-family: Arial; font-size: 12px; }
        table { width:100%; border-collapse: collapse; }
        td { padding:4px; }
        .bordered td { border:1px solid #000; }
    </style>
</head>
<body onload="window.print()">

<h3 style="text-align:center;">
    PENGKAJIAN KEPERAWATAN<br>
    POLIKLINIK KEBIDANAN
</h3>

<hr>

<?php if ($registrasi): ?>
<table>
    <tr>
        <td width="25%"><strong>Nama</strong></td>
        <td width="2%">:</td>
        <td><?= Html::encode($registrasi->nama ?? $registrasi->nama_pasien) ?></td>
    </tr>
    <tr>
        <td><strong>Tanggal Lahir</strong></td>
        <td>:</td>
        <td><?= Yii::$app->formatter->asDate($registrasi->tanggal_lahir,'php:d F Y') ?></td>
    </tr>
</table>
<hr>
<?php endif; ?>

<h4>1. Cara Masuk</h4>
<?= is_array($model->cara_masuk) 
    ? implode(', ', $model->cara_masuk) 
    : '-' ?>

<br><br>

<h4>2. Keluhan</h4>
<?= Html::encode($model->keluhan) ?>

<br><br>

<h4>3. Tanda Vital</h4>
<table class="bordered">
    <tr>
        <td>TD</td>
        <td><?= $model->td ?></td>
    </tr>
    <tr>
        <td>Nadi</td>
        <td><?= $model->nadi ?></td>
    </tr>
    <tr>
        <td>RR</td>
        <td><?= $model->rr ?></td>
    </tr>
    <tr>
        <td>Suhu</td>
        <td><?= $model->suhu ?></td>
    </tr>
</table>

</body>
</html>
