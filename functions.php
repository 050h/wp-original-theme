<?php

	class Konyaku_category extends WP_Widget{
		function __construct() {
			parent::__construct(
				'Konyaku_category', // Base ID
				'Konyaku Category', // Name
				array( 'description' => 'テーマ用のカテゴリーウィジェットです', ) // Args
			);
		}

		public function widget( $args, $instance ) {
			$title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Pages' ) : $instance['title'], $instance, $this->id_base);
			echo $args['before_widget'];
			echo '<p class="box-title">'.$title.'</p>';
			echo '<div class="categories">';
			$categories = get_categories(['hide_empty' => 0]);
			if($categories){
				foreach($categories as $category){
					echo '<a href="'.get_category_link($category->term_id).'">'.$category->cat_name.'</a>';
				}
			}
			echo '</div>';
			echo $args['after_widget'];
		}

		public function form( $instance ){
		$title = $instance['title'];
		$title_name = $this->get_field_name('title');
		$title_id = $this->get_field_id('title');
		?>
			<p>
				<label for="<?php echo $title_id; ?>">タイトル:</label>
				<input class="widefat" id="<?php echo $title_id; ?>" name="<?php echo $title_name; ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
		<?php
		}

		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);

			return $instance;
		}
	}

	register_widget( 'Konyaku_category' );

	// サイドバーウィジェット
	register_sidebar(
		array(
			'name' => __( 'Bottom Widget Left' ),
			'id' => 'bottom-widget-left',
			'before_widget' => '<div class="left-content">',
			'after_widget' => '</div>',
			'before_title' => '<p class="box-title">',
			'after_title' => '</p>',
		)
	);

	register_sidebar(
		array(
			'name' => __( 'Bottom Widget Right' ),
			'id' => 'bottom-widget-right',
			'before_widget' => '<div class="right-content">',
			'after_widget' => '</div>',
			'before_title' => '<p class="box-title">',
			'after_title' => '</p>',
		)
	);

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