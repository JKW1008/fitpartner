<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    include 'inc/common.php';    
    include 'inc/dbconfig.php';

    $db = $pdo;

    include 'inc/board.php';    //  게시판 class
    include './inc/lib.php';    //  페이지네이션용 함수

    $bcode = (isset($_GET['bcode']) && $_GET['bcode'] != '' ) ? $_GET['bcode'] : '';
    $page  = (isset($_GET['page' ]) && $_GET['page' ] != '' && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
    $sn    = (isset($_GET['sn'   ]) && $_GET['sn'   ] != '' ) ? $_GET['sn'   ] : '';
    $sf    = (isset($_GET['sf'   ]) && $_GET['sf'   ] != '' ) ? $_GET['sf'   ] : '';

    if($bcode == ''){
        die("
            <script>
                alert('게시판 코드가 빠졌습니다.');
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

    $js_array = ['js/board.js'];

    $g_title = $board_name;

    $paramArr = ['sn' => $sn, 'sf' => $sf];

    $total = $board->total($bcode, $paramArr);
    $limit = 10;
    $page_limit = 5;

    $boardRs = $board->list($bcode, $page, $limit, $paramArr);

    $menu_code = 'board';

    include 'inc_header.php';
?>
<main class="w-100 mx-auto border rounded-2 p-5 mt-5 mb-5">
    <h1 class="text-center h1 mt-5"><?= $board_name; ?></h1>

    <table class="table striped mt-5">
        <colgroup>
            <col width="10%">
            <col width="45%">
            <col width="10%">
            <col width="15%">
            <col width="10%">
        </colgroup>
        <tr>
            <th>번호</th>
            <th>제목</th>
            <th>이름</th>
            <th>날짜</th>
            <th>조회 수</th>
        </tr>
        <?php
            foreach($boardRs AS $boardRow){
        ?>
        <tr>
            <td><?= $boardRow['idx'      ]; ?></td>
            <td><?= $boardRow['subject'  ]; ?></td>
            <td><?= $boardRow['name'     ]; ?></td>
            <td><?= $boardRow['create_at']; ?></td>
            <td><?= $boardRow['hit'      ]; ?></td>
        </tr>
        <?php
            }
        ?>
    </table>
    <div class="container mt-3 w-50 d-flex gap-2 justify-content-center">
        <select id="sn" class="form-select w-25">
            <option value="1">제목+내용</option>
            <option value="2">제목</option>
            <option value="3">내용</option>
            <option value="4">글쓴이</option>
        </select>
        <input type="text" class="form-control w-25" id="sf" value="">
        <button class="btn btn-primary" id="btn_search">검색</button>
    </div>
    <div class="d-flex justify-content-between align-items-start">
        <?php
            $param = '&bcode=' . $bcode;

            if(isset($sn) && $sn != '' && isset($sf) && $sf != ''){
                $param = '&sn='. $sn. '&sf='. $sf;
            }

            echo my_pagination($total, $limit, $page_limit, $page, $param);
        ?>
        <button class="btn btn-primary" id="btn_write">글쓰기</button>
    </div>

</main>
<?php
    include 'inc_footer.php';
?>