<?php
include '../konfigurasi/config.php';
include '../fragment/header.php';
include '../konfigurasi/function.php';
?>
<body>
    <header>
        <h1>Tambah Divisi</h1>
    </header>
    <nav>
        <?php include '../fragment/menu.php' ?>
    </nav>
    <main>
        <h3></h3>
        <?php
        if (isset($_POST['submit'])) {
            $kode = $_POST['kode'];
            $nama = $_POST['nama'];
            if (empty($kode)) {
                echo "kode divisi harus diisi";
            } elseif (empty($nama)) {
                echo "nama divisi harus diisi";
            } else {
                $con = connect_db();
                //cek apakah kode sudah ada,karena kode adalah unik
                $query = "SELECT divisiid FROM divisi WHERE kode='$kode'";
                $result = execute_query($con, $query);
                if (mysqli_num_rows($result) != 0) {
                    //kode sudah ada
                    echo "<div>Kode $kode sudah terdaftar</div>";
                } else {
                    $query = "INSERT INTO divisi (kode,nama) "
                            . "VALUES ('$kode','$nama')";
                    $result = execute_query($con, $query);
                    if (mysqli_affected_rows($con) != 0) {
                        header("location:index.php");
                    }
                }
            }
        }
        ?>
        <form 
            name="formtambah" 
            method="post" 
            id="formtambah">
            <div>
                <label for="nama">Kode Divisi:</label>
                <input type="text" name="kode" id="kode"
                       size="3" required="required">
            </div>
            <div>
                <label for="telpon">Nama Divisi:</label> 
                <input type="text" name="nama" id="nama" 
                       required="required" size="30">
            </div>
            <div>
                <input type="submit" value="Simpan" id="submit" name="submit">
            </div>
        </form>
    </main>
    <?php
    include '../fragment/footer.php';
    ?>