<?php
    include "connect.php";

    // Check if the 'codeStudent' and 'passWord' keys are set in the $_POST array
    if (isset($_POST['codeStudent']) && isset($_POST['passWord'])) {
        $codeStudent = $_POST['codeStudent'];
        $passWord = $_POST['passWord'];

        $login = "SELECT * FROM user WHERE codeStudent = '".$codeStudent."' AND passWord = '".$passWord."'";
        $queryLogin = $connection->query($login);
        
        if(mysqli_num_rows($queryLogin) > 0){
            while($row = mysqli_fetch_assoc($queryLogin)){

                $get_class = "SELECT * FROM class WHERE idClass = '".$row['idClass']."'";
                $queryClass = $connection->query($get_class);
                  while($rowClass = mysqli_fetch_assoc($queryClass)){
                     $nameClass = $rowClass['nameClass'];
                  } 
                  $get_Faculty = "SELECT * FROM Faculty WHERE idFaculty = '".$row['idFaculty']."'";
                  $queryFaculty = $connection->query($get_Faculty);
                  while($rowFaculty = mysqli_fetch_assoc($queryFaculty)){
                    $nameFaculty = $rowFaculty['nameFaculty'];
                 } 

                    while($rowClass = mysqli_fetch_assoc($queryClass)){
                       $nameClass = $rowClass['nameClass'];
                    } 
                  $list = array(
                    "userName" => $row['userName'],
                    "codeStudent" => $row['codeStudent'],
                    "nameFaculty" => $nameFaculty,
                    "nameClass" => $nameClass,
                    "image"=>$row['image'],
                    "passWord"=>$row['passWord']
                         );
              
            }
            $jsonList = json_encode($list, JSON_UNESCAPED_UNICODE);
            $json = array(
                'statusCode' => 200,
                'message' => "Thành công",
                'data' => [json_decode($jsonList)],
            );
            verifyJson($json, 200);
        } else {
            $json = array(
                'statusCode' => 412,
                'message' => "Đăng nhập sai thông tin",
                'data' => [],
            );
            verifyJson($json, 412);
        }
    } else {
        // If 'codeStudent' or 'passWord' is missing in the request, return an error response
        $json = array(
            'statusCode' => 400,
            'message' => "1111",
            'data' => [],
        );
        verifyJson($json, 400);
    }

?>