<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    include 'inc/common.php';    
    include 'inc/dbconfig.php';

    $db = $pdo;

    include 'inc/board.php';    //  게시판 class
    include './inc/lib.php';    //  페이지네이션용 함수

    $bcode = (isset($_GET['bcode']) && $_GET['bcode'] != '' ) ? $_GET['bcode'] : '';
    $idx = (isset($_GET['idx']) && $_GET['idx'] != '' && is_numeric($_GET['idx'])) ? $_GET['idx'] : '';

    if($bcode == ''){
        die("
            <script>
                alert('게시판 코드가 빠졌습니다.');
                history.go(-1);
            </script>
        ");
    }


    if($idx == ''){
        die("
            <script>
                alert('게시물 번호가 빠졌습니다.');
                history.go(-1);
            </script>
        ");
    }

    //  게시판 목록
    include './inc/board_manage.php';

    $boardm = new BoardManage($db);
    $boardArr = $boardm->list();
    $board_name = $boardm->getBoardName($bcode);

    $board = new Board($db);    //  게시판 클래스 인스턴스 생성

    $js_array = ['js/board_view.js'];
    $menu_code = 'board'; 
    $g_title = $board_name;
    
    $boardRow = $board->view($idx);

    //  $_SERVER['REMOTE_ADDR'] : 지금 접속한 사람의 IP정보를 담고있음
    if($boardRow['last_reader'] != $_SERVER['REMOTE_ADDR']){
        $board->hitInc($idx);
        $board->updateLastReader($idx, $_SERVER['REMOTE_ADDR']);
    }

    //  다운로드 횟수 저장 배열
    //  다운로드 횟수 저장 배열
    $downhit_arr = isset($boardRow['downhit']) ? explode('?', $boardRow['downhit']) : [];

    include 'inc_header.php';
?>
<main class="w-100 mx-auto border rounded-2 p-5 mt-5 mb-5">
    <h1 class="text-center h1 mt-5"><?= $board_name; ?></h1>
    <div class="vstack w-75 mx-auto">
        <div class="p-3">
            <span class="h3 fw-border"><?= $boardRow['subject']; ?></span>
        </div>
        <div class="d-flex mt-5 border border-top-0 border-start-0 border-end-0 border-bottom-1 pb-2">
            <span><?= $boardRow['name']; ?></span>
            <span class="ms-5 me-auto"><?= $boardRow['hit']; ?>회</span>
            <span><?= $boardRow['create_at']; ?></span>
        </div>
        <div class="p-3">
            <?= $boardRow['content']; ?>

            <?php
                //  첨부파일 출력
                if(isset($boardRow['files']) && $boardRow['files'] != ''){
                    $filelist = explode('?', $boardRow['files']);

                    if(!isset($boardRow['downhit']) || $boardRow['downhit'] == ''){
                        $downhit_arr = array_fill(0, count($filelist), 0);
                    }

                    $th = 0;

                    foreach($filelist AS $file){
                        list($file_source, $file_name) = explode('|', $file);

                        echo "<a href=\"./pg/boarddownload.php?idx=$idx&th=$th\">$file_name</a> (down: ".$downhit_arr[$th].")<br>";
                        $th++;
                    }
                }
            ?>
        </div>
        <div class="d-flex gap-2 p-3">
            <button class="btn btn-secondary me-auto" id="btn_list">목록</button>
            <button class="btn btn-primary" id="btn_edit">수정</button>
            <button class="btn btn-danger" id="btn_delete">삭제</button>
        </div>
    </div>
</main>
<?php
    include 'inc_footer.php';
?>