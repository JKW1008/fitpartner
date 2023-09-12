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

document.addEventListener("DOMContentLoaded", () => {
  const params = getUrlParams();
  // 수정확인 버튼 클릭시
  const btn_submit = document.querySelector("#btn_submit");

  btn_submit.addEventListener("click", () => {
    const f = new FormData();
    f.append("idx", params["idx"]);
    f.append("mode", "check");

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "./pg/reservation_process.php", true);
    xhr.send(f);

    xhr.onload = () => {
      if (xhr.status == 200) {
        const data = JSON.parse(xhr.responseText);

        if (data.result == "empty_idx") {
          alert("예약번호가 비어있습니다.");
          return false;
        } else if (data.result == "empty_mode") {
          alert("모드가 비어있습니다.");
          return false;
        } else if (data.result == "success") {
          alert("상담처리 되었습니다.");
          self.location.href = "./reservation.php";
        }
      } else if (xhr.status == 404) {
        alert("통신 실패");
      }
    };
  });
});
