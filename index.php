<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super strona</title>
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
    <div class="sortText"><h4><a href="index.php?most=1">Sortuj po najpopularniejszych</a></h4></div>
    <?php
        include 'db_config.php';
        mysqli_query($conn, "SET NAMES 'utf8'");
        $ilosc = 1;
        if (isset($_GET['q'])) {
            $szukane = $_GET['q'];
            $posts = mysqli_query($conn, "SELECT * FROM post WHERE title LIKE '%$szukane%' OR tags LIKE '%$szukane%' ORDER BY id DESC");
        } else if(isset($_GET['category'])){
            $szukane = $_GET['category'];
            $posts = mysqli_query($conn, "SELECT * FROM post WHERE category=$szukane ORDER BY id DESC");
        } else if(isset($_GET['most'])){
            $posts = mysqli_query($conn, "SELECT * FROM post ORDER BY liczbyCzytan DESC");
        } else{
            $posts = mysqli_query($conn, "SELECT * FROM post ORDER BY id DESC");
        }
        while ($row = mysqli_fetch_assoc($posts)) {
            $id = $row['id'];
            $status = $row['status'];
            if($status == 1){
                $title = $row['title'];
                //$slug = $row['slug'];
                $content = $row['content'];
                if (strlen($content) > 100) {
                    $content = substr($content, 0, 100);
                    $content = $content . "[..]";
                }
                $category = $row['category'];
                $categories = mysqli_query($conn, "SELECT nazwa FROM categories WHERE id='$category'");
                $categories = mysqli_fetch_assoc($categories);
                $category = $categories['nazwa'];
                $tags = $row['tags'];
                $creator = $row['creator'];
                $sql = "SELECT imie, nazwisko FROM users WHERE ID=$creator";
                $author = mysqli_query($conn, $sql);
                $author = mysqli_fetch_assoc($author);
                $authori = $author['imie'];
                $authorn = $author['nazwisko'];
                $data = $row['data'];
                $photo = $row['photo'];
                if($ilosc == 1){
                    echo "<div class='artBox'>";
                }
                if($ilosc == 2 || $ilosc == 3){
                    echo "<article class='artb'>";
                } else {
                    echo "<article class='art'>";
                }
                if($photo == ""){
                    echo "<div class='artPhoto'></div>";
                } else {
                    echo "<img class='artPhoto' src='$photo'></img>";
                }
                echo "

                    <div class='artTitle'>$title</div>
                    <div class='authorInfo'>$authori $authorn $data</div>
                    <div class='artText'>$content</div>
                    <div class='more'><a href='view.php?p=$id'>Czytaj dalej »</a></div>
                    </article>
                ";
                if($ilosc == 3){
                    echo "</div>";
                    $ilosc = 0;
                }
                $ilosc = $ilosc + 1;
            }
        }
    ?>
</body>

</html>