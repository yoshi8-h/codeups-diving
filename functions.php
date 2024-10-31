<?php

/* CSSやjsの読み込み */
function my_theme_enqueue_assets() {
  // Google Fontsの読み込み
  wp_enqueue_style('google-fonts-preconnect', 'https://fonts.googleapis.com', array(), null);
  wp_enqueue_style('google-fonts-preconnect2', 'https://fonts.gstatic.com', array(), null);
  wp_style_add_data('google-fonts-preconnect2', 'crossorigin', 'anonymous');
  wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Gotu&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Noto+Sans+JP:wght@100..900&display=swap', array(), null);

  // CSSファイルの読み込み
  wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), null);
  // テーマ内のCSSファイル（filemtime()によるキャッシュバスティング）
  wp_enqueue_style('theme-style', get_theme_file_uri('/assets/css/style.css'), array(), filemtime(get_theme_file_path('/assets/css/style.css')), 'all');

  // JavaScriptファイルの読み込み
  wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), null, true);
  wp_enqueue_script('jquery-cdn', 'https://code.jquery.com/jquery-3.7.1.min.js', array(), null, true);
  wp_script_add_data('jquery-cdn', 'integrity', 'sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=');
  wp_script_add_data('jquery-cdn', 'crossorigin', 'anonymous');
  // テーマ内のJavaScriptファイル（filemtime()によるキャッシュバスティング）
  wp_enqueue_script('jquery-inview', get_theme_file_uri('/assets/js/jquery.inview.min.js'), array('jquery-cdn'), filemtime(get_theme_file_path('/assets/js/jquery.inview.min.js')), true);
  wp_enqueue_script('theme-script', get_theme_file_uri('/assets/js/script.js'), array('jquery-cdn'), filemtime(get_theme_file_path('/assets/js/script.js')), true);
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_assets');


