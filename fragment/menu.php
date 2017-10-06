<b><a href="<?= BASEPATH ?>/index.php">Home</a> | 
    <a href="<?= BASEPATH ?>/divisi">Divisi</a> | 
    <a href="<?= BASEPATH ?>/karyawan">Karyawan</a> | 
    <?php
    if (is_admin()) {
        ?>
        <a href="<?= BASEPATH ?>/users">User</a> | 
        <?php
    } else {
        ?>
        <a href="<?= BASEPATH ?>/changepassword">Ganti Password</a> | 
        <?php
    }
    ?>
    <a href="<?= BASEPATH ?>/logout.php">Logout</a></b>