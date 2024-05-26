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
        Burada analiz ilk sayfada olan filtreleri ayarlaya bilirsiniz. Bunları ayarlamak için Tab ismi ile veri ismini yanyana yazmanız lazım.
        Yani mesela Bilançodan bir veri göstermek istiyorsanız şu şekilde yazmalısınız:Bilanço-DÖNEN VARLIKLAR. Bundan başka ne kadar filtre eklemek isterseniz virğül koyup o kadar ekleye bilirsiniz. Misal, bu örnekte 2 tane filtre kullanıyoruz:
        Bilanço-DÖNEN VARLIKLAR,Bilanço-Nakit ve Nakit Benzerleri <br>
        Burada gördüğünüz gibi iki tane virğül ile ayrılmış filtre var ve bunların ikiside Bilanço tabinden. Bunları dikkatli yapmanıoz lazım aksi takdırde sistemde sikinti olacaktir.   
    </p>

    

    <div style="width: 100%; margin-top: 20px;">
        <h2 style="text-align:center;">Adding Filters</h2>

        <?php
            include("../Inc/database.php");

            if(isset($_POST["type"])){
                $type = $_POST["type"];
                $oldWord = $_POST["type"];
                $query = $conn->query("UPDATE `filters` SET `type`='$oldWord' WHERE `id`='1'");
                $types = explode(",", $type);
                $words = "";
                $query = $conn->query("UPDATE `stocks` SET `types`='' WHERE `id` > 0");
                for($i = 0; $i < sizeof($types); $i++){
                    $type = $types[$i];
                    $tab = substr($type, 0, strpos($type, "-"));
                    $index = strpos($type, "-");
                    $name = substr($type,$index + 1, strlen($type));
                    $query = $conn->query("SELECT * FROM `stocks`");
                    while($result = $query->fetch_assoc()){
                        $code = $result["code"];
                        $oldTypes = $result["types"];
                        $query2 = $conn->query("SELECT * FROM `datas` WHERE `tab`='$tab' AND `name`='$name' AND `stock`='$code'");
                        $result2 = $query2->fetch_assoc();
                        $data = $result2["datas"];
                        $data_json = json_decode($data);
                        $one = $data_json[0][1];
                        $oldTypes =$oldTypes.",".$one;
                        $query3 = $conn->query("UPDATE `stocks` SET `types`='$oldTypes' WHERE `code`='$code'");
                    }
                }
            }

            $query = $conn->query("SELECT * FROM `filters` WHERE `id`='1'");
            $result = $query->fetch_assoc();
            $type_one = $result["type"];
        ?>
        <form method="POST" action="filters.php" style="width: 100%;">
            <center>
                <input name="type" value="<?php echo $type_one ?>" placeholder="Write the data you want to add a filter.. (For example: Bilanço-DÖNEN VARLIKLAR)" type="text" style="width: 90%; padding-top: 10px; padding-bottom: 10px; max-width: 1140px;" />
                <button style="width: 90%; max-width: 1140px; background: green; font-weight: bold; padding-top: 10px; padding-bottom: 10px; margin-top: 15px; color: white; border: 1px solid green;">
                    Submit
                </button>
            </center>
        </form>
    </div>
</body>
</html>
