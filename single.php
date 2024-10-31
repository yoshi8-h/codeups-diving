<?php get_header(); ?>

  <main class="main">
    <!-- fv2 -->
    <div class="fv2 l-fv2 fv2--blog">
      <div class="fv2__inner">
        <p class="fv2__text">Blog</p>
      </div>
    </div>

    <!-- パンくずリスト -->
    <div class="breadcrumbs-area l-breadcrumbs-area">
      <?php get_template_part('parts/breadcrumb'); ?>  <!-- 拡張子「.php」は不要。相対パスではないので先頭に「./」不要。 -->
    </div>

    <!-- 『メイン記事部分』と『サイドバー』を囲う為の要素 -->
    <div class="main-wrap l-main-wrap main-wrap--2">
      <div class="main-wrap__inner inner">

        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : ?>
            <?php the_post(); ?>
            <div class="main-wrap__main">
              <div class="main-wrap__single single-post">
                <div class="single-post__wrap">
                  <div class="single-post__top">
                    <time class="single-post__date" datetime="<?php the_time('c'); ?>"><?php the_time('Y.m/d'); ?></time>
                    <h1 class="single-post__title"><?php the_title(); ?></h1>
                  </div>
                  <div class="single-post__main">
                    <div class="single-post__eye-catch">
                      <?php if (has_post_thumbnail()) : ?>
                        <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>のサムネイル画像">
                      <?php else : ?>
                        <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/noimg.png" alt="no-image">
                      <?php endif; ?>
                    </div>
                    <div class="single-post__content">
                      <?php the_content(); ?>
                    </div>
                  </div>
                </div>
              </div>

              <!-- ページネーション2 (投稿詳細ページの、『前の投稿』や『次の投稿』へのページネーション) -->
              <?php
                // 前の投稿を取得し、存在する場合のみURLを取得
                $prev = get_previous_post();
                if ($prev) {
                  $prev_url = esc_url(get_permalink($prev->ID));
                }
                // 次の投稿を取得し、存在する場合のみURLを取得
                $next = get_next_post();
                if ($next) {
                  $next_url = esc_url(get_permalink($next->ID));
                }
              ?>
              <div class="main-wrap__pagenavi2 pagenavi">
                <!-- 前の投稿へのリンクを表示 (前の投稿が存在する場合のみ) -->
                <?php if($prev): ?>
                  <a href="<?php echo $prev_url; ?>" class="pagenavi__prev" rel="prev"></a>
                <?php endif; ?>
                <!-- 次の投稿へのリンクを表示 (次の投稿が存在する場合のみ) -->
                <?php if($next): ?>
                  <a href="<?php echo $next_url; ?>" class="pagenavi__next" rel="next"></a>
                <?php endif; ?>
              </div>

            </div>
          <?php endwhile; ?>
        <?php endif; ?>

        <!-- サイドバー (sidebar) -->
        <?php get_sidebar(); ?>

      </div>
    </div>
  </main>

<?php get_footer(); ?>
