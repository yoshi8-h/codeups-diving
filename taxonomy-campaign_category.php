<?php get_header(); ?>

  <main class="main">
    <!-- fv2 -->
    <div class="fv2 l-fv2 fv2--campaign">
      <div class="fv2__inner">
        <p class="fv2__text">Campaign</p>
      </div>
    </div>

    <!-- パンくずリスト -->
    <div class="breadcrumbs-area l-breadcrumbs-area">
      <?php get_template_part('parts/breadcrumb'); ?>  <!-- 拡張子「.php」は不要。相対パスではないので先頭に「./」不要。 -->
    </div>

    <!-- campaign-page セクション -->
    <section class="campaign-page l-campaign-page">
      <div class="campaign-page__inner inner">

        <!-- カテゴリー -->
        <div class="campaign-page__categories categories2">
          <!-- 「ALL」ボタン：全ての投稿を表示する場合に「is-selected」クラスを付与 -->
          <a href="<?php echo get_post_type_archive_link('campaign'); ?>" class="categories2__item category2 <?php if (is_post_type_archive('campaign')) echo 'is-selected'; ?>">ALL</a>

          <?php
          // タクソノミー『campaign_category』のタームをすべて取得
          $terms = get_terms(array(
            'taxonomy'   => 'campaign_category',
            'hide_empty' => true,  // 投稿が1件もないタームを非表示
          ));

          // 現在のページが『campaign_category』タクソノミーのアーカイブページかどうかを確認し、該当する場合にのみターム情報を取得
          $current_term = (is_tax('campaign_category')) ? get_queried_object() : null;

          // 各カテゴリーのリンクを出力
          if (!empty($terms) && !is_wp_error($terms)) :
            foreach ($terms as $term) :
              // 現在のタームと一致する場合に「is-selected」クラスを付与
              $is_selected = ($current_term && $current_term->term_id === $term->term_id) ? 'is-selected' : '';
              ?>
              <a href="<?php echo esc_url(get_term_link($term)); ?>" class="categories2__item category2 <?php echo $is_selected; ?>">
                <?php echo esc_html($term->name); ?>
              </a>
            <?php endforeach;
          endif;
          ?>
        </div>


        <!-- カード一覧 -->
        <div class="campaign-page__cards cards cards--2">
          <?php if (have_posts()) : ?>
            <?php while (have_posts()) : ?>
              <?php the_post(); ?>
              <div class="cards__item card card--2">
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
                    <div class="card__content-pc u-desktop">
                      <?php if (get_field('campaign_3')): ?>
                        <p class="card__text">
                          <?php the_field('campaign_3'); ?>
                        </p>
                      <?php endif; ?>

                      <!-- キャンペーン期間 -->
                      <?php
                      // グループフィールド 'campaign_4' 全体を取得
                      $campaign_group = get_field('campaign_4');
                      // グループ内の子フィールドにアクセス
                      if ($campaign_group && $campaign_group['campaign_5'] && $campaign_group['campaign_6'] && $campaign_group['campaign_7'] && $campaign_group['campaign_8'] && $campaign_group['campaign_9']) : ?>
                        <div class="card__date">
                          <?php echo esc_html($campaign_group['campaign_5']); ?>/<?php echo esc_html($campaign_group['campaign_6']); ?>/<?php echo esc_html($campaign_group['campaign_7']); ?>-<?php echo esc_html($campaign_group['campaign_8']); ?>/<?php echo esc_html($campaign_group['campaign_9']); ?>
                        </div>
                      <?php endif; ?>

                      <div class="card__contact">
                        <p class="card__contact__text">ご予約・お問い合わせはコチラ</p>
                        <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="card__btn btn">
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
                </div>
              </div>
            <?php endwhile; ?>
          <?php endif; ?>
        </div>
        <!-- ページネーション -->
        <div class="campaign-page__pagenavi-wrap">
          <?php get_template_part('parts/wp-pagenavi'); ?>  <!-- 拡張子「.php」は不要。相対パスではないので先頭に「./」不要。 -->
        </div>
      </div>
    </section>
  </main>

  <?php get_footer(); ?>
