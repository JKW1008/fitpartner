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
  const params = getUrlParams();

  const btn_file_dels = document.querySelectorAll(".btn_file_del");
  btn_file_dels.forEach((box) => {
    box.addEventListener("click", () => {
      if (!confirm("해당 첨부파일을 삭제하시겠습니까?")) {
        return false;
      }

      const f = new FormData();

      f.append("th", box.dataset.th); //  제목
      f.append("bcode", params["bcode"]); //  게시판 코드
      f.append("idx", params["idx"]); //  게시물 번호
      f.append("mode", "each_file_del"); //  모드 : 개별 파일 삭제

      const xhr = new XMLHttpRequest();
      xhr.open("post", "./pg/board_process.php", true);
      xhr.send(f);

      xhr.onload = () => {
        if (xhr.status == 200) {
          const data = JSON.parse(xhr.responseText);

          if (data.result == "empty_idx") {
            alert("게시물 번호가 빠졌습니다.");
          } else if (data.result == "empty_th") {
            alert("몇번째 첨부파일인지 알수가 없습니다.");
          } else if (data.result == "success") {
            self.location.reload();
          }
        } else if (xhr.stauts == 404) {
          alert("파일이 없습니다.");
        }
      };
    });
  });

  const id_attach = document.querySelector("#id_attach");
  if (id_attach) {
    id_attach.addEventListener("change", () => {
      const f = new FormData();

      f.append("bcode", params["bcode"]); //  게시판 코드
      f.append("mode", "file_attach"); //  모드 : 파일만 첨부
      f.append("idx", params["idx"]); //  게시물 번호

      if (id_attach.files[0].size > 40 * 1024 * 1024) {
        alert("첨부가능한 파일의 최대 용량은 40메가 입니다.");
        id_attach.value = "";
        return false;
      }

      ext = getExtensionOfFilename(id_attach.files[0].name);

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

      f.append("files[]", id_attach.files[0]); //  파일

      const xhr = new XMLHttpRequest();
      xhr.open("post", "./pg/board_process.php", true);
      xhr.send(f);

      xhr.onload = () => {
        if (xhr.status == 200) {
          const data = JSON.parse(xhr.responseText);

          if (data.result == "success") {
            self.location.reload();
          } else if (data.result == "empty_files") {
            alert("파일이 첨부되지 않았습니다.");
          }
        } else if (xhr.status == 404) {
          alert("통신 실패");
        }
      };
    });
  }

  const btn_board_list = document.querySelector("#btn_board_list");
  btn_board_list.addEventListener("click", () => {
    self.location.href = "./board.php?bcode=" + params["bcode"];
  });
});
