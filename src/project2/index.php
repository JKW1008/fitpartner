<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fit Partner</title>
    <link rel="stylesheet" href="./css/jquery.fullpage.css" />
    <link rel="stylesheet" href="./css/common.css" />
    <link rel="stylesheet" href="./css/main.css" />
    <link rel="shortcut icon" href="./images/common/favicon.ico" />
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="./js/jquery.fullpage.js"></script>
    <script src="./js/main.js"></script>
  </head>
  <body>
    <!-- 헤더 -->
    <header>
      <div class="container">
        <a href="./index.html"
          ><img src="./images/common/Fit Partner.png" alt="HeaderLogo"
        /></a>
        <nav class="navMenu">
          <ul>
            <a href="./index.html"><li>서비스센터</li></a>
            <a href="./becomeAvailable.html"><li>입점문의</li></a>
            <a href="./service.html"><li>고객센터</li></a>
            <a href="./company.html"><li>회사문의</li></a>
          </ul>
        </nav>
        <div class="menutoggle">
          <input type="checkbox" name="" id="menuicon" />
          <label for="menuicon">
            <span></span>
            <span></span>
            <span></span>
          </label>
          <div class="sidebar">
            <div class="logo">
              <p>Fit Partner</p>
            </div>
            <ul>
              <a href="./index.html"><li>서비스센터</li></a>
              <a href="./becomeAvailable.html"><li>입점문의</li></a>
              <a href="./service.html"><li>고객센터</li></a>
              <a href="#"><li>회사문의</li></a>
            </ul>
          </div>
        </div>
      </div>
    </header>
    <main id="fullpage">
      <section class="section">
        <main class="section_container">
          <section class="section1 section_inner">
            <article>
              <div class="section1_text">
                <strong>PT</strong>
                <span>도</span>
                <br />
                <h2>내 마음대로 하는 세상</h2>
              </div>
              <div class="section1_btn">
                <button><h1>앱 다운로드</h1></button>
              </div>
            </article>
            <img src="./images/main/section1_img1.png" alt="메인 이미지" />
          </section>
        </main>
      </section>

      <section class="section">
        <main id="section2_bg">
          <section class="section_container">
            <article class="section2_item1">
              <strong>PT</strong>
              <span>예약을</span>
              <br />
              <h2>
                내가 원하는 시간, 원하는 횟수<br />
                원하는 트레이너
              </h2>
            </article>
            <article class="section2_item2">
              <div>
                <img src="./images/main/section2_img1.png" alt="sectionimg" />
                <div>
                  <h1>
                    PT 1, 2회도 편하게<br />
                    결제, 예약하자
                  </h1>
                </div>
              </div>
              <div>
                <img src="./images/main/section2_img2.png" alt="sectionimg" />
                <div>
                  <h1>
                    트레이너의 평가를 보고<br />
                    원하는 트레이너를 선택하자
                  </h1>
                </div>
              </div>
            </article>
          </section>
        </main>
      </section>

      <section class="section">
        <main class="section_container">
          <section class="section3 section_inner">
            <article class="section3_text">
              <strong>핏 파트너 회원들만의</strong>
              <h3>커뮤니티</h3>
              <p>
                핏 파트너들만의<br />
                유용한 정보가 오가는<br />
                커뮤니티 공간
              </p>
            </article>
            <img src="./images/main/section3_img1.png" alt="section3_img" />
          </section>
        </main>
      </section>
      <section class="section">
        <main class="section_container">
          <section class="section4 section_inner">
            <img
              class="pc_img"
              src="./images/main/section4_img1.png"
              alt="section4_img"
            />
            <article class="section4_text">
              <h4>
                핏 파트너는 전국 <br />
                현재 약 8,900곳의<br />
                지점과 함께<br />
                하고있습니다.
              </h4>
              <img
                class="mobile_img"
                src="./images/main/section4_img1.png"
                alt="section4_img"
              />
              <p>
                핏 파트너가<br />
                당신의 파트너가 되는 날을<br />
                기다립니다.
              </p>
            </article>
          </section>
        </main>
      </section>
      <section class="section fp-auto-height">
        <!-- 푸터 -->
        <footer>
          <div class="footer_container">
            <div class="footer_itemBox1">
              <img src="./images/common/footer_logo.png" alt="logo" />
              <p>주식회사 핏파트너 | 대표:ㅇㅇㅇ</p>
              <p>
                사업자등록번호 : 512-78-45362 | 통신판매신고번호 : 제2023-1431호
              </p>
              <p>대구광역시 동구 화랑로525 (영진직업전문학교)</p>
              <p>대표전화 : 1922-7868</p>
              <p>대표이메일 : contact@fitpartner.com</p>
              <br />
              <p>(c) 2023 fitpartner Inc. All rights Reserved</p>
            </div>
            <div class="footer_itemBox2">
              <div class="footer_item1">
                <span>개인정보 처리방침 | </span>
                <span>서비스 이용약관</span>
              </div>
              <div class="footer_item2">
                <img src="./images/common/footer_sns01.png" alt="sns01" />
                <img src="./images/common/footer_sns02.png" alt="sns02" />
                <img src="./images/common/footer_sns03.png" alt="sns03" />
                <img src="./images/common/footer_sns04.png" alt="sns04" />
                <img src="./images/common/footer_sns05.png" alt="sns05" />
              </div>
            </div>
          </div>
        </footer>
      </section>
    </main>
  </body>
</html>
