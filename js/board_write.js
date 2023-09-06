function getUrlParams() {
  const params = {};

  window.location.search.replace(
    /[?&]+([^=&]+)=([^&]*)/gi,
    function (str, key, value) {
      params[key] = value;
    }
  );

  return params;
}

function getExtensionOfFilename(filename) {
  const filelen = filename.length; //  문자열의 길이
  const lastdot = filename.lastIndexOf(".");
  return filename.substring(lastdot + 1, filelen).toLowerCase();
}

document.addEventListener("DOMContentLoaded", () => {
  //  게시판 목록으로 이동하기
  const btn_board_list = document.querySelector("#btn_board_list");
  btn_board_list.addEventListener("click", () => {
    const params = getUrlParams();

    self.location.href = "./board.php?bcode=" + params["bcode"];
  });

  //  게시물 작성 후 확인버튼 클릭 시
  const btn_write_submit = document.querySelector("#btn_write_submit");
  btn_write_submit.addEventListener("click", () => {
    const id_subject = document.querySelector("#id_subject");

    if (id_subject.value == "") {
      alert("게시물 제목을 입력해 주세요.");
      id_subject.focus();
      return false;
    }

    const markupStr = $("#summernote").summernote("code");

    if (markupStr == "<p><br></p>") {
      alert("내용을 입력해 주세요.");
      return false;
    }

    //  파일 첨부
    const id_attach = document.querySelector("#id_attach");

    if (id_attach.files.length > 3) {
      alert("첨부가능한 파일의 최대 갯수는 3개입니다.");
      id_attach.value = "";
      return false;
    }

    const params = getUrlParams();

    const f = new FormData();
    f.append("subject", id_subject.value); //  제목
    f.append("content", markupStr); //  내용
    f.append("bcode", params["bcode"]); //  게시판 코드
    f.append("mode", "input"); //  모드 : 글등록
    // f.append("files", file); // 파일 첨부

    let ext = "";

    for (const file of id_attach.files) {
      if (file.size > 40 * 1024 * 1024) {
        alert("첨부가능한 파일의 최대 용량은 40메가 입니다.");
        id_attach.value = "";
        return false;
      }

      ext = getExtensionOfFilename(file.name);

      if (
        ext == "txt" ||
        ext == "exe" ||
        ext == "xls" ||
        ext == "dmg" ||
        ext == "php" ||
        ext == "js"
      ) {
        alert(
          "첨부할 수 없는 포맷의 파일이 첨부되었습니다.(exe, txt, php, js...)"
        );
        id_attach.value = "";
        return false;
      }

      f.append("files[]", file);
    }

    const xhr = new XMLHttpRequest();

    xhr.open("POST", "./pg/board_process.php", true);
    xhr.send(f);

    xhr.onload = () => {
      if (xhr.status == 200) {
        const data = JSON.parse(xhr.responseText);

        if (data.result == "success") {
          alert("등록되었습니다.");
          self.location.href = "./board.php?bcode=" + params["bcode"];
        } else if (data.result == "file_upload_count_exceed") {
          alert("파일 업로드 갯수를 초과했습니다.");
          id_attach.value = "";
          return false;
        } else if (data.result == "post_size_exceed") {
          alert("첨부파일의 용량이 초과되었습니다.");
          id_attach.value = "";
          return false;
        } else if (data.result == "not_allowed_file") {
          alert(
            "첨부할 수 없는 포멧의 파일이 첨부되었습니다.(exe, txt, dmg ..)"
          );
          id_attach.value = "";
          return false;
        }
      } else if (xhr.status == 404) {
        alert("파일이 없습니다.");
      }
    };
  });

  const id_attach = document.querySelector("#id_attach");
  id_attach.addEventListener("change", () => {
    if (id_attach.files.length > 3) {
      alert("첨부가능한 파일의 최대 갯수는 3개입니다.");
      id_attach.value = "";
      return false;
    }
  });
});
