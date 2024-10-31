<?php get_header(); ?>

  <main class="main">
    <!-- fv2 -->
    <div class="fv2 l-fv2 fv2--privacy">
      <div class="fv2__inner">
        <p class="fv2__text">Privacy Policy</p>
      </div>
    </div>

    <!-- パンくずリスト -->
    <div class="breadcrumbs-area l-breadcrumbs-area">
      <?php get_template_part('parts/breadcrumb'); ?>  <!-- 拡張子「.php」は不要。相対パスではないので先頭に「./」不要。 -->
    </div>

    <!-- privacy セクション -->
    <section class="privacy l-privacy">
      <div class="privacy__inner inner">
        <h2 class="privacy__title">プライバシーポリシー</h2>
        <div class="privacy__contents-wrap">
          <?php the_content(); ?>
        </div>
      </div>
    </section>
  </main>

<?php get_footer(); ?>
