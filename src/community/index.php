<?php
    include './inc/common.php';

    $g_title = '메인';
    $js_array = ['js/home.js'];

    $menu_code = 'home';

    include 'inc_header.php';
?>
<main class="w-75 mx-auto border rounded-5 p-5 d-flex gap-5" style="height: calc(100vh - 257px);">
    <img src="images/logo.svg" alt="" class="w-50">
    <div>
        <h3>HOME 입니다.</h3>
    </div>
</main>
<?php
    include 'inc_footer.php';
?>