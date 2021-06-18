<?php
include 'chklgn.php';
if (!isset($logedin)) {
    exit();
}

if (isset($_POST['status']) && isset($_POST['slug']) && isset($_POST['title']) && isset($_POST['tags']) && isset($_POST['category']) && isset($_POST['content']) && isset($_POST['photo'])) {
    $status = $_POST['status'];
    $slug = $_POST['slug'];
    $title = $_POST['title'];
    $tags = $_POST['tags'];
    $category = $_POST['category'];
    $content = $_POST['content'];
    $data = date("Y-m-d H:i:s");
    $creator = $result['ID'];
    $photo = $_POST['photo'];

    $sql = "INSERT INTO post (status, title, slug, content, category, tags, creator, data, photo) 
    VALUES ($status, '$title', '$slug', '$content', $category, '$tags', $creator, '$data', '$photo')";
    echo $sql;
    echo mysqli_query($conn, $sql);

    include 'config.php';
    header("Location: $link/admin.php");
} else {
    echo "Brak danych!";
}
