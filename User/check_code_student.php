<?php
    include "connect.php";
    $codeStudent = $_POST['codeStudent'];
    $sqlCheckCodeStudent = "SELECT * FROM user WHERE codeStudent = '".$codeStudent."'";
    $queryCheckCodeStudent = $connection->query($sqlCheckCodeStudent);
    if(mysqli_num_rows($queryCheckCodeStudent)>0){
        $json = array(
            'statusCode' => 200,
            'message' => "Thành công",
            'data' => [],
        );
        verifyJson($json, 200);  
    }else{
        $json = array(
            'statusCode' => 412,
            'message' => "Thất bại",
            'data' => [],
        );
        verifyJson($json, 412);  
    }

?>