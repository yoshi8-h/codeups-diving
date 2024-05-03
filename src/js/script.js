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
document.querySelector("#js-header__btn").addEventListener("click", function (e) {
  e.preventDefault();

  document.querySelector("#js-header__btn").classList.toggle("is-clicked");
  document.querySelector(".header").classList.toggle("is-clicked");
  document.querySelector("#js-drawer-menu").classList.toggle("is-clicked");
  document.documentElement.classList.toggle("is-fixed");  // htmlタグにis-fixedクラスをトグル
  document.body.classList.toggle("is-fixed");  // bodyタグにもis-fixedクラスをトグル
});

/* -------------------------------------------------------------------------------- */
/* swiper (スワイパー) fv */
const fvSwiper = new Swiper("#js-fv-swiper", {
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
const campaignSwiper = new Swiper("#js-campaign-swiper", {
  loop: true,

  slidesPerView: 'auto', // スライドの幅をCSSで指定
  spaceBetween: 24,

  grabCursor: true,  // PCでホバー時にマウスカーソルを「掴む」マークに。

  breakpoints: {
    768: {  // 768px以上の場合 (PC時)
      spaceBetween: 40,
    },
  },

  // Navigation arrows（以下、矢印のオプションの指定）
  navigation: {
    nextEl: '#js-campaign-next',
    prevEl: '#js-campaign-prev',
  },
});

/* -------------------------------------------------------------------------------- */
