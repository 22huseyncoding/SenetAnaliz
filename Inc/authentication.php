<?php
    if(!isset($_SESSION["email"])){
        session_unset();
        print_r($_SESSION);
        echo "
            <script>
                window.location.href='sign-in.php';
            </script>
        ";
    }
    else{
        $email = $_SESSION["email"];
        $password = $_SESSION["password"];

        $query = $conn->query("SELECT * FROM `users` WHERE `email` ='$email' AND `password`='$password'");
        $query_size = mysqli_num_rows($query);

        if($query_size == 0){
            session_unset();
           echo "
                <script>
                    window.location.href='sign-in.php';
                </script>
            ";
        }
    }
?>