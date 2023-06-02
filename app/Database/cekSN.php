<?php

$koneksi = mysqli_connect("localhost", "root", "", "appts");

$sn = $_POST["sn"];

$query = mysqli_query($koneksi, "SELECT * FROM tbl_proses WHERE sn = '$sn'  ");

if (mysqli_num_rows($query) > 0) {
    echo "<span class='text-danger'>nama sudah ada</span>";
} else {
    echo "<span class='text-success'>Nama Berhasil di Konfirmasi</span>";
}
