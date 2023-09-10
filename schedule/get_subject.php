<?php
    include "connect.php";
    $codeStudent = $_POST['codeStudent'];
    $listSubject = array();
    $get_subject = "SELECT * FROM schedule WHERE codeStudent = '".$codeStudent."'";
    $querySubject = $connection->query($get_subject);
    if(mysqli_num_rows($querySubject)>0){
        while($rowSubject = mysqli_fetch_assoc($querySubject)){
            $get_nameSubject = "SELECT * FROM subject WHERE idSubject = '".$rowSubject['idSubject']."'";
            $query_nameSubject = $connection->query($get_nameSubject);
            while($rowNameSubject = mysqli_fetch_assoc($query_nameSubject)){
                $nameSubject = $rowNameSubject['nameSubject'];
                $idTeacher = $rowNameSubject['idTeacher'];
                $number = $rowNameSubject['number'];
            }
            
            $get_nameTeacher = "SELECT * FROM teacher WHERE idTeacher = '".$idTeacher."'";
            $query_nameTeacher = $connection->query($get_nameTeacher);
            while($rowTeacher = mysqli_fetch_assoc($query_nameTeacher)){
                $nameTeacher = $rowTeacher['nameTeacher'];
            }
            
            $list = array(
                'nameSubject'=>$nameSubject,
                'dateTime'=>$rowSubject['dateTime'],
                'nameTeacher' =>$nameTeacher,
                'number'=>$number,
            );
            $listSubject[] = $list;
        }
      //  $jsonList = json_encode($listSubject,JSON_UNESCAPED_UNICODE);
        $json = array('statusCode'=>200,'message'=>"Thành công",'codeStudent'=>$codeStudent,'data'=>$listSubject);
        verifyJson($json,200);
    }else{
        $json = array('statusCode'=>412,'message'=>"Sinh viên không tồn tại",'codeStudent'=>"không tồn tại",'data'=>[]);
        verifyJson($json,200);  
    }
   

    
?>