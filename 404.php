<?php get_header(); ?>

  <main class="main404 l-main404">

    <!-- パンくずリスト -->
    <div class="breadcrumbs-area l-breadcrumbs-area breadcrumbs-area--404 l-breadcrumbs-area--404">
      <div class="breadcrumbs-area__inner inner">
        <nav class="breadcrumbs-area__breadcrumb breadcrumb breadcrumb--white">
          <?php if (function_exists('bcn_display')) : ?>
            <?php bcn_display(); ?>  <!-- 『bcn_display();』という関数がある時のみ表示 (プラグイン『Breadcrumb NavXT』が有効化されている時) -->
          <?php endif; ?>
        </nav>
      </div>
    </div>

    <!-- page404 セクション -->
    <section class="page404 l-page404">
      <div class="page404__bg-icon"><img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/page404_bg-whale.svg" alt="クジラのアイコン"></div>
      <div class="page404__inner inner">
        <h2 class="page404__title">404</h2>
        <p class="page404__text">
          申し訳ありません。<br
          >お探しのページが見つかりません。
        </p>
        <div class="page404__btn-wrap">
          <a href="<?php echo esc_url(home_url('/')); ?>" class="page404__btn btn btn--white">
            Page TOP
            <div class="btn__arrow">
              <svg xmlns="http://www.w3.org/2000/svg" width="42" height="8" viewBox="0 0 42 8" fill="none">
                <path d="M1 7H41L34 1" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
          </a>
        </div>
      </div>
    </section>
  </main>

<?php get_footer(); ?>
