jQuery(function ($) {  // この中であればWordpressでも「$」が使用可能になる

  // ハンバーガーメニュー(ドロワー)
  // $('#js-header__btn').on('click',function () {
  //   if($('#js-header__btn').hasClass('is-open')) {
  //     $('#js-header__btn').fadeOut();
  //     $(this).removeClass('is-open');
  //   } else {
  //     $('#js-header__btn').fadeIn();
  //     $(this).addClass('is-open');
  //   }
  // });

});

/* -------------------------------------------------------------------------------- */
/* ハンバーガーメニュー(ドロワー) */
// クリックされた時に『is-checked』クラスを付け外ししてボタンを変形・ドロワーメニューを表示/非表示
// .headerにも『is-checked』クラスを付け外しして背景色を透明に
// 「html,body」に『is-fixed』クラスを付け外ししてドロワーが開いてる時はスクロールを無効に
document.querySelector(".js-header__btn").addEventListener("click", function (e) {
  e.preventDefault();

  document.querySelector(".js-header__btn").classList.toggle("is-clicked");
  document.querySelector(".header").classList.toggle("is-clicked");
  document.querySelector(".js-drawer-menu").classList.toggle("is-clicked");
  document.documentElement.classList.toggle("is-fixed");  // htmlタグにis-fixedクラスをトグル
  document.body.classList.toggle("is-fixed");  // bodyタグにもis-fixedクラスをトグル
});

/* -------------------------------------------------------------------------------- */
/* swiper (スワイパー) fv */
const fvSwiper = new Swiper(".js-fv-swiper", {
  loop: true,
  effect: 'fade',

  speed: 700,  // 切り替わる最中のスピード(ミリ秒)
  autoplay: {  // 自動再生ON
    delay: 4000,  // 次のスライドに切り替わるまでの時間
    disableOnInteraction: false,  // ユーザーがドラッグなどの操作をしても自動再生が止まらないように。
  },
});

/* -------------------------------------------------------------------------------- */
/* swiper (スワイパー) campaignセクション */
const campaignSwiper = new Swiper(".js-campaign-swiper", {
  loop: true,

  slidesPerView: 'auto', // スライドの幅をCSSで指定
  spaceBetween: 24,

  grabCursor: true,  // PCでホバー時にマウスカーソルを「掴む」マークに。

  breakpoints: {
    768: {  // 768px以上の場合 (PC時)
      spaceBetween: 40,
    },
  },

  // Navigation arrows（矢印のオプション指定）
  navigation: {
    nextEl: '.js-campaign-next',
    prevEl: '.js-campaign-prev',
  },
});

/* -------------------------------------------------------------------------------- */
/* 背景色の後に画像やテキストが表示されるエフェクト(アニメーション) */

//要素の取得とスピードの設定
var box = $('.js-img-colorbox'),
  speed = 700;

//.js-img-colorboxの付いた全ての要素に対して下記の処理を行う
box.each(function(){
  $(this).append('<div class="color"></div>')
  var color = $(this).find($('.color')),
  image = $(this).find('img');
  var counter = 0;

  image.css('opacity','0');
  color.css('width','0%');
  //inviewを使って背景色が画面に現れたら処理をする
  color.on('inview', function(){
  if(counter == 0){
    $(this).delay(200).animate({'width':'100%'},speed,function(){
          image.css('opacity','1');
          $(this).css({'left':'0' , 'right':'auto'});
          $(this).animate({'width':'0%'},speed);
        })
      counter = 1;
    }
  });
});

/* -------------------------------------------------------------------------------- */
/* スムーススクロール */
// (ページ上部に固定しているヘッダー(header)の高さも考慮。)
// jQuery('a[href^="#"]').on("click", function(e) {
//   const speed = 400;
//   const id = jQuery(this).attr("href");
//   const target = jQuery("#" == id ? "html" : id);
//   const headerHeight = jQuery('.header').outerHeight();  // ヘッダーの高さを動的に取得
//   const position = jQuery(target).offset().top - headerHeight;  // ヘッダーの高さを考慮

