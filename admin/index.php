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
        Burada stok girişi yapıyorsunuz. Sisteme excell yüklemezden önce burayı doldurup aynı STOK kodu ile girmeniz lazim. Diyelimkı stok kodu
        HBR bu zaman burayada aynı stokkodunu excelede aynı stok kodunu yapmanız lazım. Bunu yapmazsanız sistem verilerinizi okumayacaktır.
    </p>

    <div style="width: 100%; margin-top: 20px;">
        <h2 style="text-align:center;">Adding stock to the system</h2>

        <form method="POST" action="index.php" style="width: 100%;">
            <center>
                <input name="name" placeholder="Write the name of the stock..." type="text" style="width: 90%; padding-top: 10px; padding-bottom: 10px; max-width: 1140px;" />
                <input name="code" placeholder="Write the code of the stock..." type="text" style="width: 90%; padding-top: 10px; padding-bottom: 10px; max-width: 1140px; margin-top: 10px;" />
                <input name="sector" placeholder="Write the sector of the stock..."type="text"style="width: 90%; padding-top: 10px; padding-bottom: 10px; max-width: 1140px; margin-top: 10px;" />
                <input name="aboutStock" placeholder="Write the about text about the stock" type="text" style="width: 90%; padding-top: 10px; padding-bottom: 10px; max-width: 1140px; margin-top: 10px;" />
                <button style="width: 90%; max-width: 1140px; background: green; font-weight: bold; padding-top: 10px; padding-bottom: 10px; margin-top: 15px; color: white; border: 1px solid green;">
                    Submit
                </button>
            </center>
        </form>
    </div>

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
                    <th>Code</th>
                    <th>Sector</th>
                    <th>About</th>
                </tr>
                <?php 
                    include("../Inc/database.php");

                    if(isset($_POST["name"])){
                        $name = $_POST["name"];
                        $code = $_POST["code"];
                        $sector = $_POST["sector"];
                        $aboutStock = $_POST["aboutStock"];

                        $query = $conn->query("INSERT INTO `stocks` (`name`,`code`,`sector`, `aboutStock`) VALUES('$name', '$code', '$sector',  '$aboutStock');");
                        if($query){
                            echo '
                                <script>
                                    alert("Successfully added.");
                                    //window.location.href="index.php";
                                </script>
                            ';
                        }
                    }

                    if(!isset($_SESSION["admin"]) || $_SESSION["admin"] != "yes"){
                        header("Location: login.php");
                    }

                    $query = $conn->query("SELECT * FROM `stocks`");
                    while($result = $query->fetch_assoc()){
                        $name = $result["name"];
                        $code = $result["code"];
                        $sector = $result["sector"];
                        $aboutStock = $result["aboutStock"];
                        $id = $result["id"];

                        echo "
                            <tr>
                                <td>".$id."</td>
                                <td>".$name."</td>
                                <td>".$code."</td>
                                <td>".$sector."</td>
                                <td>".$aboutStock."</td>
                            </tr>
                        ";
                    }
                ?>
            </table>
        </div>
    </center>
</body>
</html>
