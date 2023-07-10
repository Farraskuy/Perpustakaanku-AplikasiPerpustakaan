<!-- Jquery -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<!-- Boostrap script-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    <?= session()->getFlashdata('pesan') ? 'peringatan("' . session()->getFlashdata('pesan')  . '")' : '' ?>

    function peringatan(isi) {
        const notifContainer = document.getElementById('notifContainer');
        const template = ` 
            <div class="col-5 alert alert-success d-flex alert-dismissible fade show" role="alert">
                <div>${isi}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`
        notifContainer.innerHTML = template;
        setTimeout(() => {
            notifContainer.classList.add('active');
        }, 500);
        setTimeout(() => {
            notifContainer.classList.remove('active');
        }, 3000);
    }

    function ubahPreview(input) {
        const preview = document.querySelector('.sampulPreview');

        const filesampul = new FileReader();
        filesampul.readAsDataURL(input.files[0]);

        filesampul.onload = function(e) {
            preview.src = e.target.result;
        }
    }

    const hapusModal = document.getElementById('hapus')
    if (hapusModal) {
        hapusModal.addEventListener('show.bs.modal', event => {

            const button = event.relatedTarget
            const idPinjam = button.getAttribute('data-bs-idpinjam')

            const modalContent = hapusModal.querySelector('.modal-content');
            const action = modalContent.getAttribute('action');
            modalContent.setAttribute('action', action + idPinjam)


        })
    }


    const main = document.querySelector('.main');

    function toggleSidebar() {
        main.classList.toggle('active');
    }

    let myModal;
    if (document.querySelector('.form-modal')) {
        myModal = new bootstrap.Modal('.form-modal', {
            keyboard: false
        });
        myModal.hide();
    }
    let myResetModal;
    if (document.querySelector('.form-modal-reset')) {
        myResetModal = new bootstrap.Modal('.form-modal-reset', {
            keyboard: false
        });
        myResetModal.hide();
    }

    <?php if (in_groups('admin')) : ?>
        <?php if (session()->getFlashdata('error_password')) : ?>
            myResetModal.show();
        <?php elseif (validation_errors()) : ?>
            myModal.show();
        <?php endif ?>
    <?php endif ?>

    let pinjamModal;
    if (document.getElementById('pinjam')) {
        pinjamModal = new bootstrap.Modal('#pinjam', {
            keyboard: false
        });
        pinjamModal.hide();
    }

    <?php if (session()->getFlashdata('error_pinjam')) : ?>
        pinjamModal.show();
    <?php endif ?>
</script>