//   jQuery("html, body").animate(
//     {
//       scrollTop: position,
//     },
//     speed,
//     "swing"  // swing or linear
//   );
// });

/* -------------------------------------------------------------------------------- */
// トップへ戻るボタン
// 画面を少し(今回は100px)スクロールした時に表示(通常は非表示)
const pageTop = document.querySelector(".js-top-btn");

window.addEventListener("scroll", function () {
  if (100 < window.scrollY) {  // 100px
    pageTop.classList.add("is-show");
  } else {
    pageTop.classList.remove("is-show");
  }
});



/* -------------------------------------------------------------------------------- */
// タブの切り替え (campaign-page セクション)
// 初期値(ページリロード時)は『all』のタブが選択されている状態にして、全てのコンテンツが表示されるように。
// クリックされたタブ(選択されているタブ)に『.is-selected』クラスを付与して選択中のタブのスタイルのみ変更。
// クリックされたタブ(選択されているタブ)の『data-category』属性の値と同じ『data-category』属性の値を持つコンテンツのみ表示。
document.addEventListener('DOMContentLoaded', function() {
  // タブボタンとコンテンツを取得
  const tabButtons = document.querySelectorAll('.tab');
  const tabContents = document.querySelectorAll('.tab-content');

  // 初期表示設定：「ALL」タブとすべてのコンテンツを表示
  const initialTab = document.querySelector('.tab[data-category="all"]');
  initialTab.classList.add('is-selected'); // 「ALL」タブに選択クラスを追加
  tabContents.forEach(content => {
      content.classList.add('active'); // すべてのコンテンツを表示
  });

  // タブボタンのクリックイベントを設定
  tabButtons.forEach(button => {
      button.addEventListener('click', function() {
          // クリックされたタブのカテゴリーを取得
          const category = this.getAttribute('data-category');

          // すべてのタブから選択クラスを削除
          tabButtons.forEach(btn => {
              btn.classList.remove('is-selected');
          });

          // クリックされたタブに選択クラスを追加
          this.classList.add('is-selected');

          // すべてのコンテンツを非表示にする
          tabContents.forEach(content => {
              content.classList.remove('active');
          });

          if (category === 'all') {
              // 「ALL」がクリックされた場合、すべてのコンテンツを表示
              tabContents.forEach(content => {
                  content.classList.add('active');
              });
          } else {
              // 対応するカテゴリーのコンテンツを表示
              document.querySelectorAll(`.tab-content[data-category="${category}"]`).forEach(content => {
                  content.classList.add('active');
              });
          }
      });
  });
});



/* -------------------------------------------------------------------------------- */
// モーダル (gallery セクション)
// 開閉の際にアニメーションを付与。
// 画面のどこかをタップしたら、モーダルが閉じる仕様に。

// モーダルを開く処理
document.querySelectorAll(".js-modal-open").forEach(function(button) {
  button.addEventListener("click", function(e) {
    e.preventDefault();
    var modalNumber = this.getAttribute("data-modal");
    var modal = document.querySelector(".js-gallery-modal-" + modalNumber);
    modal.showModal();
    modal.classList.add("is-visible");  // クラスを追加してアニメーションを適用
    document.documentElement.classList.add("is-fixed");

    // モーダルの枠外をクリックした時の処理を追加
    modal.addEventListener('click', function(event) {
      if (event.target === modal) {
        closeModal(modal);
      }
    });
  });
});

// モーダルを閉じる時のアニメーション処理
function closeModal(modal) {
  modal.classList.remove("is-visible");  // クラスを削除してアニメーションを適用
  // アニメーションが終わるのを待ってからモーダルを閉じる
  setTimeout(function() {
    modal.close();
  }, 200);  // アニメーションの時間と同じに設定
  document.documentElement.classList.remove("is-fixed");
}
