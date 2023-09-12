<?php
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

    if($mode == ''){
        $arr = [ "result" => "empty_mode" ];
        die(json_encode($arr));
    }

    $comment = new Comment($db);

    //  댓글 등록
    if($mode == 'input'){
        if($pidx == ''){
            $arr = [ "result" => "empty_pidx" ];
            die(json_encode($arr));
        }

        if($content == ''){
            $arr = [ "result" => "empty_content" ];
            die(json_encode($arr));
        }

        $arr = [ "pidx" => $pidx, "content" => $content, "id" => $ses_id ];
      
        $comment->input($arr);

        $arr = [ "result" => "success" ];
        die(json_encode($arr));
      }

      else if($mode == "delete"){
        if($pidx == ''){
            $arr = [ "result" => "empty_pidx" ];
            die(json_encode($arr));
        }

        if($idx == ''){
            $arr = [ "result" => "empty_idx" ];
            die(json_encode($arr));
        }

        $comment->delete($pidx, $idx);
        
        $arr = [ "result" => "success" ];
        die(json_encode($arr));
      }

?>