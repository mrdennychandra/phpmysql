<?php
include '../konfigurasi/config.php';
include '../fragment/header.php';
include '../konfigurasi/function.php';
cek_session();
?>
<body>
    <header>
        <h1>Daftar Divisi</h1>
    </header>
    <nav>
        <?php include '../fragment/menu.php' ?>
    </nav>
    <main>
        <?php
        if (is_admin()) {
            ?>
            <h3><a href="tambah.php">tambah</a></h3>
            <?php
        }
        ?>
        <table>
            <tr>
                <th>Kode Divisi</th>
                <th>Nama Divisi</th>
                <th>Aksi</th>
            </tr>
            <?php
            $con = connect_db();
            $query = "SELECT * FROM divisi";
            $result = execute_query($con, $query);
            while ($data = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td><?php echo $data['kode'] ?></td>
                    <td><?= $data['nama'] ?></td>
                    <!-- file : divisi/index.php -->
                    <td><a href="detail.php?divisiid=<?= $data['divisiid'] ?>">
                            Detail</a></td>
                    <?php
                    if (is_admin()) {
                        ?>
                        <td><a href="edit.php?divisiid=<?= $data['divisiid'] ?>">
                                Edit</a></td>
                        <td><a onclick="return confirm('akan menghapus data?')" 
                               href="hapus.php?divisiid=<?= $data['divisiid'] ?>">
                                Hapus</a></td>
                        <?php
                    }
                    ?>
                </tr>
                <?php
            }
            ?>
        </table>
    </main>
    <?php include '../fragment/footer.php'; ?>