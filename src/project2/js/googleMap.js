window.initMap = function () {
  const map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 35.87562890112117, lng: 128.68133033325446 },
    zoom: 17,
  });

  const malls = [{ label: "Fit", name: "핏트파트너", lat: 35.87562890112117, lng: 128.68133033325446 }];
  malls.forEach(({ label, name, lat, lng }) => {
    const marker = new google.maps.Marker({
      position: { lat, lng },
      label,
      map,
    });
  });
};

//   const image = {
//     url: "https://img.icons8.com/?size=512&id=111131&format=png",
//     scaledSize: new google.maps.Size(300, 300),
//     origin: new google.maps.Point(100, 100),
//     anchor: new google.maps.Point(0, 0),
//   };
//   const beachMarker = new google.maps.Marker({
//     position: { lat: 35.87562890112117, lng: 128.68133033325446 },
//     map,
//     icon: image,
//   });
//

// window.initMap = initMap;

// const image = {
//   url: "https://img.icons8.com/?size=512&id=111131&format=png",
//   size: new google.maps.Size(50, 50), // 원하는 크기로 조정
//   origin: new google.maps.Point(0, 0),
//   anchor: new google.maps.Point(25, 25), // 이미지 중심으로 설정
// };
