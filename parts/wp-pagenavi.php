<?php if (function_exists('wp_pagenavi')) : ?>  <!-- 『wp_pagenavi();』という関数がある時のみ表示 (プラグイン『WP-PageNavi』が有効化されている時) -->
  <?php wp_pagenavi(); ?>
<?php endif; ?>
