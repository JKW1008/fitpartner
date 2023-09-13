<?php

    $g_title = '로그인';
    $js_array = ['js/login.js'];

    $menu_code = 'login';

    include 'inc_header.php';
?>
<main class="w-75 mx-auto border rounded-5 p-5 d-flex gap-5 mt-5 mb-5" style="height: calc(100vh - 257px);">
    <form action="" class="w-25 mt-5 m-auto">
        <img src="./images/Fit Partner.png" alt="" width="100%" class="mt-5">
        <h1 class="h3 mt-5 mb-3">로그인</h1>
        <div class="form-floating  mt-2">
            <input type="text" class="form-control" id="f_id" placeholder="아이디 입력" autocomplete="off">
            <label for="f_id">아이디</label>
        </div>
        <div class="form-floating mt-2">
            <input type="password" class="form-control" id="f_pw" placeholder="비밀번호 입력">
            <label for="f_pw">비밀번호</label>
        </div>
        <button class="w-100 mt-3 btn btn-lg btn-primary" type="button" id="btn_login">로그인</button>
    </form>
</main>
<?php
    include 'inc_footer.php';
?>