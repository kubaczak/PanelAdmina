<?php
    function back(){
        include 'config.php';
        echo "
            <script>
            function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
            }
            
            async function Leave(){
                await sleep(3000);
                window.location.replace('" . $link . "/adminlogin.php')
            }

            Leave();
            </script>
        ";
    }

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
            if ($interval->y == 0 && $interval->d < 7 && $interval->m == 0){
                $id = $result["user_ID"];
                $sql = "SELECT * FROM users WHERE ID='$id'";
                $result = mysqli_query($conn, $sql);
                $result = mysqli_fetch_assoc($result);
                $logedin = true;
            } else{
                echo("Sesja wygasła");
                back();
            } 
        } else{
            echo("Sesja wygasła");
            back();
        }
    } else {
        echo("Brak tokenu");
        back();
    }
?>