<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->registerCsrfMetaTags();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= Html::encode($this->title) ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>

    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= Url::to(['/site/index']) ?>">
            <i class="fa fa-hospital"></i> BIGS
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::to(['/site/index']) ?>">
                        <i class="fa fa-home"></i> Home
                    </a>
                </li>

                <?php if (Yii::$app->user->isGuest): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= Url::to(['/site/login']) ?>">
                            <i class="fa fa-sign-in-alt"></i> Login
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= Url::to(['/registrasi/create']) ?>">
                            <i class="fa fa-file"></i> Registrasi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= Url::to(['/registrasi/index']) ?>">
                            <i class="fa fa-file"></i> Form
                        </a>
                    </li>
                    <li class="nav-item">
                        <?= Html::beginForm(['/site/logout'], 'post') ?>
                        <?= Html::submitButton(
                            '<i class="fa fa-sign-out-alt"></i> Logout (' . Yii::$app->user->identity->username . ')',
                            ['class' => 'nav-link btn btn-link text-white']
                        ) ?>
                        <?= Html::endForm() ?>
                    </li>
                <?php endif; ?>

                

            </ul>
        </div>
    </div>
</nav>


<div class="container mt-4">
    <?= $content ?>
</div>

<footer class="bg-light text-center py-3 mt-5">
    <small>&copy; <?= date('Y') ?> Muhammad Sayuti</small>
</footer>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
$success = Yii::$app->session->getFlash('success');
$error = Yii::$app->session->getFlash('error');

if ($success) {
    $this->registerJs("
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '$success',
            timer: 2000,
            showConfirmButton: false
        });
    ");
}

if ($error) {
    $this->registerJs("
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '$error'
        });
    ");
}
?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
