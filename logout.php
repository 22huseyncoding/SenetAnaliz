<?php
include("./Inc/database.php");
include("./Inc/authentication.php");
    $_SESSION["email"] = "";
    $_SESSION["password"] = "";
    echo "
        <script>
            alert('Çıkış Yapıldı');
            window.location.href='index.php';
        </script>
    ";
?>