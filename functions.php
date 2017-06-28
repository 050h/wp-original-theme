<?php
//アクセス数をカウントする
function set_post_views() {
	$postID = get_the_ID();
	$num = (int)date_i18n('H'); // 現在時間で番号取得
	$key = 'pv_count';
	$count_key = '_pv_count';
	$count_array = get_post_meta( $postID, $count_key, true );
	$sum_count = get_post_meta( $postID, $key, true );

	if( !is_array($count_array)){ //配列ではない
		$count_array = array();
		$count_array[$num] = 1;
	} else { //配列である
		if ( isset( $count_array[$num] )){ //カウント配列[n]が存在する
			$count_array[$num] += 1;
		} else { //カウント配列[n]が存在しない
			$count_array[$num] = 1;
		}
	}
	update_post_meta( $postID, $count_key, $count_array );
	update_post_meta( $postID, $key, $sum_count + 1 );
}

//アクセス数をリセットする
function reset_post_views() {
	$num = (int)date_i18n('H');
	$key = 'pv_count';
	$reset_key = '_pv_count';

	$args = array(
		'posts_per_page'   => -1,
		'post_type' => 'post',
		'post_status'=>'publish',
		'meta_key' => $reset_key,
	);

	$reset_posts = get_posts($args);
	if($reset_posts):
		foreach($reset_posts as $reset_post):
			$postID = $reset_post->ID;
			$count_array = get_post_meta( $postID , $reset_key, true );
			if ( isset( $count_array[$num] ) ) { //カウント配列[n]が存在する
				$count_array[$num] = 0;
			}
			update_post_meta( $postID, $reset_key, $count_array );
			update_post_meta( $postID, $key, array_sum( $count_array ) );
		endforeach;
	endif;
}

//リセット関数を実行するアクションフックを追加
add_action( 'set_hours_event', 'reset_post_views' );

//実行間隔の追加
function my_interval( $schedules ) {
	// 1時間ごとを追加
	$schedules['1hours'] = array(
		'interval' => 3600,
		'display' => 'every 1 hours'
	);
	return $schedules;
}

add_filter( 'cron_schedules', 'my_interval' );

//アクションフックを定期的に実行するスケジュールイベントの追加
function my_activation() {
	if ( ! wp_next_scheduled( 'set_hours_event' ) ) {
		wp_schedule_event( 1451574000, '1hours', 'set_hours_event' );
	}
}

add_action('wp', 'my_activation');

//ボットの判別
function isBot() {
	$bot_list = array (
		'Googlebot',
		'Yahoo! Slurp',
		'Mediapartners-Google',
		'msnbot',
		'bingbot',
		'MJ12bot',
		'Ezooms',
		'pirst; MSIE 8.0;',
		'Google Web Preview',
		'ia_archiver',
		'Sogou web spider',
		'Googlebot-Mobile',
		'AhrefsBot',
		'YandexBot',
		'Purebot',
		'Baiduspider',
		'UnwindFetchor',
		'TweetmemeBot',
		'MetaURI',
		'PaperLiBot',
		'Showyoubot',
		'JS-Kit',
		'PostRank',
		'Crowsnest',
		'PycURL',
		'bitlybot',
		'Hatena',
		'facebookexternalhit',
		'NINJA bot',
		'YahooCacheSystem',
		'NHN Corp.',
		'Steeler',
		'DoCoMo',
	);
	$is_bot = false;
	foreach ($bot_list as $bot) {
		if (stripos($_SERVER['HTTP_USER_AGENT'], $bot) !== false) {
			$is_bot = true;
			break;
		}
	}
	return $is_bot;
}

// アイキャッチ画像を有効にする。
add_theme_support('post-thumbnails'); 

?>