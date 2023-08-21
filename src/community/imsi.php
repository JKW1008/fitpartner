<?php
    // db 연결
    include './inc/dbconfig.php';

    $db = $pdo;

    include './inc/member.php';

    // 아이디 중복테스트 
    $id = 'kingchobo';

    $mem = new Member($db);

    if($mem->id_exist($id)){
        echo "아이디 중복";
    }else{
        echo "사용가능";
    }
?>