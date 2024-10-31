<?php get_header(); ?>

  <main class="main">
    <!-- fv2 -->
    <div class="fv2 l-fv2 fv2--contact">
      <div class="fv2__inner">
        <p class="fv2__text">Contact</p>
      </div>
    </div>

    <!-- パンくずリスト -->
    <div class="breadcrumbs-area l-breadcrumbs-area">
      <?php get_template_part('parts/breadcrumb'); ?>  <!-- 拡張子「.php」は不要。相対パスではないので先頭に「./」不要。 -->
    </div>

    <!-- contact-page セクション -->
    <section class="contact-page l-contact-page">
      <div class="contact-page__inner inner">
        <div class="contact-page__form-wrap">
          <!-- form -->
          <?php echo do_shortcode('[contact-form-7 id="264501c" title="お問い合わせ"]'); ?>
        </div>
      </div>
    </section>
  </main>

<?php get_footer(); ?>
