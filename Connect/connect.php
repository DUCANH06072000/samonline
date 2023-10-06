<?php
    function connectToMysql(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "samonline";

        $conn = mysqli_connect($servername,$username,$password,$dbname);
        if(!$conn){
            die("Kết nối Mysqli thất bại". mysqli_connect_error());
        }

        return $conn;
    }

    $connection = connectToMysql();
?>