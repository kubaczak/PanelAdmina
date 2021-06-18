<head>
    <meta charset="UTF-8">

    <head>

        <?php

        function random_str(
            int $length = 64,
            string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
        ): string {
            if ($length < 1) {
                throw new \RangeException("Length must be a positive integer");
            }
            $pieces = [];
            $max = mb_strlen($keyspace, '8bit') - 1;
            for ($i = 0; $i < $length; ++$i) {
                $pieces[] = $keyspace[random_int(0, $max)];
            }
            return implode('', $pieces);
        }

        function back()
        {
            include 'config.php';
            echo "
            <script>
            function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
            }
            
            async function Leave(){
                await sleep(3000);
                window.location.replace('" . $link . "/index.php')
            }

            Leave();
            </script>
        ";
        }

        if (
            isset($_POST["login"]) &&
            isset($_POST["password"])
        ) {
            include 'db_config.php';

            // Sprawdzamy połączenie z bazą danych
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
                back();
            }
            $haslo = $_POST["password"];
            //$haslo = hash('sha256', $haslo);
            $login = $_POST["login"];
            $logindb = mysqli_real_escape_string($conn, $login);
            $sql = "SELECT haslo FROM users WHERE login='$logindb';";
            $result = mysqli_query($conn, $sql);
            $result = mysqli_fetch_assoc($result);
            $hash = $result["haslo"];

            if (password_verify($haslo, $hash)) {
                $sql = "SELECT ID FROM users WHERE login='$logindb';";
                $result = mysqli_query($conn, $sql);
                $result = mysqli_fetch_assoc($result);
                $user_id = $result["ID"];
                $user_ip = $_SERVER['REMOTE_ADDR'];
                $czas = date("Y-m-d H:i:s");
                $token = random_str(64);
                $sql = "INSERT INTO loginlog (user_ID, data, token, adres_IP)
                VALUES ($user_id, '$czas', '$token', '$user_ip')";
                if (mysqli_query($conn, $sql)) {
                    echo "Zalogowano!";
                    setcookie("token", $token, time() + (86400 * 7), "/");
                    include 'config.php';
                    header("Location: $link/admin.php");
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            } else {
                echo "Login lub hasło nie zgadzają się";
            }
        } else {
            echo "You dont have access to this site. You will be redirected in 3 seconds...";
            back();
        }

        ?>