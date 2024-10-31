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
    <div class="main-wrap l-main-wrap">
      <div class="main-wrap__inner inner">

        <div class="main-wrap__main">
          <div class="main-wrap__posts posts posts--2">
            <?php if (have_posts()) : ?>
              <?php while (have_posts()) : ?>
                <?php the_post(); ?>
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
          </div>

          <!-- ページネーション -->
          <div class="main-wrap__pagenavi-wrap">
            <?php get_template_part('parts/wp-pagenavi'); ?>  <!-- 拡張子「.php」は不要。相対パスではないので先頭に「./」不要。 -->
          </div>
        </div>

        <!-- サイドバー (sidebar) -->
        <?php get_sidebar(); ?>

      </div>
    </div>
  </main>

<?php get_footer(); ?>
