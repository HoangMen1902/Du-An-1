<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?= $this->section('styles') ?>
    <link rel="stylesheet" href="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/Styles/main.css">
</head>
<body>
    <header class=" w-100 text-center">
        <h1 class="text-danger">Đây là header</h1>
    </header>
    <div>
        <?= $this->section('main_content') ?>
    </div>
    <footer>
        <h1 class="text-primary text-center">Đây là footer</h1>
    </footer>
    <?= $this->section('scripts') ?>
</body>
</html>