// jQuery(function ($) {  // この中であればWordpressでも「$」が使用可能になる
// });


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
  document.body.classList.toggle("is-fixed");  // bodyタグにも適用
});
