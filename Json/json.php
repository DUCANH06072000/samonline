<?php
    function verifyJson($json,$statuscode){
     header('Content-Type: application/json; charset=utf-8');
    http_response_code($statuscode);
    echo json_encode($json);
    }

?>