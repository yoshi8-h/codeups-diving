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
/* トップへ戻るボタン */
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
/* タブの切り替え (campaign-page セクション) */
// 初期値(ページリロード時)は『all』のタブが選択されている状態にして、全てのコンテンツが表示されるように。
// クリックされたタブ(選択されているタブ)に『.is-selected』クラスを付与して選択中のタブのスタイルのみ変更。
// クリックされたタブ(選択されているタブ)の『data-category』属性の値と同じ『data-category』属性の値を持つコンテンツのみ表示。
// document.addEventListener('DOMContentLoaded', function() {
//   // タブボタンとコンテンツを取得
//   const tabButtons = document.querySelectorAll('.tab');
//   const tabContents = document.querySelectorAll('.tab-content');

//   // 初期表示設定：「ALL」タブとすべてのコンテンツを表示
//   const initialTab = document.querySelector('.tab[data-category="all"]');
//   initialTab.classList.add('is-selected'); // 「ALL」タブに選択クラスを追加
//   tabContents.forEach(content => {
//       content.classList.add('active'); // すべてのコンテンツを表示
//   });

//   // タブボタンのクリックイベントを設定
//   tabButtons.forEach(button => {
//       button.addEventListener('click', function() {
//           // クリックされたタブのカテゴリーを取得
//           const category = this.getAttribute('data-category');

//           // すべてのタブから選択クラスを削除
//           tabButtons.forEach(btn => {
//               btn.classList.remove('is-selected');
//           });

//           // クリックされたタブに選択クラスを追加
//           this.classList.add('is-selected');

//           // すべてのコンテンツを非表示にする
//           tabContents.forEach(content => {
//               content.classList.remove('active');
//           });

//           if (category === 'all') {
//               // 「ALL」がクリックされた場合、すべてのコンテンツを表示
//               tabContents.forEach(content => {
//                   content.classList.add('active');
//               });
//           } else {
//               // 対応するカテゴリーのコンテンツを表示
//               document.querySelectorAll(`.tab-content[data-category="${category}"]`).forEach(content => {
//                   content.classList.add('active');
//               });
//           }
//       });
//   });
// });



/* -------------------------------------------------------------------------------- */
/* モーダル (gallery セクション) */
// 開閉の際にアニメーションを付与。
// 画面のどこかをタップしたら、モーダルが閉じる仕様に。

// // モーダルを開く処理
// document.querySelectorAll(".js-modal-open").forEach(function(button) {
//   button.addEventListener("click", function(e) {
//     e.preventDefault();
//     var modalNumber = this.getAttribute("data-modal");
//     var modal = document.querySelector(".js-gallery-modal-" + modalNumber);
//     modal.showModal();
//     modal.classList.add("is-visible");  // クラスを追加してアニメーションを適用
//     document.documentElement.classList.add("is-fixed");

//     // モーダルの枠外をクリックした時の処理を追加
//     modal.addEventListener('click', function(event) {
//       if (event.target === modal) {
//         closeModal(modal);
//       }
//     });
//   });
// });

// // モーダルを閉じる時のアニメーション処理
// function closeModal(modal) {
//   modal.classList.remove("is-visible");  // クラスを削除してアニメーションを適用
//   // アニメーションが終わるのを待ってからモーダルを閉じる
//   setTimeout(function() {
//     modal.close();
//   }, 200);  // アニメーションの時間と同じに設定
//   document.documentElement.classList.remove("is-fixed");
// }


/* -------------------------------------------------------------------------------- */
/* モーダル (gallery セクション) */
// 開閉時のアニメーションはなし。
// 画面のどこかをタップしたら、モーダルが閉じる仕様に。
// モーダルが開いている間は、スクロール不可に。

document.addEventListener("DOMContentLoaded", function() {
  // モーダルとその要素をクラスで取得
  const modal = document.querySelector(".modal");
  const modalImage = document.querySelector(".modal__img");

  // すべての .js-modal-open を取得
  const galleryItems = document.querySelectorAll(".js-modal-open");

  // 各アイテムにクリックイベントを設定
  galleryItems.forEach(item => {
    item.addEventListener("click", function() {
      const img = item.querySelector("img"); // クリックした要素内のimgタグを取得
      const imgSrc = img.getAttribute("src"); // そのimgタグのsrc属性を取得

      // モーダルの画像をクリックされた画像に設定
      modalImage.setAttribute("src", imgSrc);

      // モーダルを表示
      modal.style.display = "block";

      // モーダルが開いている間はスクロールを無効に
      document.body.classList.add("modal__open");
    });
  });

  // モーダル全体をクリックで閉じる処理
  modal.addEventListener("click", function() {
    modal.style.display = "none";

    // モーダルを閉じたらスクロールを有効に戻す
    document.body.classList.remove("modal__open");
  });
});


