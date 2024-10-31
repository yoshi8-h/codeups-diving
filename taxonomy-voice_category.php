<?php get_header(); ?>

  <main class="main">
    <!-- fv2 -->
    <div class="fv2 l-fv2 fv2--voice">
      <div class="fv2__inner">
        <p class="fv2__text">Voice</p>
      </div>
    </div>

    <!-- パンくずリスト -->
    <div class="breadcrumbs-area l-breadcrumbs-area">
      <?php get_template_part('parts/breadcrumb'); ?>  <!-- 拡張子「.php」は不要。相対パスではないので先頭に「./」不要。 -->
    </div>

    <!-- voice-page セクション -->
    <section class="voice-page l-voice-page">
      <div class="voice-page__inner inner">

        <!-- カテゴリー -->
        <div class="voice-page__categories categories2">
          <!-- 「ALL」ボタン：全ての投稿を表示する場合に「is-selected」クラスを付与 -->
          <a href="<?php echo get_post_type_archive_link('voice'); ?>" class="categories2__item category2 <?php if (is_post_type_archive('voice')) echo 'is-selected'; ?>">ALL</a>

          <?php
          // タクソノミー『voice_category』のタームをすべて取得
          $terms = get_terms(array(
            'taxonomy'   => 'voice_category',
            'hide_empty' => true,  // 投稿が1件もないタームを非表示
          ));

          // 現在のページが『voice_category』タクソノミーのアーカイブページかどうかを確認し、該当する場合にのみターム情報を取得
          $current_term = (is_tax('voice_category')) ? get_queried_object() : null;

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
        <div class="voice-page__posts posts2">
          <?php if (have_posts()) : ?>
            <?php while (have_posts()) : ?>
              <?php the_post(); ?>
              <div class="posts2__item post2 post2--2">
                <div class="post2__wrap">
                  <div class="post2__top">
                    <div class="post2__meta">
                      <div class="post2__meta-top">
                        <span class="post2__info"><?php the_field('voice_1'); ?></span>

                        <?php
                        // タクソノミー 'voice_category' のターム（カテゴリー）を取得し、配列に格納
                        $terms = get_the_terms(get_the_ID(), 'voice_category');
                        // タームがある場合かつ、エラーでないは、カテゴリー名を表示
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
        </div>
        <!-- ページネーション -->
        <div class="voice-page__pagenavi-wrap">
          <?php get_template_part('parts/wp-pagenavi'); ?>  <!-- 拡張子「.php」は不要。相対パスではないので先頭に「./」不要。 -->
        </div>
      </div>
    </section>
  </main>

<?php get_footer(); ?>
