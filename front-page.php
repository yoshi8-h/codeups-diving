<?php get_header(); ?>

  <main class="main">
    <!-- fv -->
    <div class="fv">
      <div class="fv__wrap">
        <?php
        // グループフィールド「top_1」の内容を取得
        $top_group = get_field('top_1');
        // 画像スライドを格納する配列
        $slides = [];
        // グループフィールドが存在する場合にループ処理を実行
        if ($top_group) {
            for ($i = 2; $i <= 5; $i++) {
                // グループ内のサブフィールドからURLを取得
                $field_name = 'top_' . $i;
                if (!empty($top_group[$field_name])) {
                    $slides[] = $top_group[$field_name];
                }
            }
        }

        // スライドに画像が1枚以上ある場合のみ表示
        if (!empty($slides)) : ?>
          <div class="fv__swiper swiper js-fv-swiper">
            <div class="fv__swiper-wrapper swiper-wrapper">
              <?php foreach ($slides as $index => $slide_url) : ?>
                <div class="fv__swiper-slide swiper-slide">
                  <div class="fv__slide-item">
                    <picture class="fv__slide-img">
                      <source media="(min-width: 768px)" srcset="<?php echo esc_url($slide_url); ?>">
                      <img src="<?php echo esc_url($slide_url); ?>" alt="fv-slide<?php echo $index + 1; ?>">
                    </picture>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>
      </div>
      <div class="fv__text">
        <h2 class="fv__title">DIVING</h2>
        <p class="fv__subtitle">into the ocean</p>
      </div>
    </div>

    <!-- Campaign セクション -->
    <section class="campaign l-campaign">
      <div class="campaign__inner inner">
        <div class="campaign__wrap">
          <div class="campaign__heading section-head">
            <span class="section-head__title">Campaign</span>
            <h2 class="section-head__subtitle">キャンペーン</h2>
          </div>
          <div class="campaign__contents">
            <div class="campaign__swiper swiper js-campaign-swiper">  <!-- /swiper -->
              <div class="campaign__cards cards swiper-wrapper">
                <?php
                  // カスタム投稿タイプ 'campaign' の最新10件を取得するクエリ
                  $args = array(
                    'post_type' => 'campaign',  // カスタム投稿タイプのスラッグ
                    'posts_per_page' => 10,     // 取得する投稿数を10件に制限
                    'orderby' => 'date',        // 日付でソート（最新順）
                    'order' => 'DESC'           // 降順に並べる（最新の投稿から表示）
                  );
                  $campaign_query = new WP_Query($args);
                ?>
                <?php if ($campaign_query->have_posts()) : ?>
                  <?php while ($campaign_query->have_posts()) : ?>
                    <?php $campaign_query->the_post(); ?>

                    <div class="cards__item card swiper-slide">
                      <div class="card__wrap">
                        <div class="card__img">
                          <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>のアイキャッチ画像">
                          <?php else : ?>
                            <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/noimg.png" alt="no-image">
                          <?php endif; ?>
                        </div>
                        <div class="card__body">
                          <div class="card__top">
                            <?php
                            // タクソノミー 'campaign_category' のターム（カテゴリー）を取得し、配列に格納
                            $terms = get_the_terms(get_the_ID(), 'campaign_category');
                            // タームがある場合かつ、エラーでないは、カテゴリー名を表示
                            if ($terms && !is_wp_error($terms)) :
                              foreach ($terms as $term) : ?>
                                <p class="card__category category"><?php echo esc_html($term->name); ?></p>
                              <?php endforeach;
                            else : ?>
                              <p class="card__category category">カテゴリーなし</p>
                            <?php endif; ?>
                            <p class="card__title title"><?php the_title(); ?></p>
                          </div>
                          <div class="card__bottom">
                            <p class="card__fee-description">全部コミコミ(お一人様)</p>
                            <div class="card__fee-area">
                              <?php if (get_field('campaign_1')): ?>
                                <span class="card__fee-old">¥<?php the_field('campaign_1'); ?></span>
                              <?php endif; ?>
                              <?php if (get_field('campaign_2')): ?>
                                <span class="card__fee-current">¥<?php the_field('campaign_2'); ?></span>
                              <?php endif; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  <?php endwhile; ?>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>

              </div>
            </div>
          </div>
          <div class="campaign__arrows">  <!-- swiperの「前へ」「次へ」ボタン -->
            <div class="campaign__prev swiper-button-prev js-campaign-prev">
              <div class="campaign__prev-img">
                <svg xmlns="http://www.w3.org/2000/svg" width="42" height="8" viewBox="0 0 42 8" fill="none">
                  <path d="M41 7H1L8 1" stroke="#408F95" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
            </div>
            <div class="campaign__next swiper-button-next js-campaign-next">
              <div class="campaign__next-img">
                <svg xmlns="http://www.w3.org/2000/svg" width="42" height="8" viewBox="0 0 42 8" fill="none">
                  <path d="M1 7H41L34 1" stroke="#408F95" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
            </div>
          </div>
          <div class="campaign__btn-wrap">
            <a href="<?php echo esc_url(get_post_type_archive_link('campaign')); ?>" class="campaign__btn btn">
              View more
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

    <!-- About us セクション -->
    <section class="about l-about">
      <div class="about__inner inner">
        <div class="about__heading section-head">
          <span class="section-head__title">About us</span>
          <h2 class="section-head__subtitle">私たちについて</h2>
        </div>
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
              <div class="about__btn-wrap">
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('about-us'))); ?>" class="about__btn btn">
                  View more
                  <div class="btn__arrow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="42" height="8" viewBox="0 0 42 8" fill="none">
                      <path d="M1 7H41L34 1" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Information セクション -->
    <section class="information l-information">
      <div class="information__inner inner">
        <div class="information__heading section-head">
          <span class="section-head__title">Information</span>
          <h2 class="section-head__subtitle">ダイビング情報</h2>
        </div>
        <div class="information__contents">
          <div class="information__img js-img-colorbox"><img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/information-1.jpg" alt="information1"></div>
          <div class="information__texts">
            <p class="information__title title">ライセンス講習</p>
            <p class="information__message">
              当店はダイビングライセンス（Cカード）世界最大の教育機関PADIの「正規店」として店舗登録されています。<br
              >正規登録店として、初めての方でも安心安全にライセンス取得をサポート致します。
            </p>
            <div class="information__btn-wrap">
              <a href="<?php echo esc_url(get_permalink(get_page_by_path('information'))); ?>" class="information__btn btn">
                View more
                <div class="btn__arrow">
                  <svg xmlns="http://www.w3.org/2000/svg" width="42" height="8" viewBox="0 0 42 8" fill="none">
                    <path d="M1 7H41L34 1" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Blog セクション -->
    <section class="blog">
      <div class="blog__inner inner">
        <div class="blog__heading section-head">
          <span class="section-head__title section-head__title--white">Blog</span>
          <h2 class="section-head__subtitle section-head__subtitle--white">ブログ</h2>
        </div>
        <div class="blog__posts posts">
          <?php
            // 通常の投稿タイプから最新3件を取得
            $args = array(
              'post_type' => 'post',       // 通常の投稿タイプ
              'posts_per_page' => 3,       // 取得する投稿数を3件に制限
              'orderby' => 'date',         // 日付でソート
              'order' => 'DESC'            // 降順で表示（最新投稿が先）
            );
            $blog_query = new WP_Query($args);
          ?>

          <?php if ($blog_query->have_posts()) : ?>
            <?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>

              <a href="<?php the_permalink(); ?>" class="posts__item post">
                <div class="post__wrap">
                  <div class="post__img">
                    <?php if (has_post_thumbnail()) : ?>
                      <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>のサムネイル画像">
                    <?php else : ?>
                      <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/noimg.png" alt="no-image">
                    <?php endif; ?>
                  </div>
                  <div class="post__meta">
                    <time class="post__date" datetime="<?php the_time('c'); ?>"><?php the_time('Y.m/d'); ?></time>
                    <p class="post__title title"><?php the_title(); ?></p>
                  </div>
                  <p class="post__text">
                    <?php
                      // 投稿の抜粋を表示する。抜粋がない場合は、自動的に投稿内容の一部が表示される。40字を超えると「...」が表示される。
                      echo wp_trim_words(get_the_excerpt(), 80, '...');
                    ?>
                  </p>
                </div>
              </a>

            <?php endwhile; ?>
          <?php endif; ?>
          <?php wp_reset_postdata(); ?>
        </div>
        <div class="blog__btn-wrap">
          <a href="<?php echo esc_url(get_permalink(get_page_by_path('blog'))); ?>" class="blog__btn btn">
            View more
            <div class="btn__arrow">
              <svg xmlns="http://www.w3.org/2000/svg" width="42" height="8" viewBox="0 0 42 8" fill="none">
                <path d="M1 7H41L34 1" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
          </a>
        </div>
      </div>
    </section>

    <!-- Voice セクション -->
    <section class="voice l-voice">
      <div class="voice__inner inner">
        <div class="voice__heading section-head">
          <span class="section-head__title">Voice</span>
          <h2 class="section-head__subtitle">お客様の声</h2>
        </div>
        <div class="voice__posts posts2">
          <?php
            // カスタム投稿タイプ 'voice' の最新2件を取得するクエリ
            $args = array(
              'post_type' => 'voice',  // カスタム投稿タイプ 'voice'
              'posts_per_page' => 2,  // 表示件数を2件に設定
              'orderby' => 'date',  // 日付で並び替え
              'order' => 'DESC'  // 最新順に表示
            );
            $voice_query = new WP_Query($args);
          ?>

          <?php if ($voice_query->have_posts()) : ?>
            <?php while ($voice_query->have_posts()) : $voice_query->the_post(); ?>

              <div class="posts2__item post2">
                <div class="post2__wrap">
                  <div class="post2__top">
                    <div class="post2__meta">
                      <div class="post2__meta-top">
                        <span class="post2__info"><?php the_field('voice_1'); ?></span>
                        <?php
                        // タクソノミー 'voice_category' のターム（カテゴリー）を取得
                        $terms = get_the_terms(get_the_ID(), 'voice_category');
                        if ($terms && !is_wp_error($terms)) :
                          foreach ($terms as $term) : ?>
                            <p class="post2__category category"><?php echo esc_html($term->name); ?></p>
                          <?php endforeach;
                        else : ?>
                          <p class="post2__category category">カテゴリーなし</p>
                        <?php endif; ?>
                      </div>
                      <p class="post2__title title"><?php the_title(); ?></p>
                    </div>
                    <div class="post2__img js-img-colorbox">
                      <?php if (has_post_thumbnail()) : ?>
                        <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>のアイキャッチ画像">
                      <?php else : ?>
                        <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/noimg.png" alt="no-image">
                      <?php endif; ?>
                    </div>
                  </div>
                  <?php if (get_field('voice_2')): ?>
                    <p class="post2__text"><?php the_field('voice_2'); ?></p>
                  <?php endif; ?>
                </div>
              </div>

            <?php endwhile; ?>
          <?php endif; ?>
          <?php wp_reset_postdata(); ?> <!-- クエリのリセット -->
        </div>

        <div class="voice__btn-wrap">
          <a href="<?php echo esc_url(get_post_type_archive_link('voice')); ?>" class="voice__btn btn">
            View more
            <div class="btn__arrow">
              <svg xmlns="http://www.w3.org/2000/svg" width="42" height="8" viewBox="0 0 42 8" fill="none">
                <path d="M1 7H41L34 1" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
          </a>
        </div>
      </div>
    </section>

    <!-- Price セクション -->
    <section class="price l-price">
      <div class="price__inner inner">
        <div class="price__heading section-head">
          <span class="section-head__title">Price</span>
          <h2 class="section-head__subtitle">料金一覧</h2>
        </div>
        <div class="price__contents">
          <picture class="price__img js-img-colorbox">
            <source media="(min-width: 768px)" srcset="<?php echo get_theme_file_uri(); ?>/assets/images/top/pc/price-pc.jpg">
            <img src="<?php echo get_theme_file_uri(); ?>/assets/images/top/sp/price-sp.jpg" alt="price-img">
          </picture>
          <div class="price__lists">
            <div class="price__list">
              <p class="price__list-title title">ライセンス講習</p>
              <div class="price__products">
                <?php
                // 『page-price.php』の固定ページ ID を指定してデータを取得
                $page_id = 13; // page-price.php の ID を設定
                $price_table_1 = SCF::get('price-table_1', $page_id);

                // データがある場合のみループ処理
                if ($price_table_1) :
                  foreach ($price_table_1 as $row) :
                    // 項目名と価格を取得
                    $item_name = isset($row['table-item_name_1']) ? esc_html($row['table-item_name_1']) : '項目名なし';
                    $item_price = isset($row['table-item_price_1']) ? number_format((int)preg_replace('/[^0-9]/', '', $row['table-item_price_1'])) : '0';  // 価格を数値として取得、数値以外の文字があれば除去
                ?>
                  <div class="price__product">
                    <div class="price__product-name"><?php echo nl2br($item_name); ?></div>
                    <p class="price__price">¥<?php echo $item_price; ?></p>
                  </div>
                <?php endforeach;
                  else :
                ?>
                  <tr class="table__row">
                    <td colspan="2" class="table__cell-text">料金情報がありません。</td>
                  </tr>
                <?php endif; ?>
              </div>
            </div>
            <div class="price__list">
              <p class="price__list-title title">体験ダイビング</p>
              <div class="price__products">
                <?php
                // 『page-price.php』の固定ページ ID を指定してデータを取得
                $page_id = 13; // page-price.php の ID を設定
                $price_table_2 = SCF::get('price-table_2', $page_id);

                // データがある場合のみループ処理
                if ($price_table_2) :
                  foreach ($price_table_2 as $row) :
                    // 項目名と価格を取得
                    $item_name = isset($row['table-item_name_2']) ? esc_html($row['table-item_name_2']) : '項目名なし';
                    $item_price = isset($row['table-item_price_2']) ? number_format((int)preg_replace('/[^0-9]/', '', $row['table-item_price_2'])) : '0';  // 価格を数値として取得、数値以外の文字があれば除去
                ?>
                  <div class="price__product">
                    <div class="price__product-name"><?php echo nl2br($item_name); ?></div>
                    <p class="price__price">¥<?php echo $item_price; ?></p>
                  </div>
                <?php endforeach;
                  else :
                ?>
                  <tr class="table__row">
                    <td colspan="2" class="table__cell-text">料金情報がありません。</td>
                  </tr>
                <?php endif; ?>
              </div>
            </div>
            <div class="price__list">
              <p class="price__list-title title">ファンダイビング</p>
              <div class="price__products">
                <?php
                // 『page-price.php』の固定ページ ID を指定してデータを取得
                $page_id = 13; // page-price.php の ID を設定
                $price_table_3 = SCF::get('price-table_3', $page_id);

                // データがある場合のみループ処理
                if ($price_table_3) :
                  foreach ($price_table_3 as $row) :
                    // 項目名と価格を取得
                    $item_name = isset($row['table-item_name_3']) ? esc_html($row['table-item_name_3']) : '項目名なし';
                    $item_price = isset($row['table-item_price_3']) ? number_format((int)preg_replace('/[^0-9]/', '', $row['table-item_price_3'])) : '0';  // 価格を数値として取得、数値以外の文字があれば除去
                ?>
                  <div class="price__product">
                    <div class="price__product-name"><?php echo nl2br($item_name); ?></div>
                    <p class="price__price">¥<?php echo $item_price; ?></p>
                  </div>
                <?php endforeach;
                  else :
                ?>
                  <tr class="table__row">
                    <td colspan="2" class="table__cell-text">料金情報がありません。</td>
                  </tr>
                <?php endif; ?>
              </div>
            </div>
            <div class="price__list">
              <p class="price__list-title title">スペシャルダイビング</p>
              <div class="price__products">
                <?php
                // 『page-price.php』の固定ページ ID を指定してデータを取得
                $page_id = 13; // page-price.php の ID を設定
                $price_table_4 = SCF::get('price-table_4', $page_id);

                // データがある場合のみループ処理
                if ($price_table_4) :
                  foreach ($price_table_4 as $row) :
                    // 項目名と価格を取得
                    $item_name = isset($row['table-item_name_4']) ? esc_html($row['table-item_name_4']) : '項目名なし';
                    $item_price = isset($row['table-item_price_4']) ? number_format((int)preg_replace('/[^0-9]/', '', $row['table-item_price_4'])) : '0';  // 価格を数値として取得、数値以外の文字があれば除去
                ?>
                  <div class="price__product">
                    <div class="price__product-name"><?php echo nl2br($item_name); ?></div>
                    <p class="price__price">¥<?php echo $item_price; ?></p>
                  </div>
                <?php endforeach;
                  else :
                ?>
                  <tr class="table__row">
                    <td colspan="2" class="table__cell-text">料金情報がありません。</td>
                  </tr>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
        <div class="price__btn-wrap">
          <a href="<?php echo esc_url(get_permalink(get_page_by_path('price'))); ?>" class="price__btn btn">
            View more
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