/* -------------------------------------------------------------------------------- */
/* タブの切り替え (info セクション) */
// クリックされたタブ(選択されているタブ)に『.is-selected』クラスを付与して選択中のタブのスタイルのみ変更。
// クリックされたタブ(選択されているタブ)の『data-category』属性の値と同じ『data-category』属性の値を持つコンテンツのみ表示。
// footerなどのリンクからタブに飛んだ時に、そのタブが選択状態にされた形で『information.html』に遷移する。
document.addEventListener('DOMContentLoaded', function() {
  const tabButtons = document.querySelectorAll('.tab2');
  const tabContents = document.querySelectorAll('.js-tab-content');

  // URLからクエリパラメータ（category）を取得
  const params = new URLSearchParams(window.location.search);
  const categoryFromUrl = params.get('category');

  let activeCategory = categoryFromUrl; // URLのcategoryを優先
  let initialTab;

  if (!activeCategory) {
    // URLにcategoryパラメータがない場合は最初のタブをデフォルトで表示
    initialTab = tabButtons[0];
    activeCategory = initialTab.getAttribute('data-category');
  } else {
    // URLにcategoryパラメータがある場合、そのcategoryに対応するタブを探す
    initialTab = Array.from(tabButtons).find(tab => tab.getAttribute('data-category') === activeCategory);
    if (!initialTab) {
      // 不正なcategoryの場合はデフォルトで最初のタブを表示
      initialTab = tabButtons[0];
      activeCategory = initialTab.getAttribute('data-category');
    }
  }

  // --- 修正部分: 初期タブの選択をURLパラメータに基づいて行う ---
  tabButtons.forEach(tab => {
    // URLパラメータと一致するタブにのみ 'is-selected' クラスを付与
    if (tab.getAttribute('data-category') === activeCategory) {
      tab.classList.add('is-selected');
    } else {
      tab.classList.remove('is-selected');  // 他のタブは選択を解除
    }
  });

  // 対応するコンテンツの表示設定
  tabContents.forEach(content => {
    if (content.getAttribute('data-category') === activeCategory) {
      content.classList.add('active');  // 対応するコンテンツを表示
    } else {
      content.classList.remove('active');  // 他のコンテンツは非表示
    }
  });

  // タブクリック時の処理
  tabButtons.forEach(button => {
    button.addEventListener('click', function() {
      const category = this.getAttribute('data-category');

      // すべてのタブから選択クラスを削除
      tabButtons.forEach(btn => btn.classList.remove('is-selected'));

      // クリックされたタブに選択クラスを追加
      this.classList.add('is-selected');

      // すべてのコンテンツを非表示にする
      tabContents.forEach(content => content.classList.remove('active'));

      // 対応するカテゴリーのコンテンツを表示
      document.querySelectorAll(`.js-tab-content[data-category="${category}"]`).forEach(content => {
        content.classList.add('active');
      });
    });
  });
});


/* -------------------------------------------------------------------------------- */
/* サイドバー (sidebar)の、『アーカイブ』の、三角形の向きを制御 */
// 『月別』のアーカイブがある場合のみ、親(年)の三角形の向きを変更 (CSSでも制御)
document.addEventListener('DOMContentLoaded', () => {
  // すべての年の要素を取得
  const archiveParents = document.querySelectorAll('.side-archive__parent');

  archiveParents.forEach(parent => {
    // 年の親要素から、子要素（.side-archive__children）を探す (次の兄弟要素(隣接している要素)を取得)
    const childrenContainer = parent.nextElementSibling;

    // 親要素の隣に要素がある場合かつ、その要素が『.side-archive__children』である場合かつ、その『.side-archive__children』の中に『.side-archive__child』がある場合
    if (childrenContainer && childrenContainer.classList.contains('side-archive__children') && childrenContainer.querySelector('.side-archive__child')) {
      parent.classList.add('has-children');
    }
  });
});


/* -------------------------------------------------------------------------------- */
/* アコーディオン (faq セクション) */
jQuery(".js-accordion").on("click", function (e) {
  e.preventDefault();

  if (jQuery(this).parent().hasClass("is-open")) {
    jQuery(this).parent().removeClass("is-open");
    jQuery(this).next().slideUp();
  } else {
    jQuery(this).parent().addClass("is-open");
    jQuery(this).next().slideDown();
  }
});


/* -------------------------------------------------------------------------------- */
/* 『お問い合わせフォーム』のバリデーション */
document.querySelector('.form').addEventListener('submit', function(event) {
  event.preventDefault(); // デフォルト送信をキャンセル

  let isValid = true;

  // エラーメッセージの削除
  const errorMessage = document.querySelector('.form__error-message');
  if (errorMessage) {
    errorMessage.remove();
  }

  // 必須項目のチェック
  const requiredFields = document.querySelectorAll('.js-form-input[required]');
  requiredFields.forEach(function(field) {
    if (!field.value.trim()) {
      isValid = false;
      field.classList.add('is-error');  // エラークラスを追加
    } else {
      field.classList.remove('is-error');  // エラークラスを削除
    }
  });

  // お問い合わせ項目（どれか1つがチェックされているか確認）
  const categoryCheckboxes = document.querySelectorAll('input[name="your-category"].checkbox__input');
  const isAnyCategoryChecked = Array.from(categoryCheckboxes).some(checkbox => checkbox.checked);

  if (!isAnyCategoryChecked) {
    isValid = false;
    categoryCheckboxes.forEach(checkbox => checkbox.classList.add('is-error')); // すべてのチェックボックスにエラークラスを追加
  } else {
    categoryCheckboxes.forEach(checkbox => checkbox.classList.remove('is-error')); // エラーがなければクラスを削除
  }

  // 同意チェックボックスのバリデーション
  const agreeCheckbox = document.querySelector('input.agree-checkbox__input');
  if (!agreeCheckbox.checked) {
    isValid = false;
    agreeCheckbox.classList.add('is-error'); // エラークラスを追加
  } else {
    agreeCheckbox.classList.remove('is-error'); // エラークラスを削除
  }

  // エラーメッセージの表示
  if (!isValid) {
    const errorDiv = document.createElement('div');
    errorDiv.classList.add('form__error-message');
    errorDiv.style.color = '#C94800';
    errorDiv.innerText = '※必須項目が入力されていません。入力してください。';
    document.querySelector('.form').insertBefore(errorDiv, document.querySelector('.form').firstChild);
  } else {
    event.target.submit();  // バリデーションに成功した場合のみフォームを送信
  }
});


