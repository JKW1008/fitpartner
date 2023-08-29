<?php
    $g_title = '회원가입을 축하드립니다.';
    $js_array = ['js/member.js'];

    $menu_code = 'board';

    include 'inc_common.php';
    include 'inc_header.php';
    include '../inc/dbconfig.php';

    $db = $pdo;

    include '../inc/board.php';    // 회원관리 Class

    $sn = (isset($_GET['sn']) && $_GET['sn'] != '' && is_numeric($_GET['sn'])) ? $_GET['sn'] : '';
    $sf = (isset($_GET['sf']) && $_GET['sf'] != '') ? $_GET['sf'] : '';

    $paramArr = [ 'sn' => $sn, 'sf' => $sf];

    $board = new Board($db);

    $boardArr = $board->list();
?>
<main class="border rounded-2 p-5" style="height: calc(100vh - 257px);">
    <div class="container">
        <h3>게시판관리</h3>
    </div>
    <table class="table table-border">
        <tr>
            <th>번호</th>
            <th>게시판 이름</th>
            <th>게시판 코드</th>
            <th>게시판 타입</th>
            <th>게시물 수</th>
            <th>등록일시</th>
            <th>관리</th>
        </tr>
        <?php
            foreach($boardArr AS $row){

                // $row['create_at'] = substr($row['create_at'], 0, 16);
        ?>
        <tr>
            <td><?= $row['idx']; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['bcode']; ?></td>
            <td><?= $row['btype']; ?></td>
            <td><?= $row['cnt']; ?></td>
            <td><?= $row['create_at']; ?></td>
            <td>
                <button class="btn btn-primary btn-sm btn_mem_edit" data-idx="<?= $row['idx']; ?>">수정</button>
                <button class="btn btn-danger btn-sm btn_mem_delete" data-idx="<?= $row['idx']; ?>">삭제</button>
            </td>
        </tr>
        <?php
            }
        ?>
    </table>
</main>
<?php
    include 'inc_footer.php';
?>