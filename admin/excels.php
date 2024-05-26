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

    <input type="file" id="fileInput">
    <button onclick="handleFile()">Upload</button>
    <p style="margin-top: 15px; text-align:center;">
        Burada sizin exceli yükledikten sonra bir kaç dakika beklemeniz lazım. Sonuç ortaya çıktığı zaman biz size uyarı göndericez. Ekrandan ayrılmayın.
    </p>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.core.min.js"></script>
    <?php
        include("./connect.php");

        if(!isset($_SESSION["admin"]) || $_SESSION["admin"] != "yes"){
            header("Location: login.php");
        }

        if(isset($_POST["stock"])){
            $stock = $_POST["stock"];
            $tab = $_POST["tab"];
            $name = $_POST["name"];
            $datas = $_POST["datas"];

            $stock_json = json_decode($stock);
            $name_json = json_decode($name);
            $tab_json = json_decode($tab);
            $datas_json = json_decode($datas);

            if(isset($_POST["new"])){
                for($i = 0; $i < sizeof($name_json); $i++){
                    $element_stock = $stock_json[$i];
                    $element_tab = $tab_json[$i];
                    $element_name = $name_json[$i];
                    $element_datas = $datas_json[$i];
                    $element_to_prepend = json_decode($element_datas);
                    $query = $conn->query("SELECT * FROM `datas` WHERE `stock`='$element_stock' AND `tab`='$element_tab' AND `name`='$element_name'");
                    $result = $query->fetch_assoc();
                    $datas = $result["datas"];
                    $json  = json_decode($datas);
                    $json = array_merge($element_to_prepend, $json);
                    $json_string = json_encode($json);
                    $query = $conn->query("UPDATE `datas` SET `datas`='$json_string' WHERE `stock`='$element_stock' AND `tab`='$element_tab' AND `name`='$element_name'");
                    
                }
            }
            else{
                for($i = 0; $i < sizeof($name_json); $i++){
                    $element_stock = $stock_json[$i];
                    $element_tab = $tab_json[$i];
                    $element_name = $name_json[$i];
                    $element_datas = $datas_json[$i];
                    $query = $conn->query("INSERT INTO `datas` (`stock`, `tab`,`name`,`datas`) VALUES('$element_stock', '$element_tab', '$element_name', '$element_datas');");
                }
            }

            echo '
                <script>
                    alert("Successfully uploaded and updated.");
                </script>
            ';
            /*$query = $conn->query("INSERT INTO `datas` (`stock`, `tab`,`name`,`datas`) VALUES('$stock', '$tab', '$name', '$datas');");
            echo "yes";*/
        }
    ?>
    
    <form method="POST" action="excels.php">
        <input type="hidden" name="stock" />
        <input type="hidden" name="tab" />
        <input type="hidden" name="name" />
        <input type="hidden" name="datas" />
        <input type="checkbox" name="new" /> New ?
        <button style="display:none; " id='submit2'>
            Selma
        </button>
    </form>
    <script>
        function handleFile() {
            const fileInput = document.getElementById('fileInput');
            const file = fileInput.files[0];
            const reader = new FileReader();

            reader.onload = function (e) {
                const data = new Uint8Array(e.target.result);
                const workbook = XLSX.read(data, { type: 'array' });

                const sheetName = workbook.SheetNames[0]; // Assuming the first sheet
                const sheet = workbook.Sheets[sheetName];
                const range = XLSX.utils.decode_range(sheet['!ref']);
                
                const dataArray = [];

                for (let i = range.s.r; i <= range.e.r; i++) {
                    const row = [];
                    for (let j = range.s.c; j <= range.e.c; j++) {
                        const cellAddress = XLSX.utils.encode_cell({ r: i, c: j });
                        const cell = sheet[cellAddress];
                        row.push(cell ? cell.v : null);
                    }
                    dataArray.push(row);
                }
                console.log(dataArray);
                
                let tabs = [
                    "",
                    "Bilanço",
                    "Bilanço Dikey",    
                    "Bilanço Yatay",   
                    "Dönemsel Gelir",   
                    "Dönemsel Gelir Dikey",
                    "Dönemsel Gelir Yatay", 
                    "Yıllıklandırılmış Gelir",  
                    "Yıllıklandırılmış Gelir Dikey",
                    "Veriler"
                ];

                let stock_array = [];
                    let tab_array = [];
                    let name_array = [];
                    let datas_array = [];
                    for(let i = 1; i < dataArray.length; i++){
                        let data_element = dataArray[i];
                        let data_stock = data_element[0];
                        let data_tab = data_element[1];
                        let data_name =data_element[2];
                        let data_datas = [];

                        for(let j = 3; j < data_element.length; j++){
                            data_datas.push([dataArray[0][j], data_element[j]]);
                        }
                        stock_array.push(data_stock);
                        tab_array.push(data_tab);
                        name_array.push(data_name);
                        datas_array.push(JSON.stringify(data_datas));
                    }

                    if(document.getElementsByName("new")[0].checked){
                        document.getElementsByName("stock")[0].value =JSON.stringify(stock_array);
                        document.getElementsByName("name")[0].value = JSON.stringify(name_array);
                        document.getElementsByName("tab")[0].value = JSON.stringify(tab_array);
                        document.getElementsByName("datas")[0].value =JSON.stringify(datas_array);
                        document.getElementById("submit2").click();
                    }
                    else{
                        fetch("./remove_stock.php?stock="+dataArray[1][0]).then(function(task){
                            let stock_array = [];
                            let tab_array = [];
                            let name_array = [];
                            let datas_array = [];
                            for(let i = 1; i < dataArray.length; i++){
                                let data_element = dataArray[i];
                                let data_stock = data_element[0];
                                let data_tab = data_element[1];
                                let data_name =data_element[2];
                                let data_datas = [];

                                for(let j = 3; j < data_element.length; j++){
                                    data_datas.push([dataArray[0][j], data_element[j]]);
                                }
                                stock_array.push(data_stock);
                                tab_array.push(data_tab);
                                name_array.push(data_name);
                                datas_array.push(JSON.stringify(data_datas));
                            }

                            document.getElementsByName("stock")[0].value =JSON.stringify(stock_array);
                            document.getElementsByName("name")[0].value = JSON.stringify(name_array);
                            document.getElementsByName("tab")[0].value = JSON.stringify(tab_array);
                            document.getElementsByName("datas")[0].value =JSON.stringify(datas_array);
                            document.getElementById("submit2").click();
                        });
                    }
            };

            reader.readAsArrayBuffer(file);
        }

    </script>
</body>
</html>
