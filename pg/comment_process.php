<?php
    $err_array = error_get_last();

    print_r($err_array);

    include '../inc/common.php';
    include '../inc/dbconfig.php';
 
    $db = $pdo;

    include '../inc/member.php';    //  회원 class
    include '../inc/comment.php';   //  댓글 class

    if($ses_id == ''){
        $arr = [ "result" => "not_login" ];
        die(json_encode($arr));
    }
 
    $mode    = (isset($_POST['mode'   ]) && $_POST['mode'   ] != '') ? $_POST['mode'   ] : '';
    $idx     = (isset($_POST['idx'    ]) && $_POST['idx'    ] != '') ? $_POST['idx'    ] : '';
    $pidx    = (isset($_POST['pidx'   ]) && $_POST['pidx'   ] != '') ? $_POST['pidx'   ] : '';
    $content = (isset($_POST['content']) && $_POST['content'] != '') ? $_POST['content'] : '';

    //  댓글 등록
    if($mode == 'input'){
        if($pidx == ''){
            $arr = [ "result" => "empty__pidx" ];
            die(json_encode($arr));
        }

        if($content == ''){
            $arr = [ "result" => "empty__content" ];
            die(json_encode($arr));
        }

        $arr = [ "pidx" => $pidx, "content" => $content, "id" => $ses_id ];
      
        $comment = new Comment($db);
        $comment->input($arr);

        $arr = [ "result" => "success" ];
        die(json_encode($arr));
      }

?>