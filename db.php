<?php
$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "dpwh_projecthub"
);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>