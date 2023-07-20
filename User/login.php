<?php
    include "connect.php";
    $codeStudent = $_POST['codeStudent'];
    $passWord = $_POST['passWord'];

    $login = "SELECT * FROM user WHERE codeStudent = '".$codeStudent."' and passWord = '".$passWord."'";
    $queryLogin = $connection->query($login);
    if(mysqli_num_rows($queryLogin)>0){
        while($row = mysqli_fetch_assoc($queryLogin)){
            $list = array(
                "userName"=>$row['userName'],
                "codeStudent"=>$row['codeStudent'],
                "idFaculty"=>$row['idFaculty'],
                "idClass"=>$row['idClass'],
            );
        }
    $jsonList = json_encode($list,JSON_UNESCAPED_UNICODE);
    $json = array(
        'statusCode'=>200,
        'massage'=> "Thành công",
        'data'=> [$jsonList],
    );
    verifyJson($json,200);
    }else{
            $json = array(
                'statusCode'=> 412,
                'massage'=> "Đăng nhập sai thông tin",
                'data'=>[],
            );
            verifyJson($json,412);
    }
?>