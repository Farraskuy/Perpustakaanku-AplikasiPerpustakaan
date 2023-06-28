<!DOCTYPE html>
<html lang="en">

<?= $this->include('layout/header'); ?>

<body>

    <?= $this->include('layout/navbar'); ?>

    <?= $this->renderSection('content'); ?>

    <?= $this->include('layout/footer'); ?>

</body>

</html>