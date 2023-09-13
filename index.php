<?php
    include './inc/common.php';
    include './inc/dbconfig.php';

    $db = $pdo;

    //  게시판 목록
    include './inc/board_manage.php';

    $boardm = new BoardManage($db);
    $boardArr = $boardm->list();

    $g_title = '메인';
    $js_array = ['js/home.js'];

    $menu_code = 'home';

    include 'inc_header.php';
?>
<main class="w-75 mx-auto border rounded-5 p-5 d-flex gap-5" style="margin: 24%  0;">
    <img src=" images/Fit Partner.png" alt="" style="width: 60%;">
    <div>
        <h3>피트파트너 커뮤니티</h3>
    </div>
</main>
<?php
    include 'inc_footer.php';
?>