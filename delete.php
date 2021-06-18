<?php 
include 'chklgn.php';
if (!isset($logedin)) {
    exit();
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM post WHERE id='$id'";
    mysqli_query($conn, $sql);

    include 'config.php';
    header("Location: $link/admin.php");
}

?>