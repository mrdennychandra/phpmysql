<?php
include '../konfigurasi/config.php';
include '../fragment/header.php';
include '../konfigurasi/function.php';
?>
<body>
    <header>
        <h1>Edit User</h1>
    </header>
    <nav>
        <?php include '../fragment/menu.php' ?>
    </nav>
    <main>
        <h3></h3>
        <?php
        $con = connect_db();
        if (isset($_POST['submit'])) {
            $userid = $_POST['userid'];
            $username = $_POST['username'];
            $role = $_POST['role'];
            $karyawanid = $_POST['karyawanid'];
            $file_name = $_POST['gambar_lama'];
            if (empty($username)) {
                echo "username harus diisi";
                //dst utk field lain
            } else {
                //cek apakah username sudah ada,karena username adalah unik
                $query = "SELECT username FROM users WHERE userid <> '$userid' AND username='$username'";
                $result = execute_query($con, $query);
                if (mysqli_num_rows($result) != 0) {
                    //kode sudah ada
                    echo "<div>Username $username sudah terdaftar</div>";
                    echo "<a href='#' onclick='history.back()'>back</a>";
                    exit;
                } else {
                    $query_image = "";
                    $query_password = "";
                    if (isset($_FILES['gambar']) &&
                            !empty($_FILES['gambar']['name'])) {
                        $errors = array();
                        $file_name = trim($_FILES['gambar']['name']);
                        $file_size = $_FILES['gambar']['size'];
                        $file_tmp = $_FILES['gambar']['tmp_name'];
                        $file_type = $_FILES['gambar']['type'];
                        $file_ext = strtolower(end(explode('.', $_FILES['gambar']['name'])));
                        $expensions = array("jpeg", "jpg", "png");
                        if (in_array($file_ext, $expensions) === false) {
                            echo "file harus berupa JPEG or PNG file.";
                        } else if ($file_size > 2097152) {
                            echo 'ukuran file max 2 MB';
                        } else {
                            move_uploaded_file($file_tmp, "../image/" . $file_name);
                        }
                    }
                    if (!empty($_POST['password'])) {
                        $password = md5($_POST['password']);
                        $query_password = ",password='$password'";
                    }
                    $query = "UPDATE users SET username='$username',gambar='$file_name' $query_password"
                            . ",role='$role',karyawanid='$karyawanid' WHERE userid='$userid'";
                    $result = execute_query($con, $query);
                    header("location:index.php");
                }
            }
        } else if (isset($_GET['userid'])) {
            //tampilkan data di form
            $con = connect_db();
            $userid = $_GET['userid'];
            $query = "SELECT users.*,karyawan.nama FROM users  "
                    . "INNER JOIN karyawan on karyawan.karyawanid=users.karyawanid WHERE userid='$userid'";
            $result = execute_query($con, $query);
            $data = mysqli_fetch_array($result);
        } else {
            header("location:index.php");
        }
        ?>
        <form 
            name="formedit" 
            method="post"  
            enctype="multipart/form-data"
            id="formedit">
            <input type="hidden" name="userid" id="userid" 
                   value="<?= $userid ?>">
            <input type="hidden" name="gambar_lama" id="gambar_lama" 
                   value="<?= $data['gambar'] ?>">
            <div>
                <label for="username">Username:</label>
                <input type="text" name="username" id="username"
                       value="<?= $data['username'] ?>"   size="30" required="required">
            </div>
            <div>
                <label for="password">Password</label> 
                <input type="text" name="password" id="password" size="30">
            </div>
            <div>
                <label for="gambar">Foto</label> 
                <input type="file" name="gambar" id="gambar">
                <img src="<?= BASEPATH . '/image/' . $data['gambar'] ?>" height="100" width="100">
            </div>
            <div>
                <label for="role">Role:</label> 
                <select name="role" id="role">
                    <?php
                    foreach ($role as $key => $value) {
                        $selected = "";
                        if ($key == $data['role']) {
                            $selected = "selected";
                        }
                        ?>
                        <option <?= $selected ?> value="<?= $key ?>"><?= $value ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="karyawanid">Nama Karyawan:</label> 
                <select name="karyawanid" id="karyawanid">
                    <?php
                    $query = "SELECT * FROM karyawan";
                    $result = execute_query($con, $query);
                    while ($karyawan = mysqli_fetch_array($result)) {
                        $selected = "";
                        if ($karyawan['karyawanid'] == $data['karyawanid']) {
                            $selected = "selected";
                        }
                        ?>
                        <option <?= $selected ?> value="<?= $karyawan['karyawanid'] ?>">
                            <?= $karyawan['nama'] ?></option>
                            <?php
                    }
                    ?>
                </select>
            </div>
            <div>
                <input type="submit" value="Simpan" id="submit" name="submit">
            </div>
        </form>
    </main>
    <?php
    include '../fragment/footer.php';
    ?>