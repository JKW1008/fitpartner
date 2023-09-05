<?php
    session_start();

    $ses_id = (isset($_SESSION['ses_id']) && $_SESSION['ses_id'] != '') ? $_SESSION['ses_id'] : '';

    if($ses_id == ''){
        echo "
            <script>
                alert('로그인 후 접근 가능한 메뉴입니다');
                self.location.href = './index.php'
            </script>";
        exit; 
    }

    include 'inc/dbconfig.php';

    $db = $pdo;

    include 'inc/member.php';

    $mem = new Member($db);

    $memArr = $mem->getInfo($ses_id);

    $js_array = ['js/mypage.js'];

    $g_title = "My Page";

    $menu_code = 'member';


    include "./inc_header.php";
?>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<main class="w-50 mx-auto border rounded-5 p-5 mt-5 mb-5">
    <h1 class="text-center h1 mt-5">회원정보 수정</h1>
    <form name="input_form" method="post" enctype="multipart/form-data" autocomplete="off"
        action="./pg/member_process.php">
        <input type="hidden" name="mode" value="edit">
        <input type="hidden" name="email_chk" id="email_chk" value="0">
        <input type="hidden" name="old_email" value="<?= $memArr['email']; ?>">
        <input type="hidden" name="old_photo" value="<?= $memArr['photo']; ?>">
        <div class="d-flex gap-2 align-items-end">
            <div>
                <label for="f_id" class="form-label mt-5">아이디</label>
                <input type="text" name="id" readonly class="form-control" id="f_id" value="<?= $memArr['id']; ?>">
            </div>
            <button class="btn btn-secondary" id="btn_id_check" type="button">아이디 중복확인</button>
        </div>
        <div class="mt-3 d-flex gap-2 align-items-end">
            <div>
                <label for="f_name" class="form-label mt-3">이름</label>
                <input type="text" name="name" class="form-control" id="f_name" value="<?= $memArr['name']; ?>"
                    placeholder="이름을 입력해 주세요.">
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
                <input type="text" name="email" class="form-control" id="f_email" value="<?= $memArr['email']; ?>"
                    placeholder="이메일을 입력해 주세요.">
            </div>
            <button class="btn btn-secondary" id="btn_email_check" type="button">이메일 중복확인</button>
        </div>
        <div class="d-flex align-items-end mt-3 gap-2">
            <div>
                <label for="f_zipcode mt-3">우편번호</label>
                <input type="text" name="zipcode" id="f_zipcode" value="<?= $memArr['zipcode']; ?>" readonly
                    class="form-control" maxlength="5" minlength="5">
            </div>
            <button class="btn btn-secondary" type="button" id="btn_zipcode">우편번호 찾기</button>
        </div>
        <div class="d-flex mt-3 gap-2 justify-content-between">
            <div class="w-50">
                <label for="f_addr1" class="form-label mt-3">주소</label>
                <input type="text" class="form-control" name="addr1" id="f_addr1" value="<?= $memArr['addr1']; ?>"
                    placeholder="">
            </div>
            <div class="w-50">
                <label for="f_addr2" class="form-label mt-3">상세주소</label>
                <input type="text" class="form-control" name="addr2" id="f_addr2" value="<?= $memArr['addr2']; ?>"
                    placeholder="상세주소를 입력해 주세요">
            </div>
        </div>

        <div class="mt-3 d-flex flex-column gap-5">
            <div>
                <label for="f_photo" class="form-label mt-3">프로필 이미지</label>
                <input type="file" name="photo" id="f_photo" class="form-control">
            </div>
            <?php
                if($memArr['photo']){
                    echo '
                        <img src="data/profile/'.$memArr['photo'].'" id="f_preview" class="w-25 mx-auto" alt="profile image">
                        ';
                }else{
                    echo '
                        <img src="./images/pngegg.png" id="f_preview" class="w-25 mx-auto" alt="profile image">
                        ';
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
    include "./inc_footer.php";
?>