<?php
$conn = mysqli_connect('localhost', 'root', '', 'appts');
if (!$conn) {
    echo '<h1>Koneksi database error</h1>';
}
