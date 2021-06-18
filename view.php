<?php 
    if(isset($_GET['p'])){
        include 'db_config.php';
        mysqli_query($conn, "SET NAMES 'utf8'");
        $p = $_GET['p'];
        $posts = mysqli_query($conn, "SELECT * FROM post WHERE ID=$p");
        $result = mysqli_fetch_assoc($posts);
        $status = $result['status'];
        if($status == 1){
            $slug = $result['slug'];
            $title = $result['title'];
            $tags = $result['tags'];
            $category = $result['category'];
            $content = $result['content'];
            $data = $result['data'];
            $creator = $result['creator'];
            $sql = "SELECT imie, nazwisko FROM users WHERE ID=$creator";
            $author = mysqli_query($conn, $sql);
            $author = mysqli_fetch_assoc($author);
            $authori = $author['imie'];
            $authorn = $author['nazwisko'];
        } else {
            echo "<a href='index.php'>Powrót</a>";
            exit();
        }
    } else {
        echo "<a href='index.php'>Powrót</a>";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="naglowek">
        <div class="menubox1">
            <div style="float: left; margin-right: 40px;">
                <div class="title"><a href="index.php">Super Strona</a></div>
                <div class="subtitle">internetowa</div>
            </div>
            <div class="link"><a href="index.php?category=1">Zdjęcia</a></div>
            <div class="link"><a href="index.php?category=2">Natura</a></div>
            <div class="link"><a href="index.php?category=3">Programowanie</a></div>
            <div class="link"><a href="index.php?category=4">Vlog</a></div>
            <div class="link"><a href="adminlogin.php">Zaloguj</a></div>
        </div>
        <div class="menubox2">
            <form class="searchForm" action="index.php" method="GET">
                <?php
                $szukane = "";
                if (isset($_GET['q'])) {
                    $szukane = $_GET['q'];
                }
                ?>
                <input class="searchInput" type="search" name="q" value="<?php echo $szukane; ?>" placeholder="Wyszukaj" />
                <button class="searchBtn" type="submit">
                    Szukaj
                </button>
            </form>
        </div>
    </header>

    <?php
        $views = mysqli_query($conn, "SELECT liczbyCzytan FROM post WHERE id=$p");
        $views = mysqli_fetch_assoc($views);
        $views = $views['liczbyCzytan'];
        $views = $views + 1;
        mysqli_query($conn, "UPDATE post SET liczbyCzytan='$views' WHERE id=$p;");
    ?>

    <article class="artykul">
        <h1><?php echo $title; ?></h1>
        <p class="subtitleInfo"><?php echo "$authori $authorn $data | $views Wyświetleń"; ?></p>
        <textarea id="artykul" class="viewArticle"><?php echo $content; ?></textarea>
    </article>

    <script type="text/javascript" language="javascript">
        function artykul(){
            document.getElementById("artykul").style.height = document.getElementById("artykul").scrollHeight + "px"
        }
        artykul()
    </script>

</body>
</html>