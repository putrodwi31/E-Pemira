<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <img src="<?= base_url(); ?>assets/img/klogo2.png" alt="" width="30px" height="30px" style="margin-top: -5px; margin-right: 10px;">
            <a href="<?= base_url('admin'); ?>" style="font-size: large; color: #093d77;">E-PEMIRA</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= base_url('admin'); ?>">EP</a>
        </div>
        <ul class="sidebar-menu">

            <li <?= $title == 'Beranda' ? "class='active'" : ''; ?>><a class="nav-link" href="<?= base_url($user['level'] == 'admin' ? 'admin' : 'user'); ?>"><i class="fas fa-tv"></i><span>Beranda</span></a></li>
            <?php if ($user['level'] == 'admin') { ?>
                <li <?= $title == 'Input Data Paslon' ? "class='active'" : ''; ?>><a class="nav-link" href="<?= base_url('admin/data_paslon'); ?>"><i class="fas fa-user"></i><span>Input Data Paslon</span></a></li>
                <li <?= $title == 'Upload DPT' ? "class='active'" : ''; ?>><a class="nav-link" href="<?= base_url('admin/dpt'); ?>"><i class="fas fa-file"></i><span>Upload DPT</span></a></li>
                <li <?= $title == 'Buat Akses' ? "class='active'" : ''; ?>><a class="nav-link" href="<?= base_url('admin/akses'); ?>"><i class="fas fa-key"></i><span>Buat Akses</span></a></li>
                <li <?= $title == 'Hasil Suara' ? "class='active'" : ''; ?>><a class="nav-link" href="<?= base_url('admin/hasil'); ?>"><i class="fas fa-chart-bar"></i><span>Hasil Suara</span></a></li>
            <?php } ?>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a class="btn btn-danger btn-lg btn-block btn-icon-split text-white" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </a>
        </div>
    </aside>
</div>