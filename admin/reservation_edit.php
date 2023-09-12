<?php
    $g_title = '회원정보 수정페이지';
    $js_array = ['js/reservation_edit.js'];

    $menu_code = 'reservation';

    include 'inc_common.php';
    include 'inc_header.php';
    include '../inc/dbconfig.php';

    $db = $pdo;

    include '../inc/reservation.php';    // 회원관리 Class

    $idx = (isset($_GET['idx']) && $_GET['idx'] != '' && is_numeric($_GET['idx'])) ? $_GET['idx'] : '';

    if($idx == ''){
        die("<script>
                alert('idx값이 비었습니다.');
                history.go(-1);
            </script>");
    }

    $mem = new Reservation($db);


    $row = $mem->getInfoFromIdx($idx);

    
?>
<main class="w-75 mx-auto border rounded-5 p-5 mt-5 mb-5">
    <h1 class="text-center h1 mt-5">상담확인</h1>
    <form name="input_form" method="post" enctype="multipart/form-data" autocomplete="off"
        action="./pg/member_process.php">
        <div class=" gap-2 align-items-end">
            <div class="w-100">
                <label for="companyname" class="form-label mt-5">업체명</label>
                <input type="text" name="companyname" value="<?= $row['companyname']; ?>" readonly class="form-control"
                    id="companyname" placeholder="업체명를 입력해 주세요.">
            </div>
            <div class="w-100">
                <label for="name" class="form-label mt-3">대표명</label>
                <input type="text" name="name" value="<?= $row['name']; ?>" class="form-control" readonly id="name"
                    placeholder="대표명을 입력해 주세요.">
            </div>

        </div>
        <div class="w-100">
            <label for="f_email" class="form-label mt-3">이메일</label>
            <input type="text" name="email" value="<?= $row['email']; ?>" class="form-control" readonly id="f_email"
                placeholder="이메일을 입력해 주세요.">
        </div>
        <div class="w-100">
            <label for="phonenumber" class="form-label mt-3">대표전화</label>
            <input type="text" name="phonenumber" value="<?= $row['phone_number']; ?>" readonly class="form-control"
                id="phonenumber" placeholder="이메일을 입력해 주세요.">
        </div>
        <div class="w-100">
            <label for="content" class="form-label mt-3">문의 내용</label>
            <textarea name="content" id="content" cols="30" rows="10" class="form-control" readonly>
                <?= $row['content']; ?>
            </textarea>
        </div>
        <div class="mt-3 d-flex gap-2 mt-5">
            <button id="btn_submit" class="btn btn-primary w-50" type="button">상담완료</button>
            <button class="btn btn-secondary w-50" type="button">취소</button>
        </div>
    </form>
</main>
<?php
    include 'inc_footer.php';
?>