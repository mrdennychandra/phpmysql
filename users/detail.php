<?php
include '../konfigurasi/config.php';
include '../fragment/header.php';
include '../konfigurasi/function.php';
?>
<body>
    <header>
        <h1>Detail User</h1>
    </header>
    <nav>
        <?php include '../fragment/menu.php' ?>
    </nav>
    <main>
        <h3></h3>
        <?php
        if (isset($_GET['userid'])) {
            $con = connect_db();
            $userid = $_GET['userid'];
            $query = "SELECT users.*,karyawan.nama FROM users  "
                    . "INNER JOIN karyawan on karyawan.karyawanid=users.karyawanid WHERE userid='$userid'";
            $result = execute_query($con, $query);
            $data = mysqli_fetch_array($result);
            ?>
        <table>
             <tr>
                <th>Nama</th>
                <td><?= $data['nama'] ?></td>
            </tr>
            <tr>
                <th>Username</th>
                <td><?= $data['username'] ?></td>
            </tr>
             <tr>
                <th>Foto</th>
                <td>
                    <img src="<?= BASEPATH . '/image/' . $data['gambar'] ?>" height="100" width="100"></td>
            </tr> 
            <tr>
                <th>Role</th>
                <td><?= $data['role'] ?></td>
            </tr>
        </table>
        <?php
        }else{
            header("location:index.php");
        }
        ?>
    </main>
    <?php include '../fragment/footer.php'; ?>