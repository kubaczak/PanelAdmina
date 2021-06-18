<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Utwórz nowy post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
</head>

<body>

    <?php
    include 'chklgn.php';
    if (!isset($logedin) || !isset($_GET['id'])) {
        exit();
    }

    $id = $_GET['id'];
    $sql = "SELECT * FROM post WHERE id='$id'";
    $post = mysqli_query($conn, $sql);
    $post = mysqli_fetch_assoc($post);

    $status = $post['status'];
    $slug = $post['slug'];
    $title = $post['title'];
    $tags = $post['tags'];
    $category = $post['category'];
    $content = $post['content'];
    $photo = $post['photo'];
    ?>

    <style>
        #sel1 {
            margin-top: 10px;
        }

        #sel2 {
            margin-top: 10px;
            height: 300px;
        }

        #sel3 {
            margin-top: 10px;
        }

        #main {
            margin-top: 50px;
        }
    </style>

    <div class="container-sm" id="main">
        <h1>Utwórz nowy post</h1>
        <form action="editsend.php?id=<?php echo $id; ?>" method="POST">
            <div class="input-group">
                <input type="text" class="form-control" name="title" id="" value="<?php echo $title; ?>" placeholder="Tytuł">
                <input type="text" class="form-control" name="photo" id="" value="<?php echo $photo; ?>" placeholder="Link do zdjęcia">
            </div>
            <div class="input-group" id="sel1">
                <input type="text" class="form-control" name="slug" value="<?php echo $slug; ?>" id="" placeholder="Slogan">
                <input type="text" class="form-control" name="tags" value="<?php echo $tags; ?>" id="" placeholder="Tagi">
                <select class="form-select" name="category">
                    <?php
                    $categories = mysqli_query($conn, "SELECT * FROM categories");
                    while ($row = mysqli_fetch_assoc($categories)) {
                        $id = $row['id'];
                        $nazwa = $row['nazwa'];
                        if($category == $id){
                            echo "<option value='$id' selected>$nazwa</option>";
                        } else {
                            echo "<option value='$id'>$nazwa</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <textarea class="form-control" id="sel2" name="content"><?php echo $content; ?></textarea>
            <div class="input-group" id="sel3">
                <select class="form-select" id="inputGroupSelect04" name="status">
                    <option value="1">Opublikuj</option>
                    <option value="0">Zapisz szkic</option>
                </select>
                <button type="submit" class="btn btn-outline-primary col-3" type="button">Wyślij</button>
            </div>
        </form>
    </div>

</body>

</html>