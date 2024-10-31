<?php get_header(); ?>

  <main class="main">
    <!-- fv2 -->
    <div class="fv2 l-fv2 fv2--faq">
      <div class="fv2__inner">
        <p class="fv2__text">FAQ</p>
      </div>
    </div>

    <!-- パンくずリスト -->
    <div class="breadcrumbs-area l-breadcrumbs-area">
      <?php get_template_part('parts/breadcrumb'); ?>  <!-- 拡張子「.php」は不要。相対パスではないので先頭に「./」不要。 -->
    </div>

    <!-- faq セクション -->
    <section class="faq l-faq">
      <div class="faq__inner inner">
        <div class="faq__toggles toggles">

          <?php
          // SCFで繰り返しフィールド「faq_group」を取得
          $faq_group = SCF::get('faq_group');

          // データがある場合のみループ処理
          if ($faq_group) :
            foreach ($faq_group as $faq) :
              // 項目名と価格を取得
              $question = $faq['faq_question'];
              $answer = $faq['faq_answer'];
          ?>
            <div class="toggles__item toggle is-open">
              <button type="button" class="toggle__head js-accordion">
                <span class="toggle__head-text"><?php echo $question; ?></span>
                <span class="toggle__open-btn"></span>
              </button>
              <div class="toggle__body" style="display: block;">
                <p class="toggle__text"><?php echo $answer; ?></p>
              </div>
            </div>
            <?php endforeach;
              else :
          ?>
            <p class="toggle__text">よくある質問がありません。</p>
          <?php endif; ?>

        </div>
      </div>
    </section>
  </main>

<?php get_footer(); ?>
