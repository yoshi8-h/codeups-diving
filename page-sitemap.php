<?php get_header(); ?>

  <main class="main">
    <!-- fv2 -->
    <div class="fv2 l-fv2 fv2--sitemap">
      <div class="fv2__inner">
        <p class="fv2__text">Site MAP</p>
      </div>
    </div>

    <!-- パンくずリスト -->
    <div class="breadcrumbs-area l-breadcrumbs-area">
      <?php get_template_part('parts/breadcrumb'); ?>  <!-- 拡張子「.php」は不要。相対パスではないので先頭に「./」不要。 -->
    </div>

    <!-- sitemap セクション -->
    <section class="sitemap l-sitemap">
      <div class="sitemap__inner inner">
        <div class="sitemap__menu menu">
          <div class="menu__left">
            <div class="menu__block-pc">
              <div class="menu__link menu-link">
                <a href="./campaign.html" class="menu-link__main">
                  <div class="menu-link__icon"><img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/starfish-black.png" alt="ヒトデのアイコン"></div>
                  <p class="menu-link__text">キャンペーン</p>
                </a>
                <div class="menu-link__details">
                  <a href="./campaign.html" class="menu-link__detail">ライセンス取得</a>
                  <a href="./campaign.html" class="menu-link__detail">貸切体験ダイビング</a>
                  <a href="./campaign.html" class="menu-link__detail">ナイトダイビング</a>
                </div>
              </div>
              <div class="menu__link menu-link">
                <a href="./about.html" class="menu-link__main">
                  <div class="menu-link__icon"><img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/starfish-black.png" alt="ヒトデのアイコン"></div>
                  <p class="menu-link__text">私たちについて</p>
                </a>
              </div>
            </div>
            <div class="menu__block-pc">
              <div class="menu__link menu-link">
                <a href="./information.html" class="menu-link__main">
                  <div class="menu-link__icon"><img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/starfish-black.png" alt="ヒトデのアイコン"></div>
                  <p class="menu-link__text">ダイビング情報</p>
                </a>
                <div class="menu-link__details">
                  <a href="./information.html" class="menu-link__detail">ライセンス講習</a>
                  <a href="./information.html" class="menu-link__detail">体験ダイビング</a>
                  <a href="./information.html" class="menu-link__detail">ファンダイビング</a>
                </div>
              </div>
              <div class="menu__link menu-link">
                <a href="./blog.html" class="menu-link__main">
                  <div class="menu-link__icon"><img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/starfish-black.png" alt="ヒトデのアイコン"></div>
                  <p class="menu-link__text">ブログ</p>
                </a>
              </div>
            </div>
          </div>
          <div class="menu__right">
            <div class="menu__block-pc">
              <div class="menu__link menu-link">
                <a href="./voice.html" class="menu-link__main">
                  <div class="menu-link__icon"><img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/starfish-black.png" alt="ヒトデのアイコン"></div>
                  <p class="menu-link__text">お客様の声</p>
                </a>
              </div>
              <div class="menu__link menu-link">
                <a href="./price.html" class="menu-link__main">
                  <div class="menu-link__icon"><img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/starfish-black.png" alt="ヒトデのアイコン"></div>
                  <p class="menu-link__text">料金一覧</p>
                </a>
                <div class="menu-link__details">
                  <a href="./price.html#price-page__license" class="menu-link__detail">ライセンス講習</a>
                  <a href="./price.html#price-page__experience" class="menu-link__detail">体験ダイビング</a>
                  <a href="./price.html#price-page__fun" class="menu-link__detail">ファンダイビング</a>
                </div>
              </div>
            </div>
            <div class="menu__block-pc">
              <div class="menu__link menu-link">
                <a href="./faq.html" class="menu-link__main">
                  <div class="menu-link__icon"><img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/starfish-black.png" alt="ヒトデのアイコン"></div>
                  <p class="menu-link__text">よくある質問</p>
                </a>
              </div>
              <div class="menu__link menu-link">
                <a href="./privacy.html" class="menu-link__main">
                  <div class="menu-link__icon"><img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/starfish-black.png" alt="ヒトデのアイコン"></div>
                  <p class="menu-link__text">プライバシー<br>ポリシー</p>
                </a>
              </div>
              <div class="menu__link menu-link">
                <a href="./terms.html" class="menu-link__main">
                  <div class="menu-link__icon"><img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/starfish-black.png" alt="ヒトデのアイコン"></div>
                  <p class="menu-link__text">利用規約</p>
                </a>
              </div>
              <div class="menu__link menu-link">
                <a href="./contact.html" class="menu-link__main">
                  <div class="menu-link__icon"><img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/starfish-black.png" alt="ヒトデのアイコン"></div>
                  <p class="menu-link__text">お問い合わせ</p>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

<?php get_footer(); ?>
