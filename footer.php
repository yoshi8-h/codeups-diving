<?php
// 条件に合致しない場合にのみCTAを表示
if ( !is_404() && !is_page( array('contact', 'thanks') ) ) : ?>
  <!-- CTA (Contact) -->
  <section class="cta l-cta">
    <div class="cta__wrap inner">
      <div class="cta__box">
        <div class="cta__top">
          <div class="cta__head">
            <div class="cta__logo"><img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/logo-blue.png" alt="CodeUps"></div>
          </div>
          <div class="cta__info">
            <div class="cta__texts">
              <address class="cta__address">沖縄県那覇市1-1</address>
              <a href="tel:0120-000-0000" class="cta__tel">TEL:0120-000-0000</a>
              <p class="cta_hours">営業時間:8:30-19:00</p>
              <p class="cta__holiday">定休日:毎週火曜日</p>
            </div>
            <div class="cta__map">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d114545.97172485772!2d127.52880846795!3d26.210935295079327!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x34e5697141a6b58b%3A0x2cd8aff616585e98!2z5rKW57iE55yM6YKj6KaH5biC!5e0!3m2!1sja!2sjp!4v1714639154821!5m2!1sja!2sjp" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>
        </div>
        <div class="cta__divide"></div>
        <div class="cta__contact contact">
          <h2 class="contact__heading section-head">
            <span class="section-head__title section-head__title--contact">Contact</span>
            <span class="section-head__subtitle section-head__subtitle--contact">お問い合わせ</span>
          </h2>
          <p class="contact__message">ご予約・お問い合わせはコチラ</p>
          <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="contact__btn btn">
            Contact us
            <div class="btn__arrow">
              <svg xmlns="http://www.w3.org/2000/svg" width="42" height="8" viewBox="0 0 42 8" fill="none">
                <path d="M1 7H41L34 1" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

  <!-- TOPへ戻るボタン -->
  <a href="#" class="top-btn js-top-btn">
    <div class="top-btn__wrap">
      <div class="top-btn__arrow">
        <svg class="top-btn__arrow-sp" xmlns="http://www.w3.org/2000/svg" width="8" height="30" viewBox="0 0 8 30" fill="none">
          <path d="M7 29L7 1L1 8" stroke="#408F95" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <svg class="top-btn__arrow-pc" xmlns="http://www.w3.org/2000/svg" width="8" height="42" viewBox="0 0 8 42" fill="none">
          <path d="M7 41L7 1L1 8" stroke="#408F95" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
    </div>
  </a>

  <!-- footer -->
  <footer class="footer l-footer <?php echo is_404() ? 'l-footer--404' : ''; ?>">
    <div class="footer__inner inner">
      <div class="footer__top">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="footer__logo"><img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/logo.png" alt="CodeUps"></a>
        <div class="footer__sns-wrap">
          <a href="https://www.facebook.com/" target="_blank" class="footer__sns"><img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/facebook-logo.png" alt="facebookのロゴ"></a>
          <a href="https://www.instagram.com/" target="_blank" class="footer__sns"><img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/instagram-logo.png" alt="instagramのロゴ"></a>
        </div>
      </div>
      <div class="footer__menu">
        <div class="footer__left">
          <div class="footer__block-pc">
            <div class="footer__link footer-link">
              <a href="<?php echo esc_url(get_post_type_archive_link('campaign')); ?>" class="footer-link__main">
                <div class="footer-link__icon"><img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/starfish.png" alt="ヒトデのアイコン"></div>
                <p class="footer-link__text">キャンペーン</p>
              </a>
              <div class="footer-link__details">
                <?php
                //　カスタム投稿タイプ『campaign』にカテゴリ(タクソノミー)が追加される度に、そのタクソノミーの一覧ページへのリンクが生成されるようにする。
                  // カスタムタクソノミーのカテゴリを取得
                  $terms = get_terms(array(
                    'taxonomy' => 'campaign_category',
                    'hide_empty' => false,
                  ));

                  // 取得したカテゴリが存在する場合、リンクを生成
                  if (!empty($terms) && !is_wp_error($terms)) {
                    foreach ($terms as $term) {
                      // 各カテゴリのリンクを出力
                      echo '<a href="' . esc_url(get_term_link($term)) . '" class="footer-link__detail">' . esc_html($term->name) . '</a>';
                    }
                  }
                ?>
              </div>
            </div>
            <div class="footer__link footer-link">
              <a href="<?php echo esc_url(get_permalink(get_page_by_path('about-us'))); ?>" class="footer-link__main">
                <div class="footer-link__icon"><img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/starfish.png" alt="ヒトデのアイコン"></div>
                <p class="footer-link__text">私たちについて</p>
              </a>
            </div>
          </div>
          <div class="footer__block-pc">
            <div class="footer__link footer-link">
              <a href="<?php echo esc_url(get_permalink(get_page_by_path('information'))); ?>" class="footer-link__main">
                <div class="footer-link__icon"><img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/starfish.png" alt="ヒトデのアイコン"></div>
                <p class="footer-link__text">ダイビング情報</p>
              </a>
              <div class="footer-link__details">
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('information'))); ?>?category=category1" class="footer-link__detail">ライセンス講習</a>
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('information'))); ?>?category=category3" class="footer-link__detail">体験ダイビング</a>
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('information'))); ?>?category=category2" class="footer-link__detail">ファンダイビング</a>
              </div>
            </div>
            <div class="footer__link footer-link">
              <a href="<?php echo esc_url(get_permalink(get_page_by_path('blog'))); ?>" class="footer-link__main">
                <div class="footer-link__icon"><img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/starfish.png" alt="ヒトデのアイコン"></div>
                <p class="footer-link__text">ブログ</p>
              </a>
            </div>
          </div>
        </div>
        <div class="footer__right">
          <div class="footer__block-pc">
            <div class="footer__link footer-link">
              <a href="<?php echo esc_url(get_post_type_archive_link('voice')); ?>" class="footer-link__main">
                <div class="footer-link__icon"><img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/starfish.png" alt="ヒトデのアイコン"></div>
                <p class="footer-link__text">お客様の声</p>
              </a>
            </div>
            <div class="footer__link footer-link">
              <a href="<?php echo esc_url(get_permalink(get_page_by_path('price'))); ?>" class="footer-link__main">
                <div class="footer-link__icon"><img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/starfish.png" alt="ヒトデのアイコン"></div>
                <p class="footer-link__text">料金一覧</p>
              </a>
              <div class="footer-link__details">
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('price'))); ?>#price-page__license" class="footer-link__detail">ライセンス講習</a>
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('price'))); ?>#price-page__experience" class="footer-link__detail">体験ダイビング</a>
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('price'))); ?>#price-page__fun" class="footer-link__detail">ファンダイビング</a>
              </div>
            </div>
          </div>
          <div class="footer__block-pc">
            <div class="footer__link footer-link">
              <a href="<?php echo esc_url(get_permalink(get_page_by_path('faq'))); ?>" class="footer-link__main">
                <div class="footer-link__icon"><img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/starfish.png" alt="ヒトデのアイコン"></div>
                <p class="footer-link__text">よくある質問</p>
              </a>
            </div>
            <div class="footer__link footer-link">
              <a href="<?php echo esc_url(get_permalink(get_page_by_path('privacypolicy'))); ?>" class="footer-link__main">
                <div class="footer-link__icon"><img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/starfish.png" alt="ヒトデのアイコン"></div>
                <p class="footer-link__text">プライバシー<br>ポリシー</p>
              </a>
            </div>
            <div class="footer__link footer-link">
              <a href="<?php echo esc_url(get_permalink(get_page_by_path('terms-of-service'))); ?>" class="footer-link__main">
                <div class="footer-link__icon"><img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/starfish.png" alt="ヒトデのアイコン"></div>
                <p class="footer-link__text">利用規約</p>
              </a>
            </div>
            <div class="footer__link footer-link">
              <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="footer-link__main">
                <div class="footer-link__icon"><img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/starfish.png" alt="ヒトデのアイコン"></div>
                <p class="footer-link__text">お問い合わせ</p>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <small class="footer__copyright">Copyright © 2021 - 2023 CodeUps LLC. All Rights Reserved.</small>
  </footer>

  <?php wp_footer(); ?>
</body>
</html>
