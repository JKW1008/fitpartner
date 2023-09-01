<?php
    include 'inc/dbconfig.php';

    $db = $pdo;

    include 'inc/board.php';

    $bcode = (isset($_GET['bcode']) && $_GET['bcode'] != '' ) ? $_GET['bcode'] : '';

    if($bcode == ''){
        die("
            <script>
                alert('게시판 코드가 빠졌습니다.');
                history.go(-1);
            </script>
        ");
    }

    $board = new Board($db);

    $js_array = ['js/board_write.js'];

    $g_title = '글 작성';

    include 'inc_header.php';
?>
<main class="w-75 mx-auto border rounded-2 p-5 mt-5 mb-5">
    <h1 class="text-center h1 mt-5">게시판 글쓰기</h1>


</main>
<?php
    include 'inc_footer.php';
?>