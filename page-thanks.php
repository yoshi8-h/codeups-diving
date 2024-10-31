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

    <!-- thanks セクション -->
    <section class="thanks l-thanks">
      <div class="thanks__inner inner">
        <p class="thanks__text-top">お問い合わせ内容を送信完了しました。</p>
        <p class="thanks__text-bottom">
          このたびは、お問い合わせ頂き<br class="u-mobile">誠にありがとうございます。<br
          >お送り頂きました内容を確認の上、<br class="u-mobile">3営業日以内に折り返しご連絡させて頂きます。<br
          >また、ご記入頂いたメールアドレスへ、<br class="u-mobile">自動返信の確認メールをお送りしております。
        </p>
      </div>
    </section>
  </main>

<?php get_footer(); ?>
