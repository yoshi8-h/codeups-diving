<?php get_header(); ?>

  <main class="main">
    <!-- fv2 -->
    <div class="fv2 l-fv2 fv2--about">
      <div class="fv2__inner">
        <p class="fv2__text">About us</p>
      </div>
    </div>

    <!-- パンくずリスト -->
    <div class="breadcrumbs-area l-breadcrumbs-area">
      <?php get_template_part('parts/breadcrumb'); ?>  <!-- 拡張子「.php」は不要。相対パスではないので先頭に「./」不要。 -->
    </div>

    <!-- about セクション -->
    <section class="about l-about l-about--2 about--2">
      <div class="about__inner inner">
        <div class="about__contents">
          <div class="about__images">
            <picture class="about__img-left">
              <source media="(min-width: 768px)" srcset="<?php echo get_theme_file_uri(); ?>/assets/images/top/about-left-pc.jpg">
              <img src="<?php echo get_theme_file_uri(); ?>/assets/images/top/about-left.jpg" alt="about1">
            </picture>
            <picture class="about__img-right">
              <source media="(min-width: 768px)" srcset="<?php echo get_theme_file_uri(); ?>/assets/images/top/about-right-pc.jpg">
              <img src="<?php echo get_theme_file_uri(); ?>/assets/images/top/about-right.jpg" alt="about2">
            </picture>
            <p class="about__top-sp">
              Dive into<br
              >the Ocean
            </p>
          </div>
          <div class="about__texts">
            <p class="about__top">
              Dive into<br
              >the Ocean
            </p>
            <div class="about__bottom">
              <p class="about__description">
                ここにテキストが入ります。ここにテキストが入ります。ここにテキストが入ります。ここにテキストが入ります。<br
                >ここにテキストが入ります。ここにテキストが入ります。ここにテキストが入ります。ここにテキストが入ります。ここにテキスト
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- gallery セクション -->
    <section class="gallery l-gallery">
      <div class="gallery__inner inner">
        <div class="gallery__heading section-head">
          <span class="section-head__title">Gallery</span>
          <h2 class="section-head__subtitle">フォト</h2>
        </div>
        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : ?>
            <?php the_post(); ?>
            <div class="gallery__grid grid">

              <?php
              // SCFの繰り返しフィールド「about-us_gallery」からデータを取得
              $gallery = SCF::get('about-us_gallery');

              // 繰り返しフィールドが存在する場合のみ出力
              if ($gallery) :
                foreach ($gallery as $index => $fields) :
                  // 各画像のIDを取得（gallery_photoが画像IDであると仮定）
                  $photo_id = $fields['gallery_photo'];

                  // 画像URLを取得
                  $photo_url = wp_get_attachment_url($photo_id);

                  // 画像を表示（画像サイズ 'large' を指定）
                  $photo_img = wp_get_attachment_image($photo_id, 'large');
              ?>
              <div class="grid__item js-modal-open">
                <picture class="grid__item-img">
                  <source media="(min-width: 768px)" srcset="<?php echo esc_url($photo_url); ?>">
                  <?php echo $photo_img; // 画像を出力 ?>
                </picture>
              </div>
              <?php endforeach;
                else : ?>
                <p>ギャラリー画像がありません。</p>
              <?php endif; ?>

            </div>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
    </section>

    <!-- モーダル (gallery セクション の) -->
    <div class="modal">
      <img class="modal__img" src="" alt="ギャラリー画像(モーダル)" />
    </div>

  </main>

<?php get_footer(); ?>
