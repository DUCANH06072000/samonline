<?php
      include "connect.php";
      $codeStudent = $_POST['codeStudent'];
      $passWord = $_POST['passWord'];

    $checkCodeStudent = "SELECT * FROM user WHERE codeStudent = '".$codeStudent."'";
    $query = $connection->query($checkCodeStudent);
    if(mysqli_num_rows($query)>0){
        $updatePassword = "UPDATE user SET passWord = '".$passWord."' WHERE codeStudent = '".$codeStudent."' ";
        $queryUpdatePassWord = $connection->query($updatePassword);
        $json = array(
            'statusCode' => 200,
            'message' => "Đổi mật khẩu thành công",
            'data' => [],
        );
        verifyJson($json, 200);
    }else{
        $json = array(
            'statusCode' => 412,
            'message' => "Mã sinh viên không tồn tại",
            'data' => [],
        );
        verifyJson($json, 412);
    }
?>