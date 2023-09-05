<?php

  $js_array = [ 'js/member.js'];

  $g_title = '약관';
  $menu_code = 'member';


  include "./inc_header.php";
?>
<main class="p-5 border rounded-5 mt-5">
    <h1 class="text-center mt-5">회원 약관 및 개인정보 취급방침 동의</h1>
    <h4 class="mt-5">회원 약관</h4>
    <textarea name="" id="" cols="30" rows="10" class="form-control mt-5">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore at quasi veniam modi repudiandae aut corporis qui consectetur porro accusamus quod ut nam repellat quia ducimus incidunt maxime quas rerum nihil, nesciunt nisi amet impedit maiores! Aliquam dolorem eos sed blanditiis veritatis aut sequi, est beatae neque qui, minima sapiente esse vitae? Minima beatae ab ut accusantium consectetur, officia rerum reprehenderit eveniet culpa nihil enim ullam obcaecati dolore aliquam voluptates, autem excepturi ducimus nobis veniam commodi deleniti error? Porro unde ipsum magnam, nobis officia eveniet veritatis libero velit dignissimos nesciunt perferendis, aspernatur modi! Id dolorem obcaecati libero ratione quasi officiis praesentium at impedit nam voluptatum animi et quidem ullam, illum cupiditate accusantium aliquid voluptas harum error sapiente officia! Odio rerum provident distinctio tempore obcaecati velit temporibus blanditiis unde omnis ad! Quae saepe illum numquam rem eum error neque pariatur expedita, ad alias temporibus sit iste laudantium distinctio facilis fuga tempora dicta earum. Odit reiciendis consectetur a enim iusto alias. Repellat at, minus consequatur veniam beatae illum quis fugit consectetur! Officiis tempore iure nam dolor adipisci dolorem ratione sed accusamus totam, dignissimos optio voluptas possimus. Aspernatur maiores neque commodi vero at cum est in repudiandae natus esse, voluptatum vel consectetur, illum eaque libero, laudantium facere ullam magnam quas? Provident corporis officia accusamus dignissimos, debitis adipisci ipsum fugiat odit obcaecati vero rerum temporibus. Excepturi, cum. Tempora, doloremque reprehenderit eveniet ipsam voluptatibus adipisci exercitationem magni ratione architecto sed necessitatibus iste rem eius distinctio ex eligendi recusandae, voluptatem mollitia aliquid. Illum ducimus consequuntur, neque esse corrupti officiis incidunt et possimus, quasi pariatur voluptatum eos. Doloribus eum officia consequuntur? Sunt alias non dolore at minus voluptatum quo iure, vero nulla labore magni tenetur, quae pariatur asperiores eius quisquam accusantium illum in id corrupti inventore iusto voluptate totam tempora? Eaque id doloribus velit corrupti ullam expedita?
      </textarea>
    <div class="form-check mt-5">
        <input class="form-check-input" type="checkbox" value="" id="chk_member1" />
        <label class="form-check-label" for="chk_member1">
            위 약관에 동의하시겠습니까?
        </label>
    </div>
    <h4 class="mt-5">개인정보 취급방침</h4>
    <textarea name="" id="" cols="30" rows="10" class="form-control mt-5">
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Excepturi officia tempore delectus eos commodi explicabo, laudantium rerum ullam voluptates, pariatur vero placeat optio est hic eum? Voluptatem perspiciatis eos earum eveniet dicta deserunt nulla architecto esse rem voluptatum vel reprehenderit consectetur, labore expedita nam quia, saepe sapiente maiores ad ipsam sequi totam eum! Autem at velit asperiores eaque error beatae itaque reiciendis aperiam, sunt soluta dicta neque, voluptatum amet, eos voluptatem dolorem corrupti iste iusto deserunt culpa ratione ducimus quis. Modi quia ex sint quisquam perspiciatis iusto totam, distinctio repellendus natus fugiat voluptatum neque maxime laborum? Veniam est quia perferendis, error a aperiam iusto amet quam quibusdam! Facere incidunt totam quidem possimus labore quasi libero unde in eaque similique fugit quod, aliquid excepturi soluta perferendis, iusto esse, non vitae ipsa aperiam fuga. Iure doloribus veritatis expedita optio sequi doloremque nemo quo. Quae dicta error exercitationem. Ab error, reprehenderit deserunt repellat voluptates quo rerum est? A assumenda reiciendis minus, accusantium voluptates nobis rerum maxime impedit quis quidem suscipit nemo perferendis unde cumque harum laudantium, expedita cum consequatur alias, laborum quo repellat mollitia? Praesentium consectetur autem atque in officia reprehenderit dignissimos unde esse, numquam facere assumenda necessitatibus ab deleniti blanditiis perferendis harum neque aliquam. Ex corporis nostrum numquam voluptatum porro doloremque ratione, recusandae aut eius quis dolor facilis adipisci omnis vero doloribus repellat ipsam facere quae, sint ea. Velit ducimus provident culpa quos commodi suscipit ratione saepe reiciendis obcaecati quas delectus, dicta voluptate ex aut. Amet tempora ab deserunt reprehenderit consequuntur dolorem accusamus, tenetur animi nulla commodi dolor magni! Earum tenetur recusandae, fugit dolorum, sint libero perferendis quo vitae quasi ipsam mollitia possimus voluptatibus quia corrupti doloremque. Ad architecto atque eos dignissimos ipsam minus cumque neque amet id debitis nesciunt pariatur mollitia consequatur iste ratione facilis, quis optio eaque repellat! Natus, id?
      </textarea>
    <div class="form-check mt-5">
        <input class="form-check-input" type="checkbox" value="" id="chk_member2" />
        <label class="form-check-label" for="chk_member2">
            위 개인정보 취급방침에 동의하시겠습니까?
        </label>
    </div>
    <div class="mt-5 mb-5 d-flex justify-content-center gap-2">
        <button class="btn btn-primary w-50" id="btn_member">회원가입</button>
        <button class="btn btn-secondary w-50">가입취소</button>
    </div>
    <form action="member_input.php" method="post" name="stipulation_form" style="display: none;">
        <input type="hidden" name="chk" value="0">
    </form>
</main>
<?php
  include "./inc_footer.php";
?>