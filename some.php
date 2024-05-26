<?php
    /* 
        Section 1: Connect to MySql database:
    */

    //Setting variables:
    $host = "localhost";
    $db = "dextoolPanel";
    $username = "root";
    $password = "noPassword";

    //Connecting to MySQL:
    $conn = new_mysqli_connection($host, $db, $username, $password);

    //Check the connection:
    if($conn){
        echo "MySQL Connected. The connection is successfull. :)";
    }
    else{
        echo "MySQL Connection Is Failed. The connection is not successfull. :(";
    }

    /*
        Section 2: Getting the variables from the Socket:
    */
    $connectionSocket = axios("http://localhost:9990").get("data", function ($response) {
        //Getting the datas from the socket response:
        $size = mysqli_num_rows($response);
        for($i = 0; $i < $size; $i++){
            $element = $response[$i];
            //Extracting the data:
            $ip = $element["ip"];
            $port = $element["port"];
            $country = $element["country"];
            $city = $element["city"];
            $fax = $element["fax"];
            $location = $element["location"];
            $ownerName = $element["ownerName"];
            $ownerSurname = $element["ownerSurname"];
            $systemType = $element["systemType"];
            $socketPassword = $element["socketPassword"];
            $socketUsername = $element["socketUsername"];
            $data = $element["data"];

            HTPS.connection($ip, $port, $country).next("levelOne", function($response){
                $status = $response["status"];
                if($status == 200){
                    echo "There is no problem about the server. Please, wait for our tool to finish the process.";
                    
                }
                else{
                    echo "There is server error. Please, try again later.";
                }
            });
        }
    });

?>