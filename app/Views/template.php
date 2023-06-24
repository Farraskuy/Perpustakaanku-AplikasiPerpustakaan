<!DOCTYPE html>
<html lang="en">

<?= $this->include('layout/header'); ?>

<body <?= $scrollSpy ? 'data-bs-spy="scroll" data-bs-target="#navbar" data-bs-smooth-scroll="true" tabindex="0"' : '' ?>>

    <?= $this->include('layout/navbar'); ?>

    <?= $this->renderSection('content'); ?>

    <?= $this->include('layout/footer'); ?>

</body>

</html>