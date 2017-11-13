<?php
	// アイキャッチ画像を有効にする。
	add_theme_support('post-thumbnails');
	// カテゴリ説明文にHTMLタグを使う
	remove_filter( 'pre_term_description', 'wp_filter_kses' );

	function disable_visual_editor_mypost(){
		add_filter('user_can_richedit', 'disable_visual_editor_filter');
	}
	function disable_visual_editor_filter(){
		return false;
	}
	add_action( 'load-post.php', 'disable_visual_editor_mypost' );
	add_action( 'load-post-new.php', 'disable_visual_editor_mypost' );

	function custom_quicktags_settings( $qtInit ) {
		//$qtInit['buttons'] = 'strong,em,link,block,del,img,ul,ol,li,code,more,spell,close,fullscreen';
		$qtInit['buttons'] = 'strong,em,link';
		return $qtInit;
	}
	add_filter( 'quicktags_settings', 'custom_quicktags_settings' );
	
	//Pagenation
	function pagination($pages = '', $range = 2){
		$showitems = ($range * 2)+1;//表示するページ数（５ページを表示）
		global $paged;//現在のページ値
		if(empty($paged)) $paged = 1;//デフォルトのページ
		if($pages == ''){
			global $wp_query;
			$pages = $wp_query->max_num_pages;//全ページ数を取得
			if(!$pages){
				$pages = 1;
			}
		}
		if(1 != $pages){
			echo '<div class="pagination">'."\n";
			for ($i=1; $i <= $pages; $i++){
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
					echo ($paged == $i)? '<span>'.$i.'</span>'."\n":'<a href="'.get_pagenum_link($i).'">'.$i.'</a>'."\n";
				}
			}
			echo '</div>'."\n";
		}
	}