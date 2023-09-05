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
  //    글 목록 버튼 클릭
  const btn_list = document.querySelector("#btn_list");
  btn_list.addEventListener("click", () => {
    self.location.href = "./board.php?bcode=" + params["bcode"];
  });

  //    글 수정 버튼 클릭
  const btn_edit = document.querySelector("#btn_edit");
  btn_edit.addEventListener("click", () => {
    self.location.href =
      "./board_edit.php?bcode=" + params["bcode"] + "&idx=" + params["idx"];
  });
});
