<?php
    // db 연결
    include './inc/dbconfig.php';

    $db = $pdo;

    include './inc/member.php';

    // 아이디 중복테스트 
    $email = 'email@email.com';

    $mem = new Member($db);

    if($mem->email_exists($email)){
        echo "중복";
    }else{
        echo "사용가능";
    }
?>