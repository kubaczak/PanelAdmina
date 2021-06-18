<?php
include 'chklgn.php';
if (!isset($logedin) || !isset($_GET['id'])) {
    exit();
}

$id = $_GET['id'];

if (isset($_POST['status']) && isset($_POST['slug']) && isset($_POST['title']) && isset($_POST['tags']) && isset($_POST['category']) && isset($_POST['content'])) {
    $status = $_POST['status'];
    $slug = $_POST['slug'];
    $title = $_POST['title'];
    $tags = $_POST['tags'];
    $category = $_POST['category'];
    $content = $_POST['content'];
    $photo = $_POST['photo'];

    $sql = "UPDATE post SET status=$status, slug='$slug', title='$title', tags='$tags', category=$category, content='$content', photo='$photo' WHERE id='$id'";
    echo $sql;
    echo mysqli_query($conn, $sql);

    include 'config.php';
    header("Location: $link/admin.php");
} else {
    echo "Brak danych!";
}
