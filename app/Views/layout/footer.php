<!-- Jquery -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<!-- Boostrap script-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    const myModal = new bootstrap.Modal('.form-modal', {
        keyboard: false
    });
    const myResetModal = new bootstrap.Modal('.form-modal-reset', {
        keyboard: false
    });

    if (myModal) {
        myModal.hide();
    }
    if (myResetModal) {
        myResetModal.hide();
    }
    
    <?php if (in_groups('admin')) : ?>
        <?php if (session()->getFlashdata('error_password')) : ?>
            myResetModal.show();
        <?php elseif (validation_errors()) : ?>
            myModal.show();
        <?php endif ?>
    <?php endif ?>
</script>