/* ================================================================ */
/* WordPressの標準機能を拡張 */
function my_setup() {
  add_theme_support('post-thumbnails');  // アイキャッチ画像
  add_theme_support('automatic-feed-links');  // RSSフィード
  add_theme_support('title-tag');  // タイトルタグをWordPress側から出力
  add_theme_support('html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ));  // HTML5形式でタグを出力してくれる
}
add_action("after_setup_theme", "my_setup");


/* ================================================================ */
/* カスタム投稿タイプ毎に、一覧ページでの1ページあたりの表示件数を変更する */
function custom_posts_per_page($query) {
  // 管理画面やメインクエリでない場合は処理を中断
  if (is_admin() || !$query->is_main_query()) {
      return;
  }

  // カスタム投稿タイプ「campaign」の一覧ページの場合
  if ($query->is_post_type_archive('campaign')) {
    $query->set('posts_per_page', 4); // 1ページあたりの投稿数を5に設定
  }

  // カスタムタクソノミー「campaign_category」のアーカイブページの場合
  if ($query->is_tax('campaign_category')) {
    $query->set('posts_per_page', 4); // 1ページあたりの投稿数を4に設定
  }

  // カスタム投稿タイプ「voice」の一覧ページの場合
  if ($query->is_post_type_archive('voice')) {
      $query->set('posts_per_page', 6); // 1ページあたりの投稿数を8に設定
  }

  // 『通常の投稿一覧ページ』はここでは設定せず、管理画面の設定値が反映されるように。
}
add_action('pre_get_posts', 'custom_posts_per_page');


/* ================================================================ */
/* 管理画面の『投稿』という表示を任意の名称に変更 */

// グローバル変数で任意の投稿タイプ表示名を設定
$custom_post_name = 'ブログ';  // ここで、変更したい名称に設定

function change_menulabel() {
    global $menu, $submenu, $custom_post_name;

    // サイドメニューとサブメニューの名称変更
    $menu[5][0] = $custom_post_name;
    $submenu['edit.php'][5][0] = $custom_post_name . '一覧';
    $submenu['edit.php'][10][0] = '新規' . $custom_post_name . 'を追加';
}
add_action('admin_menu', 'change_menulabel');

function change_objectlabel() {
    global $wp_post_types, $custom_post_name;

    // 投稿タイプ「post」の各ラベルを変更
    $labels = &$wp_post_types['post']->labels;
    $labels->name = $custom_post_name;
    $labels->singular_name = $custom_post_name;
    $labels->add_new = '追加';
    $labels->add_new_item = $custom_post_name . 'の新規追加';
    $labels->edit_item = $custom_post_name . 'の編集';
    $labels->new_item = '新規' . $custom_post_name;
    $labels->view_item = $custom_post_name . 'を表示';
    $labels->search_items = $custom_post_name . 'を検索';
    $labels->not_found = $custom_post_name . 'が見つかりませんでした';
    $labels->not_found_in_trash = 'ゴミ箱に' . $custom_post_name . 'は見つかりませんでした';
}
add_action('init', 'change_objectlabel');


/* ================================================================ */
/* 『人気記事』を人気順に表示 */
// 記事が表示されるたびに閲覧数をカウント
function set_post_views($postID) {
  $count_key = 'post_views_count';
  $count = get_post_meta($postID, $count_key, true);

  if ($count == '') {
    $count = 0;
    delete_post_meta($postID, $count_key);
    add_post_meta($postID, $count_key, '0');
  } else {
    $count++;
    update_post_meta($postID, $count_key, $count);
  }
}
function track_post_views($post_id) {
  if (!is_single()) return;
  if (empty($post_id)) {
    global $post;
    $post_id = $post->ID;
  }
  set_post_views($post_id);
}
add_action('wp_head', 'track_post_views');


/* ================================================================ */
/* プラグイン『Contact Form 7』で自動生成される <form>タグ に『novalidate』属性を追加 */
function add_novalidate_attribute($content) {
    $content = str_replace('<form', '<form novalidate', $content);
    return $content;
}
add_filter('wpcf7_form_novalidate', 'add_novalidate_attribute');


/* ================================================================ */
/* プラグイン『Contact Form 7』の自動整形機能を無効化 */
// 『Contact Form 7』を使ってフォームを実装すると、自動整形機能が勝手に働き、勝手に変な所に<p>タグや<br>タグが入り、CSSに影響を及ぼすので、それを無効化するための記述。
function wpcf7_autop_return_false() {
  return false;
}
add_filter('wpcf7_autop_or_not', 'wpcf7_autop_return_false');


/* ================================================================ */
/* プラグイン『Contact Form 7』が生成する『送信ボタン』のHTML構造をデフォルトのものから変更 */
// Contact Form 7のフォームHTMLをカスタマイズするフィルターフック
add_filter('wpcf7_form_elements', 'custom_wpcf7_form_elements');
function custom_wpcf7_form_elements($form) {
    // 送信ボタンのカスタムHTMLを定義
    $custom_button = '
        <button type="submit" value="submit" class="form__sendbtn btn btn--send">
            Send
            <div class="btn__arrow">
                <svg xmlns="http://www.w3.org/2000/svg" width="42" height="8" viewBox="0 0 42 8" fill="none">
                    <path d="M1 7H41L34 1" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </button>
    ';

    // 送信ボタンの正規表現を修正し、カスタムボタンを適用
    $form = preg_replace('/<input[^>]*type=["\']submit["\'][^>]*>/', $custom_button, $form);

    return $form;
}


/* ================================================================ */
/* Contact Form 7のスキーマ検証を無効にすることで、チェックボックスのオプション値が「未定義の値」として判定されるエラーを回避 */
//チェックボックス用
remove_action( 'wpcf7_swv_create_schema', 'wpcf7_swv_add_checkbox_enum_rules', 20, 2 );


/* ================================================================ */
/* フォーム送信後に「thanksページ」に飛ぶようにする為の記述 */
function custom_redirect_to_thanks_page() {
  $homeUrl = esc_url(home_url()); // WordPressの環境に依存しないホームURLを取得

  // フォームIDとリダイレクト先のスラッグを配列で定義
  $redirect_pages = [
      '170' => 'contact/thanks',   // フォームID 170 の場合は thanks ページへ
  ];
;
  // PHPの配列をJSON形式に変換し、XSS対策でエスケープ
  $redirect_json = wp_json_encode($redirect_pages);

  echo <<<EOD
  <script>
      document.addEventListener('wpcf7mailsent', function(event) {
          var redirectPages = {$redirect_json};  // リダイレクト先をJavaScriptオブジェクトとして取得
          var formId = event.detail.contactFormId;  // 送信されたフォームのIDを取得
          if (redirectPages[formId]) {  // フォームIDが配列内に存在する場合
              location.href = '{$homeUrl}/' + redirectPages[formId] + '/';  // リダイレクト先URLを生成して移動
          }
      }, false);
  </script>
  EOD;
}
add_action('wp_footer', 'custom_redirect_to_thanks_page');

/* ================================================================ */
/* プラグイン『Contact Form 7』の『ドロップダウンリスト』の選択肢を、カスタム投稿タイプ『campaign』の投稿にする指定 */
// Contact Form 7の「your-campaign」フィールドにカスタム投稿「campaign」の投稿タイトルを追加する
function custom_cf7_campaign_dropdown_options($tag) {
  // フィールド名が「your-campaign」かチェック
  if ($tag['name'] !== 'your-campaign') {
      return $tag; // 違う場合は何もせず返す
  }

  // 「campaign」投稿タイプの全投稿を取得
  $args = array(
      'post_type' => 'campaign',
      'posts_per_page' => 5,  // 5件の投稿を取得
      'post_status' => 'publish',  // 公開済みの投稿のみ取得
  );
  $campaign_posts = get_posts($args);

  // 投稿タイトルをドロップダウンオプションに追加
  $options = array();
  foreach ($campaign_posts as $post) {
      $options[] = $post->post_title;  // タイトルを選択肢に追加
  }

  // Contact Form 7のタグにオプションを設定
  $tag['raw_values'] = array_merge(array("キャンペーン内容を選択"), $options);
  $tag['values'] = $tag['raw_values'];

  return $tag;
}
add_filter('wpcf7_form_tag', 'custom_cf7_campaign_dropdown_options');

