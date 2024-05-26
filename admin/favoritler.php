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
    <?php
        include("../Inc/database.php");
        
        $query = $conn->query("SELECT * FROM `favourites`");
        $result = $query->fetch_assoc();
        $tab1 = $result["tab"];
        $data1 = $result["data"];
        $result = $query->fetch_assoc();
        $tab2 = $result["tab"];
        $data2 = $result["data"];
        $result = $query->fetch_assoc();
        $tab3 = $result["tab"];
        $data3 = $result["data"];
        $result = $query->fetch_assoc();
        $tab4 = $result["tab"];
        $data4 = $result["data"];
        $result = $query->fetch_assoc();
        $tab5 = $result["tab"];
        $data5 = $result["data"];

        if(isset($_POST["tab1"])){
            $tab1 = $_POST["tab1"];
            $data1 = $_POST["data1"];
            $tab2 = $_POST["tab2"];
            $data2 = $_POST["data2"];
            $tab3 = $_POST["tab3"];
            $data3 = $_POST["data3"];
            $tab4 = $_POST["tab4"];
            $data4 = $_POST["data4"];
            $tab5 = $_POST["tab5"];
            $data5 = $_POST["data5"];
            /*
                echo "
                <script>
                    alert('Successfull');
                    window.location.href='favoritler.php';
                </script>
            ";Bilanço
            */

            $query = $conn->query("UPDATE `favourites` SET `tab`='$tab1',`data`='$data1' WHERE `id`=1;");
            $query = $conn->query("UPDATE `favourites` SET `tab`='$tab2', `data`='$data2' WHERE `id`=2;");
            $query = $conn->query("UPDATE `favourites` SET `tab`='$tab3', `data`='$data3' WHERE `id`=3;");
            $query = $conn->query("UPDATE `favourites` SET `tab`='$tab4', `data`='$data4' WHERE `id`=4;");
            $query = $conn->query("UPDATE `favourites` SET `tab`='$tab5', `data`='$data5' WHERE `id`=5;");
            echo "
                <script>
                    alert('Successfull');
                    window.location.href='favoritler.php';
                </script>
            ";

            
        }
    ?>
    <div style="width: 100%; margin-top: 20px;">
        <h2 style="text-align:center;">Favori Grafikleri Ayarlar</h2>
        <p style="text-align:center;">
            Ana Sayfada olan favori grafiklerin ayarlanmasi.Ayarlarken dönem ayarı yapamayacaksınız, çünkü teknik olarak bunu yapmak sistemi çok yoruyor ve gelecekte
            patlamasına getire bilir.
        </p>
        <form method="POST" action="favoritler.php" style="width: 100%;">
            <center>
                <input value="<?php echo $tab1 ?>" name="tab1" placeholder="1-ci grafik veri tab kismi (Yani mesela, Bilanco) ..." type="text" style="width: 90%; padding-top: 10px; padding-bottom: 10px; max-width: 1140px;" />
                <input value="<?php echo $data1 ?>" name="data1" placeholder="1-ci grafik veri ..." type="text" style="margin-top: 10px; width: 90%; padding-top: 10px; padding-bottom: 10px; max-width: 1140px;" />
                <input value="<?php echo $tab2 ?>" name="tab2" placeholder="1-ci grafik veri tab kismi (Yani mesela, Bilanco) ..." type="text" style="width: 90%; padding-top: 10px; padding-bottom: 10px; max-width: 1140px;" />
                <input value="<?php echo $data2 ?>" name="data2" placeholder="1-ci grafik veri ..." type="text" style="margin-top: 10px; width: 90%; padding-top: 10px; padding-bottom: 10px; max-width: 1140px;" />
                <input value="<?php echo $tab3 ?>" name="tab3" placeholder="1-ci grafik veri tab kismi (Yani mesela, Bilanco) ..." type="text" style="width: 90%; padding-top: 10px; padding-bottom: 10px; max-width: 1140px;" />
                <input value="<?php echo $data3 ?>" name="data3" placeholder="1-ci grafik veri ..." type="text" style="margin-top: 10px; width: 90%; padding-top: 10px; padding-bottom: 10px; max-width: 1140px;" />
                <input value="<?php echo $tab4 ?>" name="tab4" placeholder="1-ci grafik veri tab kismi (Yani mesela, Bilanco) ..." type="text" style="width: 90%; padding-top: 10px; padding-bottom: 10px; max-width: 1140px;" />
                <input value="<?php echo $data4 ?>" name="data4" placeholder="1-ci grafik veri ..." type="text" style="margin-top: 10px; width: 90%; padding-top: 10px; padding-bottom: 10px; max-width: 1140px;" />
                <input value="<?php echo $tab5 ?>" name="tab5" placeholder="1-ci grafik veri tab kismi (Yani mesela, Bilanco) ..." type="text" style="width: 90%; padding-top: 10px; padding-bottom: 10px; max-width: 1140px;" />
                <input value="<?php echo $data5 ?>" name="data5" placeholder="1-ci grafik veri ..." type="text" style="margin-top: 10px; width: 90%; padding-top: 10px; padding-bottom: 10px; max-width: 1140px;" />
                
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
        </div>
    </center>
</body>
</html>
