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
  const btn_write = document.querySelector("#btn_write");
  const params = getUrlParams();

  btn_write.addEventListener("click", () => {
    self.location.href = "./board_write.php?bcode=" + params["bcode"];
  });

  const btn_search = document.querySelector("#btn_search");
  btn_search.addEventListener("click", () => {
    const sf = document.querySelector("#sf");
    const sn = document.querySelector("#sn");
    if (sf.value == "") {
      alert("검색어를 입력해 주세요.");
      sf.focus();
      return false;
    }
    self.location.href =
      "./board.php?bcode=" +
      params["bcode"] +
      "&sn=" +
      sn.value +
      "&sf=" +
      sf.value;
  });
});
