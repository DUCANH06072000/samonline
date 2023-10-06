<?php
      include "connect.php";
    $codeStudent = $_POST['codeStudent'];
    $address = $_POST['address'];
    $birthday = $_POST['birthday'];

    $checkUser = "SELECT * FROM user WHERE codeStudent = '".$codeStudent."'";
    $queryCheckUser = $connection->query($checkUser);
    if(mysqli_num_rows($queryCheckUser)>0){
        $updateUser = "UPDATE user SET address = '".$address."', birthday  = '".$birthday."' WHERE codeStudent = '".$codeStudent."'";
        $queryUpdateUser = $connection->query($updateUser);
            while($row = mysqli_fetch_assoc($queryCheckUser)){
                $get_class = "SELECT * FROM class WHERE idClass = '".$row['idClass']."'";
                $queryClass = $connection->query($get_class);
                  while($rowClass = mysqli_fetch_assoc($queryClass)){
                     $nameClass = $rowClass['nameClass'];
                     $get_Faculty = "SELECT * FROM Faculty WHERE idFaculty = '".$rowClass['idFaculty']."'";
                     $queryFaculty = $connection->query($get_Faculty);
                     while($rowFaculty = mysqli_fetch_assoc($queryFaculty)){
                       $nameFaculty = $rowFaculty['nameFaculty'];
                    } 
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
                    "passWord"=>$row['passWord'],
                    "address"=>$address,
                    "birthday"=>$birthday
                         );
              
            }
            $jsonList = json_encode($list, JSON_UNESCAPED_UNICODE);
            $json = array(
                'statusCode' => 200,
                'message' => "Thành công",
                'data' => [json_decode($jsonList)],
            );

            verifyJson($json, 200);
    }else{
        $json = array(
            'statusCode' => 400,
            'message' => "Mã sinh viên không chính xác",
            'data' => [],
        );
        verifyJson($json, 400);
    }
?>