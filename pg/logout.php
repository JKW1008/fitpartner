<?php
    include '../inc/dbconfig.php';

    $db = $pdo;

    include '../inc/member.php';

    $mem = new Member($db);

    $mem->logout();

?>