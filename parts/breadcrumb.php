<div class="breadcrumbs-area__inner inner">
  <nav class="breadcrumbs-area__breadcrumb breadcrumb">
    <?php if (function_exists('bcn_display')) : ?>
      <?php bcn_display(); ?>  <!-- 『bcn_display();』という関数がある時のみ表示 (プラグイン『Breadcrumb NavXT』が有効化されている時) -->
    <?php endif; ?>
  </nav>
</div>
