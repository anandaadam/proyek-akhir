<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?= base_url("/"); ?>"><?= session("tipePengguna"); ?></a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="">
                <a class="nav-link" href="/"><i class="fas fa-th-large"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Master Data</li>
            <li class="">
                <a class="nav-link" href="<?= base_url('Supplier/index') ?>"><i class="fas fa-truck"></i><span>Supplier</span></a>
            </li>
            <li class="">
                <a class="nav-link" href="<?= base_url('PersediaanBahan/index') ?>"><i class="fas fa-warehouse"></i><span>Persediaan Bahan</span></a>
            </li>
            <li class="">
                <a class="nav-link" href="<?= base_url('BillOfMaterial/index') ?>"><i class="fas fa-layer-group"></i><span>Bill of Material</span></a>
            </li>
            <li class="menu-header">Transaksi</li>
            <li class="">
                <a class="nav-link" href="<?= base_url('PermintaanBahan/create') ?>"><i class="fas fa-paste"></i><span>Permintaan Bahan</span></a>
            </li>
            <li class="">
                <a class="nav-link" href="<?= base_url('Pembelian/create') ?>"><i class="fas fa-boxes"></i><span>Pembelian</span></a>
            </li>
            <li class="">
                <a class="nav-link" href="<?= base_url('UtangPembelian/index') ?>"><i class="fas fa-credit-card"></i><span>Utang Pembelian</span></a>
            </li>
            <li class="">
                <a class="nav-link" href="<?= base_url('ReturPembelian/create') ?>"><i class="fas fa-share"></i><span>Retur Pembelian</span></a>
            </li>
            <li class="menu-header">Laporan</li>
            <li class="">
                <a class="nav-link" href="<?= base_url('JurnalUmum/index') ?>"><i class="fas fa-book"></i><span>Jurnal Umum</span></a>
            </li>
            <li class="">
                <a class="nav-link" href="<?= base_url('BukuBesar/index') ?>"><i class="fas fa-book-open"></i><span>Buku Besar</span></a>
            </li>
            <li class="">
                <a class="nav-link" href="/laba-rugi"><i class="fas fa-file-invoice-dollar"></i><span>Laba Rugi</span></a>
            </li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div>
    </aside>
</div>