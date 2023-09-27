<footer class="main-footer">
    <div class="footer-left">
        Copyright &copy; 2023 <div class="bullet"></div> Design By <a href="">BEM BiU</a>
    </div>
    <div class="footer-right">
        2.3.0
    </div>
</footer>
</div>
</div>

<!-- General JS Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="<?= base_url(); ?>assets/js/stisla.js"></script>

<!-- JS Libraies -->
<script src="<?= base_url(); ?>node_modules/summernote/dist/summernote-bs4.js"></script>
<script src="<?= base_url(); ?>node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>


<!-- JS Libraies -->
<script src="<?= base_url(); ?>node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/buttons.flash.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/jszip.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/pdfmake.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/vfs_fonts.js"></script>
<script src="<?= base_url('assets/'); ?>js/buttons.html5.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/buttons.print.min.js"></script>

<script src="<?= base_url(); ?>node_modules/sweetalert/dist/sweetalert.min.js"></script>
<!-- JS Libraies -->
<script src="<?= base_url(); ?>node_modules/izitoast/dist/js/iziToast.min.js"></script>
<?= $this->session->flashdata('toast'); ?>
<!-- Template JS File -->
<script src="<?= base_url(); ?>assets/js/scripts.js"></script>
<script src="<?= base_url(); ?>assets/js/custom.js"></script>

<!-- Page Specific JS File -->
<script src="<?= base_url(); ?>assets/js/page/bootstrap-modal.js"></script>
<script type='text/javascript'>
    function getDel(id) {
        const getDel = document.getElementById("hapusPaslon" + id)
        swal({
            title: 'Apakah anda yakin?',
            text: 'Apakah anda ingin menghapus ' + getDel.dataset.ntipe + ' ' + id + ' ?',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                window.location.replace(getDel.dataset.link)
            }
        });
    }

    function getDelAkses(id) {
        const getDel = document.getElementById("hapusAksesPaslon" + id)
        swal({
            title: 'Apakah anda yakin?',
            text: 'Apakah anda ingin menghapus akses ' + getDel.dataset.ntipe + ' ' + id + ' ?',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                window.location.replace(getDel.dataset.link)
            }
        });
    }

    $('.custom-file-input').on('change', function() {
        let filename = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(filename);
    });
    $(document).ready(function() {
        $('.userinfo').click(function() {
            var userid = $(this).data('id');
            $.ajax({
                url: '<?= base_url($user['level'] == 'admin' ? 'admin/modal' : 'user/modal'); ?>',
                type: 'post',
                data: {
                    userid: userid
                },
                success: function(response) {
                    $('.visi-misi-mod').html(response);
                    $('#empModal').modal('show');
                }
            });
        });
    });
</script>
<?php if ($title == 'Hasil Suara') { ?>
    <script src="<?= base_url('old_assets/'); ?>lib/chart/chart.min.js"></script>
    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["PASLON 1", "PASLON 2"],
                datasets: [{
                    label: 'Jumlah Suara',
                    data: [
                        <?= $paslon1; ?>,
                        <?= $paslon2; ?>
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            }
        });
    </script>
<?php } ?>
</body>

</html>