<?php
    include '../inc_common.php';

    include "../../inc/dbconfig.php";
    
    $db = $pdo;

    include '../../inc/reservation.php';

    $reser = new Reservation($db);

    $idx     = (isset($_POST['idx'    ]) && $_POST['idx'    ] != '' && is_numeric($_POST['idx'])) ? $_POST['idx'    ] : '';
    $mode    = (isset($_POST['mode'   ]) && $_POST['mode'   ] != '') ? $_POST['mode'   ] : '';


    if($idx == ''){
        $arr = [ "result" => "empty_idx" ];
        die(json_encode($arr));
    }

    if($mode == ''){
        $arr = [ "result" => "empty_mode" ];
        die(json_encode($arr));
    }

    $reser->check($idx);

    $arr = [ "result" => "success" ];
    die(json_encode($arr));
?>