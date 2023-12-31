<?php
    $g_title = '회원정보 수정페이지';
    $js_array = ['js/member_edit.js'];

    $menu_code = 'member';

    include 'inc_common.php';
    include 'inc_header.php';
    include '../inc/dbconfig.php';

    $db = $pdo;

    include '../inc/member.php';    // 회원관리 Class

    $idx = (isset($_GET['idx']) && $_GET['idx'] != '' && is_numeric($_GET['idx'])) ? $_GET['idx'] : '';

    if($idx == ''){
        die("<script>
                alert('idx값이 비었습니다.');
                history.go(-1);
            </script>");
    }

    $mem = new Member($db);


    $row = $mem->getInfoFromIdx($idx);
?>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<main class="w-75 mx-auto border rounded-5 p-5 mt-5 mb-5">
    <h1 class="text-center h1 mt-5">회원정보수정</h1>
    <form name="input_form" method="post" enctype="multipart/form-data" autocomplete="off"
        action="./pg/member_process.php">
        <input type="hidden" name="mode" value="edit">
        <input type="hidden" name="idx" id="id_chk" value="<?= $row['idx']; ?>">
        <input type="hidden" name="email_chk" value="0">
        <input type="hidden" name="old_email" value="<?= $row['email']; ?>">
        <input type="hidden" name="old_photo" value="<?= $row['photo']; ?>">
        <div class="d-flex gap-2 align-items-end">
            <div>
                <label for="f_id" class="form-label mt-5">아이디</label>
                <input type="text" name="id" value="<?= $row['id']; ?>" readonly class="form-control" id="f_id"
                    placeholder="아이디를 입력해 주세요.">
            </div>
        </div>
        <div class="mt-3 d-flex gap-2 align-items-end">
            <div class="w-25">
                <label for="f_name" class="form-label mt-3">이름</label>
                <input type="text" name="name" value="<?= $row['name']; ?>" class="form-control" id="f_name"
                    placeholder="이름을 입력해 주세요.">
            </div>
            <div class="w-25">
                <label for="">레벨</label>
                <select name="f_level" id="levelSelect" class="form-select">
                    <option value="1" <?php if($row['level'] == 1) echo " selected"; ?></option>가입대기</option>
                    <option value="2" <?php if($row['level'] == 2) echo " selected"; ?>>준회원</option>
                    <option value="3" <?php if($row['level'] == 3) echo " selected"; ?>>정회원</option>
                    <option value="10" <?php if($row['level'] == 10) echo " selected"; ?>>관리자</option>
                </select>
            </div>
        </div>
        <div class="d-flex mt-3 gap-2 justify-content-between">
            <div class="w-50">
                <label for="f_password" class="form-label mt-3">비밀번호</label>
                <input type="password" name="password" class="form-control" id="f_password"
                    placeholder="비밀번호를 입력해 주세요.">
            </div>
            <div class="w-50">
                <label for="f_password2" class="form-label mt-3">비밀번호 확인</label>
                <input type="password" name="password2" class="form-control" id="f_password2"
                    placeholder="비밀번호를 입력해 주세요.">
            </div>
        </div>
        <div class="d-flex mt-3 gap-2 align-items-end">
            <div class="flex-grow-1">
                <label for="f_email" class="form-label mt-3">이메일</label>
                <input type="text" name="email" value="<?= $row['email']; ?>" class="form-control" id="f_email"
                    placeholder="이메일을 입력해 주세요.">
            </div>
            <button class="btn btn-secondary" id="btn_email_check" type="button">이메일 중복확인</button>
        </div>
        <div class="d-flex align-items-end mt-3 gap-2">
            <div>
                <label for="f_zipcode mt-3">우편번호</label>
                <input type="text" name="zipcode" value="<?= $row['zipcode']; ?>" id="f_zipcode" readonly
                    class="form-control" maxlength="5" minlength="5">
            </div>
            <button class="btn btn-secondary" type="button" id="btn_zipcode">우편번호 찾기</button>
        </div>
        <div class="d-flex mt-3 gap-2 justify-content-between">
            <div class="w-50">
                <label for="f_addr1" class="form-label mt-3">주소</label>
                <input type="text" class="form-control" name="addr1" value="<?= $row['addr1']; ?>" id="f_addr1"
                    placeholder="">
            </div>
            <div class="w-50">
                <label for="f_addr2" class="form-label mt-3">상세주소</label>
                <input type="text" class="form-control" name="addr2" value="<?= $row['addr2']; ?>" id="f_addr2"
                    placeholder="상세주소를 입력해 주세요">
            </div>
        </div>

        <div class="mt-3 d-flex flex-column gap-5">
            <div>
                <label for="f_photo" class="form-label mt-3">프로필 이미지</label>
                <input type="file" name="photo" id="f_photo" class="form-control">
            </div>
            <?php if($row['photo'] != ''){
                echo '<img src="../data/profile/'.$row['photo'].'" id="f_preview" class="w-25 mx-auto" alt="profile image">';
            }else{
                echo '<img src="../images/pngegg.png" id="f_preview" class="w-25 mx-auto" alt="profile image">';
            }
            ?>

        </div>

        <div class="mt-3 d-flex gap-2 mt-5">
            <button id="btn_submit" class="btn btn-primary w-50" type="button">수정확인</button>
            <button class="btn btn-secondary w-50" type="button">수정취소</button>
        </div>
    </form>
</main>
<?php
    include 'inc_footer.php';
?>