<?php get_header(); ?>

  <main class="main">
    <!-- fv2 -->
    <div class="fv2 l-fv2 fv2--terms">
      <div class="fv2__inner">
        <p class="fv2__text">Terms of Service</p>
      </div>
    </div>

    <!-- パンくずリスト -->
    <div class="breadcrumbs-area l-breadcrumbs-area">
      <?php get_template_part('parts/breadcrumb'); ?>  <!-- 拡張子「.php」は不要。相対パスではないので先頭に「./」不要。 -->
    </div>

    <!-- terms セクション -->
    <section class="terms l-terms">
      <div class="terms__inner inner">
        <h2 class="terms__title">利用規約</h2>
        <div class="terms__contents-wrap">
          <?php the_content(); ?>
        </div>
      </div>
    </section>
  </main>

<?php get_footer(); ?>
