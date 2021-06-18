<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Zaloguj do panelu administratora</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
      crossorigin="anonymous"
    />
    <script
      defer
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
      crossorigin="anonymous"
    ></script>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
    />
  </head>
  <body>

    <style>
        .boxLgn{
            width: 400px;
            margin: 0 auto;
            margin-top: 50px;
        }
    </style>

    <?php 
        include "db_config.php";
        mysqli_query($conn, "SET NAMES 'utf8'");
        if(isset($_COOKIE["token"])){
            $token = $_COOKIE["token"];
            $token = mysqli_real_escape_string($conn, $token);
            $sql = "SELECT * FROM loginlog WHERE token='$token'";
            $result = mysqli_query($conn, $sql);
            $result = mysqli_fetch_assoc($result);
            if ($result != ""){
                $then = new DateTime($result["data"]);
                $now = new DateTime(date("Y-m-d H:i:s"));
                $interval= $now->diff($then);
                if ($interval->y == 0 && $interval->d < 8 && $interval->m == 0){
                    include "config.php";
                    header("Location: $link/admin.php");
                }
            }
        }
    ?>

    <div class="boxLgn">
      <form action="login.php" method="POST">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label"
            >Nazwa użytkownika</label
          >
          <input
            type="text"
            class="form-control"
            id="exampleInputEmail1"
            name="login"
          />
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Hasło</label>
          <input
            type="password"
            class="form-control"
            id="exampleInputPassword1"
            name="password"
          />
        </div>
        <button type="submit" class="btn btn-primary">Zaloguj</button>
      </form>
    </div>
  </body>
</html>
