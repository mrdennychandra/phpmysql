<?php
//simkaryawan/index.php
include './konfigurasi/config.php';
include './fragment/header.php';
include './konfigurasi/function.php';
cek_session();
?>
    <header>
        <h1>Sistem Informasi Manajemen Karyawan</h1>
    </header>
    <nav>
        <?php include 'fragment/menu.php' ?>
    </nav>
    <main>
        <h2>Dashboard</h2>
    </main>
    <?php include './fragment/footer.php'; ?>