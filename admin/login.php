<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <div style="display:flex; justify-content:center; align-items:center;">
        <button style="padding-top: 10px; padding-bottom: 10px; background: blue; color: white; font-weight: bold; width: 120px; border: 1px solid blue;">Stocks</button>
        <button style="padding-top: 10px; padding-bottom: 10px; background: blue; color: white; font-weight: bold; width: 120px; border: 1px solid blue; margin-left: 10px;">Excels</button>
        <button style="padding-top: 10px; padding-bottom: 10px; background: blue; color: white; font-weight: bold; width: 120px; border: 1px solid blue; margin-left: 10px;">Users</button>
    </div>

    <div style="width: 100%; margin-top: 20px;">
        <h2 style="text-align:center;">Login</h2>

        <?php 
            include("../Inc/database.php");

            if(isset($_SESSION["admin"]) && $_SESSION["admin"] == "yes"){
                header("Location: index.php");
            }

            if(isset($_POST["email"])){
                $email = $_POST["email"];
                $password = $_POST["password"];
                if($email == "huseyn.aliyefh@gmail.com" && $password == "masterprogramming"){
                    $_SESSION["admin"]="yes";
                    echo "
                        <script>
                            alert('Successfull');
                            window.location.href='index.php';
                        </script>
                    ";
                }
                else{
                    echo "
                        <script>
                            alert('Failure');
                            window.location.href='login.php';
                        </script>
                    ";
                }
            }
        ?>

        <form method="POST" action="login.php" style="width: 100%;">
            <center>
                <input name="email" placeholder="Write the email..." type="email" style="width: 90%; padding-top: 10px; padding-bottom: 10px; max-width: 1140px;" />
                <input name="password" placeholder="Write the password..." type="password" style="width: 90%; padding-top: 10px; padding-bottom: 10px; max-width: 1140px; margin-top: 10px;" />
                <button style="width: 90%; max-width: 1140px; background: green; font-weight: bold; padding-top: 10px; padding-bottom: 10px; margin-top: 15px; color: white; border: 1px solid green;">
                    Submit
                </button>
            </center>
        </form>
    </div>
</body>
</html>
