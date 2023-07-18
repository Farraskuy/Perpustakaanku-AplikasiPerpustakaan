<!-- Jquery -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<!-- Boostrap script-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

<script>
    // side bar toggler
    function toggleSidebar() {
        const main = document.querySelector('.main');
        main.classList.toggle('active');
    }

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    <?= session()->getFlashdata('pesan') ? 'peringatan("' . session()->getFlashdata('pesan')  . '", "success")' : '' ?>
    <?= session()->getFlashdata('error') ? 'peringatan("' . session()->getFlashdata('error')  . '", "danger")' : '' ?>

    function peringatan(isi, type) {
        const notifContainer = document.getElementById('notifContainer');
        const template = ` 
            <div class="col-5 alert alert-${type} d-flex alert-dismissible fade show" role="alert">
                <div>${isi}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`
        notifContainer.innerHTML = template;
        setTimeout(() => {
            notifContainer.classList.add('active');
        }, 500);
        setTimeout(() => {
            notifContainer.classList.remove('active');
        }, 4000);
    }

    function valueToFormatRupiah(e) {
        const formattedValue = formatRupiah(e.value);
        e.value = formattedValue;
        e.previousElementSibling.value = formattedValue.replace(/[^0-9]/g, '');
    }

    function formatRupiah(value) {
        if (!value) value = 0;
        value += '';
        const rawValue = value.replace(/[^0-9]/g, '');
        const formattedValue = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(rawValue);
        return formattedValue.split(',')[0];
    }

    const dendaRusak = <?= isset($config['denda_rusak']) ? $config['denda_rusak'] : 0 ?>;
    const dendaHilang = <?= isset($config['denda_hilang']) ? $config['denda_hilang'] : 0 ?>;
    const inputDendaTelat = document.getElementById('denda_telat');
    const inputDendaKondisi = document.getElementById('denda_kondisi');
    const inputJumlahDenda = document.getElementById('jumlah_denda');
    const inputKembali = document.getElementById('kembali');
    const inputBayar = document.getElementById('bayar');

    if (inputBayar) {
        inputBayar.addEventListener('input', (e) => {
            valueToFormatRupiah(inputBayar);
            hitungKembali()
        })
        hitungKembali();
    }

    function cekKondisi(element) {
        const kondisi = element.value;
        const kondisiLama = element.getAttribute('kondisi-lama');
        element.setAttribute('kondisi-lama', kondisi);

        const inputDendaKondisi = document.getElementById('denda_kondisi');
        let dendaKondisi = parseInt(inputDendaKondisi.value.replace(/[^0-9]/g, ''));

        let dendaLama = 0;
        if (kondisiLama == 'rusak') dendaLama = dendaRusak;
        if (kondisiLama == 'hilang') dendaLama = dendaHilang;
        dendaKondisi -= dendaLama;

        let denda = 0;
        if (kondisi == 'rusak') denda = dendaRusak;
        if (kondisi == 'hilang') denda = dendaHilang;
        dendaKondisi += denda;

        inputDendaKondisi.value = formatRupiah(dendaKondisi);

        hitungTotal()
    }

    function hitungTotal() {
        const dendaTelat = parseInt(inputDendaTelat.value.replace(/[^0-9]/g, ''));
        const dendaKondisi = parseInt(inputDendaKondisi.value.replace(/[^0-9]/g, ''));
        inputJumlahDenda.value = formatRupiah(dendaTelat + dendaKondisi);
        hitungKembali()
    }

    function hitungKembali() {
        const jumlahDenda = parseInt(inputJumlahDenda.value.replace(/[^0-9]/g, ''));
        const bayar = parseInt(inputBayar.value.replace(/[^0-9]/g, ''));
        console.log(jumlahDenda);
        console.log(bayar);
        if (!jumlahDenda || jumlahDenda > bayar) {
            inputKembali.value = formatRupiah();
        } else {
            inputKembali.value = formatRupiah(jumlahDenda - bayar);
        }
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
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');

            const modalContent = hapusModal.querySelector('.modal-content');
            const action = modalContent.getAttribute('action');
            modalContent.setAttribute('action', action + id);
        })
    }
    const hapusdetailModal = document.getElementById('hapusdetail')
    if (hapusdetailModal) {
        hapusdetailModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');

            const modalContent = hapusdetailModal.querySelector('.modal-content');
            const action = modalContent.getAttribute('action');
            modalContent.setAttribute('action', action + id);
        })
    }
    const perpanjangModal = document.getElementById('perpanjang')
    if (perpanjangModal) {
        perpanjangModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');

            const modalContent = perpanjangModal.querySelector('.modal-content');
            const action = modalContent.getAttribute('action');
            modalContent.setAttribute('action', action + id);
        })
    }
    const pengembalianModal = document.getElementById('pengembalian')
    if (pengembalianModal) {
        pengembalianModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');

            const modalContent = pengembalianModal.querySelector('.modal-footer a');
            const action = modalContent.getAttribute('href');
            modalContent.setAttribute('href', action + id);
        })
    }
    const editMasterBukuModal = document.querySelector('.editMasterBuku')
    if (editMasterBukuModal) {
        editMasterBukuModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const nilai = button.getAttribute('data-nilai');

            const input = editMasterBukuModal.querySelector('#kategori_edit');
            input.value = nilai;
            const modalContent = editMasterBukuModal.querySelector('.modal-content');
            const action = modalContent.getAttribute('action');
            modalContent.setAttribute('action', action + id);
        })
    }

    function toggleFormAkses(value) {
        const form = document.getElementById('formAksesLogin');
        if (value == "petugas") {
            form.removeAttribute('disabled');
        } else {
            form.setAttribute('disabled', 'true');
        }
    }

    if (document.getElementById('tambah')) {
        const modalTambah = new bootstrap.Modal('#tambah', {
            keyboard: false
        });
        <?php if (session()->getFlashdata('error_tambah')) : ?>
            modalTambah.show();
        <?php endif ?>
    }
    if (document.getElementById('edit')) {
        const modalEdit = new bootstrap.Modal('#edit', {
            keyboard: false
        });
        <?php if (session()->getFlashdata('error_edit')) : ?>
            modalEdit.show();
        <?php endif ?>
    }
    if (document.getElementById('reset')) {
        const modalReset = new bootstrap.Modal('#reset', {
            keyboard: false
        });
        <?php if (session()->getFlashdata('error_password')) : ?>
            modalReset.show();
        <?php endif ?>
    }
    if (document.getElementById('pinjamBuku')) {
        const modalPinjamBuku = new bootstrap.Modal('#pinjamBuku', {
            keyboard: false
        });
        <?php if (session()->getFlashdata('error_pinjam_buku')) : ?>
            modalPinjamBuku.show();
        <?php endif ?>
    }
    if (document.getElementById('perpanjang')) {
        const modalPerpanjang = new bootstrap.Modal('#perpanjang', {
            keyboard: false
        });
        <?php if (session()->getFlashdata('error_perpanjang')) : ?>
            modalPerpanjang.show();
        <?php endif ?>
    }
</script>