<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Panel Administratora</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
</head>

<body>

  <?php
  include 'chklgn.php';
  if (!isset($logedin)) {
    exit();
  }
  ?>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="admin.php">Panel Administratora</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Wyloguj</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php">Strona Główna</a>
          </li>
        </ul>
        <form class="d-flex" action="admin.php" method="GET">
          <?php
          $szukane = "";
          if (isset($_GET['q'])) {
            $szukane = $_GET['q'];
          }
          ?>
          <input class="form-control me-2" type="search" name="q" value="<?php echo $szukane; ?>" placeholder="Wyszukaj" />
          <button class="btn btn-outline-success" type="submit">
            Szukaj
          </button>
        </form>
      </div>
    </div>
  </nav>

  <div class="container">
    <form action="create.php" style="margin-top: 20px;">
      <button type="submit" class="btn btn-dark">Utwórz nowy post</button>
    </form>
    <?php
    if (isset($_GET['q'])) {
      $szukane = $_GET['q'];
      $liczba = mysqli_query($conn, "SELECT COUNT(id) AS liczba FROM post WHERE title LIKE '%$szukane%' OR tags LIKE '%$szukane%' ORDER BY id DESC");
    } else {
      $liczba = mysqli_query($conn, "SELECT COUNT(id) AS liczba FROM post ORDER BY id DESC");
    }
    $liczba = mysqli_fetch_assoc($liczba);
    $liczba = $liczba['liczba'];

    $mostCommon = mysqli_query($conn, "SELECT creator, COUNT(creator) AS num FROM post GROUP BY creator ORDER BY num DESC LIMIT 1");
    $mostCommon = mysqli_fetch_assoc($mostCommon);
    $mostCreator = $mostCommon['creator'];
    $sql = "SELECT login FROM users WHERE ID=$mostCreator";
    $mostCreator = mysqli_query($conn, $sql);
    $mostCreator = mysqli_fetch_assoc($mostCreator);
    $mostCreator = $mostCreator['login'];
    $mostNum = $mostCommon['num'];
    ?>
    <h4 style="margin-top: 10px;">Liczba postów: <?php echo $liczba; ?></h4> 
    <h4 style="margin-top: 10px;">Najbardziej aktywny autor: <?php echo $mostCreator . " (" . $mostNum . ")"; ?></h4>
    <table class="table table-dark table-striped mt-4 table-hover">
      <thead>
        <tr>
          <th scope="col" class="status">Status</th>
          <th scope="col" class="title">Tytuł</th>
          <th scope="col" class="slug">Slogan</th>
          <th scope="col" class="content">Zawartosć</th>
          <th scope="col" class="category">Kategoria</th>
          <th scope="col" class="tags">Tagi</th>
          <th scope="col" class="actions">Akcje</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (isset($_GET['q'])) {
          $szukane = $_GET['q'];
          $posts = mysqli_query($conn, "SELECT * FROM post WHERE title LIKE '%$szukane%' OR tags LIKE '%$szukane%' ORDER BY id DESC");
        } else {
          $posts = mysqli_query($conn, "SELECT * FROM post ORDER BY id DESC");
        }
        while ($row = mysqli_fetch_assoc($posts)) {
          $id = $row['id'];
          $status = $row['status'];
          if ($status == 0) {
            $status = "SZKIC";
          } else if ($status == 1) {
            $status = "OPUBLIKOWANY";
          }
          $title = $row['title'];
          $slug = $row['slug'];
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
          //$creator = $row['creator'];
          //$data = $row['data'];

          echo "
            <tr>
            <td class='status'>$status</td>
            <td class='title'>$title</td>
            <td class='slug'>$slug</td>
            <td class='content'>$content</td>
            <td class='category'>$category</td>
            <td class='tags'>$tags</td>
            <td class='actions' style='white-space: nowrap; width: 1%'>
            <a class='btn btn-success' href='edit.php?id=$id' role='button'
                ><i class='bi bi-pencil'></i
            ></a>
            <a class='btn btn-primary' href='view.php?p=$id' role='button'
                ><i class='bi bi-search'></i
            ></a>
            <a class='btn btn-danger' href='delete.php?id=$id' role='button'
                ><i class='bi bi-x-lg'></i
            ></a>
            </td>
            </tr>
        ";
        }
        ?>

      </tbody>
    </table>
  </div>
</body>

</html>