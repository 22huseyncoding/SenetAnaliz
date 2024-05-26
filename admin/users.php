<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
<div style="display:flex; justify-content:center; align-items:center;">
        <button onclick="window.location.href='index.php';" style="padding-top: 10px; padding-bottom: 10px; background: blue; color: white; font-weight: bold; width: 120px; border: 1px solid blue;">Stocks</button>
        <button onclick="window.location.href='excels.php';" style="padding-top: 10px; padding-bottom: 10px; background: blue; color: white; font-weight: bold; width: 120px; border: 1px solid blue; margin-left: 10px;">Excels</button>
        <button onclick="window.location.href='users.php';" style="padding-top: 10px; padding-bottom: 10px; background: blue; color: white; font-weight: bold; width: 120px; border: 1px solid blue; margin-left: 10px;">Users</button>
        <button onclick="window.location.href='filters.php';" style="padding-top: 10px; padding-bottom: 10px; background: blue; color: white; font-weight: bold; width: 120px; border: 1px solid blue; margin-left: 10px;">Filters</button>
        <button onclick="window.location.href='favoritler.php';" style="padding-top: 10px; padding-bottom: 10px; background: blue; color: white; font-weight: bold; width: 120px; border: 1px solid blue; margin-left: 10px;">Favoritler</button>
    </div>

    <p style="margin-top: 15px; text-align:center;">
        Burada tüm kullanıcıları göre bilirsiniz. Onların isimler ve buna benzer verileri burada göre bilirsiniz.    
    </p>

    <center>
        <div style="width: 90%; max-width: 1140px; margin-top: 10px;">  
        <style>
            td{
                border: 1px solid black;
                text-align: center;
            }
            th{
                border: 1px solid black;
                text-align: center;
            }
        </style>
            <table style="border-collapse: none;">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Username</th>
                    <th>Alternate Email</th>
                    <th>Facebook</th>
                    <th>Twitter</th>
                    <th>Google</th>
                    <th>Instagram</th>
                    <th>Youtube</th>
                </tr>
                <?php 
                    include("../Inc/database.php");

                    if(!isset($_SESSION["admin"]) || $_SESSION["admin"] != "yes"){
                        header("Location: login.php");
                    }

                    $query = $conn->query("SELECT * FROM `users`");
                    while($result = $query->fetch_assoc()){
                        $id = $result["id"];
                        $name = $result["name"];
                        $email = $result["email"];
                        $password = $result["password"];
                        $username = $result["username"];
                        $alternateEmail = $result["alternateEmail"];
                        $facebook = $result["facebook"];
                        $twitter = $result["twitter"];
                        $google = $result["google"];
                        $instagram = $result["instagram"];
                        $youtube = $result["youtube"];

                        echo "
                            <tr>
                                <td>$id</td>
                                <td>$name</td>
                                <td>$email</td>
                                <td>$password</td>
                                <td>$username</td>
                                <td>$alternateEmail</td>
                                <td>$facebook</td>
                                <td>$twitter</td>
                                <td>$google</td>
                                <td>$instagram</td>
                                <td>$youtube</td>
                            </tr>
                        ";
                    }
                ?>
            </table>
        </div>
    </center>
   
</body>
</html>
