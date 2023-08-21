<?php
    if(!isset($_POST['chk']) or $_POST['chk'] != 1){
        // die("<script>
        //         alert('약관 동의 후에 접근 가능합니다.');
        //         self.location.href = './stipulation.php';
        //     </script>");
    }

    include "./inc_header.php";
?>
<main class="w-50 mx-auto border rounded-5 p-5 mt-5 mb-5">
    <h1 class="text-center h1 mt-5">회원가입</h1>
    <form name="input_form" method="post" enctype="multipart/form-data" autocomplete="off"
        action="./pg/member_process.php">
        <input type="hidden" name="mode" value="input">
        <input type="hidden" name="id_chk" id="id_chk" value="0">
        <input type="hidden" name="email_chk" id="email_chk" value="0">
        <div class="d-flex gap-2 align-items-end">
            <div>
                <label for="f_id" class="form-label mt-5">아이디</label>
                <input type="text" name="id" class="form-control" id="f_id" placeholder="아이디를 입력해 주세요.">
            </div>
            <button class="btn btn-secondary" id="btn_id_check" type="button">아이디 중복확인</button>
        </div>
        <div class="mt-3 d-flex gap-2 align-items-end">
            <div>
                <label for="f_name" class="form-label mt-3">이름</label>
                <input type="text" name="name" class="form-control" id="f_name" placeholder="이름을 입력해 주세요.">
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
                <input type="text" name="email" class="form-control" id="f_email" placeholder="이메일을 입력해 주세요.">
            </div>
            <button class="btn btn-secondary" id="btn_email_check" type="button">이메일 중복확인</button>
        </div>
        <div class="d-flex align-items-end mt-3 gap-2">
            <div>
                <label for="f_zipcode mt-3">우편번호</label>
                <input type="text" name="zipcode" id="f_zipcode" readonly class="form-control" maxlength="5"
                    minlength="5">
            </div>
            <button class="btn btn-secondary" type="button" id="btn_zipcode">우편번호 찾기</button>
        </div>
        <div class="d-flex mt-3 gap-2 justify-content-between">
            <div class="w-50">
                <label for="f_addr1" class="form-label mt-3">주소</label>
                <input type="text" class="form-control" name="addr1" id="f_addr1" placeholder="">
            </div>
            <div class="w-50">
                <label for="f_addr2" class="form-label mt-3">상세주소</label>
                <input type="text" class="form-control" name="addr2" id="f_addr2" placeholder="상세주소를 입력해 주세요">
            </div>
        </div>

        <div class="mt-3 d-flex flex-column gap-5">
            <div>
                <label for="f_photo" class="form-label mt-3">프로필 이미지</label>
                <input type="file" name="photo" id="f_photo" class="form-control">
            </div>
            <img src="./images/pngegg.png" id="f_preview" class="w-25 mx-auto" alt="profile image">
        </div>

        <div class="mt-3 d-flex gap-2 mt-5">
            <button id="btn_submit" class="btn btn-primary w-50" type="button">가입확인</button>
            <button class="btn btn-secondary w-50" type="button">가입취소</button>
        </div>
    </form>
</main>
<?php
    include "./inc_footer.php";
?>